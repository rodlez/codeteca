<?php

namespace App\Livewire\Code\File;

use Livewire\Component;
use Livewire\WithFileUploads;

use App\Models\CodeFile;

use App\Services\CodeFileService;

class Upload extends Component
{
    use WithFileUploads;

    public $entry;
    public $files = [];

    // Dependency Injection CodeService to get the Types Categories and Tags
    protected CodeFileService $codeFileService;

    protected $rules = [
        'files' => 'array|min:1|max:5',
        //'files.*' => 'required|mimes:pdf,jpeg,png,jpg|max:2048',
        'files.*' => 'required|file|mimetypes:application/vnd.ms-excel,text/csv,text/plain,application/javascript,application/pdf,text/html,text/x-php,image/jpeg,image/png,application/vnd.oasis.opendocument.text,application/vnd.openxmlformats-officedocument.wordprocessingml.document|max:2048',
    ];

    protected $messages = [
        'files.min' => 'Select at least 1 file to upload (max 5 files)',
        'files.max' => 'Limited to 5 files to upload',
        'files.*.required' => 'Select at least one file to upload',
        //'files.*.mimes' => 'At least one file is not one of the allowed formats: PDF, JPG, JPEG or PNG',
        'files.*.mimetypes' => 'At least one file do not belong to the allowed formats: PDF, JPG, JPEG, PNG, JS, HTML, CSV, XLS, TXT, DOC, ODT'
    ];

    public function boot(
        CodeFileService $codeFileService,
    ) {
        $this->codeFileService = $codeFileService;
    }

    public function deleteFile($position)
    {
        array_splice($this->files, $position, 1);
    }

    public function save()
    {
        $this->validate();

        foreach ($this->files as $file) {
            $storagePath = 'code/' . $file->getClientOriginalExtension();
            $data = $this->codeFileService->uploadFile($file, $this->entry, 'public', $storagePath);

            CodeFile::create($data);
        }

        return to_route('codeentry.show', $this->entry)->with('message', 'File(s) for (' . $this->entry->title . ') uploaded.');
    }
}
