<?php

namespace App\Http\Controllers\Code;

use App\Http\Controllers\Controller;
use App\Models\CodeEntry;
use App\Models\CodeFile;

use Illuminate\Http\Request;

use App\Services\CodeService;
use App\Services\CodeFileService;

use Illuminate\View\View;

class CodeFileController extends Controller
{
    // Service Injection
    public function __construct(
        private CodeService $codeService,
        private CodeFileService $codeFileService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(CodeEntry $entry): View
    {
        return view('code/file.index', ['entry' => $entry]);
    }

    public function download(CodeEntry $entry, CodeFile $file)
    {
        return $this->codeFileService->downloadFile($file, 'attachment');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CodeEntry $entry, CodeFile $file)
    {

        $this->codeFileService->deleteOneFile($file);

        //request()->headers->get('referer')
        //return to_route('sportentry.show', $entry)->with('message', 'Image ' . $image->original_filename . ' for : ' . $entry->title . ' deleted.');
        return back()->with('message', 'File ' . $file->original_filename . ' for : ' . $entry->title . ' deleted.');
    }

}
