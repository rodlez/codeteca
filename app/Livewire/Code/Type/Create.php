<?php

namespace App\Livewire\Code\Type;

use Livewire\Component;

use App\Models\CodeType;

use Illuminate\Database\QueryException;

class Create extends Component
{
    public $inputs;
    public $show = 0;

    protected $rules = [
        'inputs.*.name' => 'required|min:3|unique:code_types,name|distinct'
    ];

    protected $messages = [
        'inputs.*.name.required' => 'The field is required',
        'inputs.*.name.min' => 'The field must have at least 3 characters',
        'inputs.*.name.unique' => 'The type with this name is already created',
        'inputs.*.name.distinct' => 'This field has a duplicate, name must be unique'
    ];

    public function mount()
    {
        $this->fill([
            'inputs' => collect([['name' => '']])
        ]);
    }

    public function help()
    {
        $this->show++;
    }

    public function remove($key)
    {
        $this->inputs->pull($key);
    }

    public function add()
    {
        $this->inputs->push(['name' => '']);
    }

    public function save()
    {
        $this->validate();

        foreach ($this->inputs as $input) {

            try {
                CodeType::create(['name' => $input['name']]);
            } catch (QueryException $exception) {

                $errorInfo = $exception->errorInfo;
                // Return the response to the client..
                return to_route('codetype.index')->with('message', 'Error(' . $errorInfo[0] . ') creating the type (' . $input['name'] . ')');
            }
        }

        $message = "";
        $this->inputs->count() === 1 ? $message = ' new Type created' : $message = ' new Types created';

        return to_route('codetype.index')->with('message', $this->inputs->count() . $message);
    }

      
    public function render()
    {
        return view('livewire.code.type.create');
    }
}
