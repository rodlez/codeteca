<?php

namespace App\Livewire\Code\Tag;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\CodeTag;

class Main extends Component
{

    use WithPagination;

    //protected $paginationTheme = "bootstrap";
    public $orderColumn = "id";
    public $sortOrder = "desc";
    public $sortLink = '<i class="fa-solid fa-caret-down"></i>';
    public $search = "";
    public $perPage = 25;

    public $selections = [];

    public function updated()
    {
        $this->resetPage();
    }

    public function clearSearch()
    {
        $this->search = "";
    }

    public function bulkClear()
    {
        $this->selections = [];
    }

    public function bulkDelete()
    {
        foreach ($this->selections as $selection) {
            $tag = CodeTag::find($selection);
            $tag->delete();
        }

        return to_route('codetag.index')->with('message', 'Tags successfully deleted.');
    }

    public function sorting($columnName = "")
    {
        $caretOrder = "up";
        if ($this->sortOrder == 'asc') {
            $this->sortOrder = 'desc';
            $caretOrder = 'down';
        } else {
            $this->sortOrder = 'asc';
            $caretOrder = 'up';
        }

        $this->sortLink = '<i class="fa-solid fa-caret-' . $caretOrder . '"></i>';
        $this->orderColumn = $columnName;
    }
    public function render()
    {
        $found = 0;

        $tags = CodeTag::orderby($this->orderColumn, $this->sortOrder)->select('*');

        if (!empty($this->search)) {

            $found = $tags->where('name', "like", "%" . $this->search . "%")->count();
        }

        $total = $tags->count();

        $tags = $tags->paginate($this->perPage);

        return view('livewire.code.tag.main', [
            'tags'      => $tags,
            'found'     => $found,
            'column'    => $this->orderColumn,
            'total'     => $total
        ]);
    }
}
