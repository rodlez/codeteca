<?php

namespace App\Livewire\Code\Type;

// Model
use App\Models\CodeType;
// Livewire
use Livewire\Component;
use Livewire\WithPagination;


class Main extends Component
{
    
    use WithPagination;

    //protected $paginationTheme = "bootstrap";
    public $orderColumn = "id";
    public $sortOrder = "desc";
    public $sortLink = '<i class="fa-solid fa-caret-down"></i>';
    public $search = "";
    public $perPage = 2;

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
            $type = CodeType::find($selection);
            $type->delete();
        }

        return to_route('codetype.index')->with('message', 'Types successfully deleted.');
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

        $types = CodeType::orderby($this->orderColumn, $this->sortOrder)->select('*');

        if (!empty($this->search)) {

            $found = $types->where('name', "like", "%" . $this->search . "%")->count();
        }

        $total = $types->count();

        $types = $types->paginate($this->perPage);

        return view('livewire.code.type.main', [
            'types'     => $types,
            'found'     => $found,
            'column'    => $this->orderColumn,
            'total'     => $total
        ]);
    }
}
