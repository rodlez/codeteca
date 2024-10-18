<?php

namespace App\Livewire\Code\Entry;


use Livewire\Component;

use App\Livewire\QuillEditor\Quill;

use App\Models\CodeType;
use App\Models\CodeCategory;

use App\Services\CodeService;

use Illuminate\Http\Request;



class Create extends Component
{
     // test push new branch
     public $show = 0;
     public $status;
     public $title;    
     //public $url;
     public $info;
     public $code;
     public $type_id;
     public $category_id;
     public $selectedTags = [];
 
     public $inputs;
 
     // Dependency Injection CodeService to get the Types Categories and Tags
     protected CodeService $codeService;
 
     protected $rules = [
         'title'         => 'required|min:3',
         'type_id'       => 'required',
         'category_id'   => 'required',
         'selectedTags'  => 'required',
         //'url'           => 'nullable|url',
         'info'          => 'nullable|min:12',
         'code'          => 'nullable|min:3',
         'inputs.*.url'  => 'nullable|min:3'
     ];
 
     protected $messages = [
         'type_id.required' => 'Select one type.',
         'category_id.required' => 'Select one category.',
         'selectedTags.required' => 'At least 1 tag must be selected.',
         'inputs.*.url.min' => 'The field url must have at least 3 characters',
     ];
 
     // TEST QUILL EDITOR
 
     public $listeners = [
         Quill::EVENT_VALUE_UPDATED
     ];
 
     public function quill_value_updated($value){
 
         $this->info = $value;
 
     }
 
 
     // Hook Runs on every request, immediately after the component is instantiated, but before any other lifecycle methods are called
     public function boot(
         CodeService $codeService,
     ) {
         $this->codeService = $codeService;
     }
 
     // Hook Runs once, immediately after the component is instantiated, but before render() is called. This is only called once on initial page load and never called again, even on component refreshes
     public function mount()
     {
         $this->type_id = CodeType::orderBy('name', 'asc')->pluck('id')->first();
         $this->category_id = CodeCategory::orderBy('name', 'asc')->pluck('id')->first();
 
         $this->fill([
             'inputs' => collect([['url' => '']])
         ]);
     }
 
     public function remove($key)
     {
         $this->inputs->pull($key);
     }
 
     public function add()
     {
         $this->inputs->push(['url' => '']);
     }
 
     /* protected function rules(): array
     {
         return (new CodeStoreRequest())->rules();
     } */
 
     public function help()
     {
         $this->show++;
     }
 
     public function save(Request $request)
     //public function save()
     {
 
         $validated = $this->validate();
         $validated['user_id'] = $request->user()->id;
 
         // TEST
         //dd($validated);
 
         // TODO: JSONENCODE DECODE URL ARRAYS
 
         $urlList = [];
         foreach ($this->inputs as $input) {
             $urlList[] = $input['url'];
         }
         // filter the empty possible url arrays and reorder the indexes        
         $urlListFiltered = array_values(array_filter($urlList));
 
         $validated['url'] = json_encode($urlListFiltered);
 
         $entry = $this->codeService->insertEntry($validated);
 
         return to_route('codeentry.index', $entry)->with('message', 'Entry (' . $entry->title . ') created.');
     }
 
     public function render()
     {
         $types = $this->codeService->getTypes();
         $categories = $this->codeService->getCategories();
         $tags = $this->codeService->getTags();
 
         return view('livewire.code.entry.create', [
             'types'         => $types,
             'categories'    => $categories,
             'tags'          => $tags
         ]);
     }
}
