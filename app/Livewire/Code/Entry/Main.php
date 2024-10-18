<?php

namespace App\Livewire\Code\Entry;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

use App\Models\CodeEntry;
use App\Models\CodeTag;

use App\Services\CodeService;

class Main extends Component
{
    use WithPagination;

    //protected $paginationTheme = "bootstrap";

    // Dependency Injection CodeService to get the Types Categories and Tags
    protected CodeService $codeService;

    // order and pagination
    #[Url(as: 'o', except: '')]
    public $orderColumn = "id";
    #[Url(as: 'so', except: '')]
    public $sortOrder = "desc";
    public $sortLink = '<i class="fa-solid fa-caret-down pl-2"></i>';
    public $perPage = 25;

    // search
    #[Url(as: 'se', except: '')]
    public $search = "";

    // filters    
    public $showFilters = 0;
    #[Url(as: 'ty', except: '')]
    public $tipo = 0;
    #[Url(as: 'c', except: '')]
    public $cat = 0;
    #[Url(as: 'ta', except: '')]
    public $selectedTags = [];

    // multiple batch selections
    public $selections = [];

    public function boot(
        CodeService $codeService,
    ) {
        $this->codeService = $codeService;
    }

    public function updated()
    {
        $this->resetPage();
    }

    public function mount() {}

    /*
    TODO: Make selectAll with search and filters
    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selections = Code::pluck('id')->toArray();
        } else {
            $this->selections = [];
        }
    } */

    public function activateFilter()
    {
        $this->showFilters++;
    }
    
    public function clearFilters()
    {
        $this->tipo = 0;
        $this->cat = 0;
        $this->selectedTags = [];
    }

    public function clearFilterTipo()
    {
        $this->tipo = 0;
    }

    public function clearFilterCat()
    {
        $this->cat = 0;
    }

    public function clearFilterTag()
    {
        $this->selectedTags = [];
    }

    public function clearSearch()
    {
        $this->search = '';
    }

    public function bulkClear()
    {
        $this->selections = [];
    }


    public function bulkDelete()
    {
        foreach ($this->selections as $selection) {
            $entry = CodeEntry::find($selection);
            $entry->delete();
        }

        return to_route('codeentry.index')->with('message', 'entries: deleted.');
    }

    public function resetAll()
    {
        $this->clearFilters();
        $this->clearSearch();
        $this->bulkClear();
    }

    public function sorting($columnName = "")
    {
        $caretOrder = 'up';
        if ($this->sortOrder == 'asc') {
            $this->sortOrder = 'desc';
            $caretOrder = 'down';
        } else {
            $this->sortOrder = 'asc';
            $caretOrder = 'up';
        }

        $this->sortLink = '<i class="fa-solid fa-caret-' . $caretOrder . ' pl-2"></i>';
        $this->orderColumn = $columnName;
    }
    public function render()
    {
        $found = 0;

        // get only the types that have at least one entry
        $types = CodeEntry::select(
            'code_types.id as id',
            'code_types.name as name'
        )
            ->join('code_types', 'code_entries.type_id', '=', 'code_types.id')->distinct('type_id')->orderBy('name', 'asc')->get()->toArray();

        // get only the categories that have at least one entry
        $categories = CodeEntry::select(
            'code_categories.id as id',
            'code_categories.name as name'
        )
            ->join('code_categories', 'code_entries.category_id', '=', 'code_categories.id')->distinct('category_id')->orderBy('name', 'asc')->get()->toArray();

        // get only the tags that have at least one entry    
        $tags = CodeTag::select(
            'code_tags.id as id',
            'code_tags.name as name'
        )
            ->join('code_entry_tag', 'code_entry_tag.code_tag_id', '=', 'code_tags.id')->distinct('code_tags.id')->orderBy('name', 'asc')->get()->toArray();


        // Main Selection, Join tables code_entries, code_categories and code_entry_tag
        $entries = CodeEntry::select(
            'code_entries.id as id',
            'code_types.name as type_name',
            'code_categories.name as category_name',
            'code_entries.title as title',
            'code_entries.user_id as user_id',
            'code_entries.url as url',
            'code_entries.info as info',
            'code_entries.created_at as created',
            //'code_images.id as files'
        )
            ->join('code_types', 'code_entries.type_id', '=', 'code_types.id')
            ->join('code_categories', 'code_entries.category_id', '=', 'code_categories.id')
            ->join('code_entry_tag', 'code_entries.id', '=', 'code_entry_tag.code_entry_id')
            //->join('code_images', 'code_entries.id', '=', 'code_images.code_id')
            ->distinct('code_entries.id')
            ->orderby($this->orderColumn, $this->sortOrder);

        // tipo filter
        if ($this->tipo != 0) {
            $entries = $entries->where('code_types.name', '=', $this->tipo);
        }

        // category filter
        if ($this->cat != 0) {
            $entries = $entries->where('code_categories.name', '=', $this->cat);
        }

        // tags filter        
        if (!in_array('0', $this->selectedTags) && (count($this->selectedTags) != 0)) {
            $entries = $entries->whereIn('code_entry_tag.code_tag_id', $this->selectedTags);
        }

        // interval duration filter
        /* if ($this->durationFrom <= $this->durationTo) {
            $entries = $entries->whereBetween('duration', [$this->durationFrom, $this->durationTo]);
        } */

        // Search
        if (!empty($this->search)) {
            // trim search in case copy paste or start the search with whitespaces
            // search by id or name
            //$entries->orWhere('id', "like", "%" . $this->search . "%");
            //->orWhere('location', "like", "%" . $this->search . "%")
            $entries = $entries->where('title', "like", "%" . trim($this->search) . "%");
            $found = $entries->count();
        }

        // total values for display stats
        // clone to make a copy and not have the same values as entries
        $stats = clone $entries;
        $totalEntries = $stats->count();
        $differentTypes = $stats->distinct('code_types.id')->count();
        $differentCategories = $stats->distinct('code_categories.id')->count();

        $entries = $entries->paginate($this->perPage);

        if (!in_array('0', $this->selectedTags)) {
            $tagNames = $this->codeService->getTagNames($this->selectedTags);
        } else {
            $tagNames = [];
        }

        return view('livewire.code.entry.main', [
            'entries' => $entries,
            'found' => $found,
            'total' => $totalEntries,
            'differentTypes' => $differentTypes,
            'differentCategories' => $differentCategories,
            'column' => $this->orderColumn,
            'types' => $types,
            'categories' => $categories,
            'tags' => $tags,
            'tagNames' => $tagNames
        ]);
    }
}
