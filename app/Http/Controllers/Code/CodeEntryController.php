<?php

namespace App\Http\Controllers\Code;

use App\Http\Controllers\Controller;
use App\Models\CodeEntry;
use App\Services\CodeService;

use Illuminate\Http\Request;
use Illuminate\View\View;

class CodeEntryController extends Controller
{
    // Service Injection
    public function __construct(private CodeService $codeService)
    {
        //private SportImageService $sportImageService,
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('code/entry/index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('code/entry/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CodeEntry $entry): View
    {
        $tags = $this->codeService->displayEntryTags($entry);
        /* $files = $this->codeService->getFiles($entry); */

        return view('code/entry/show', [
            'entry' => $entry,
            'tags' => $tags,
            //'files' => $files,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CodeEntry $entry): View
    {
        //$selectedTags = $this->codeService->getEntryTags($entry);

        return view('code/entry/edit', [
            'entry' => $entry,
            //'selectedTags' => $selectedTags
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CodeEntry $entry)
    {
        //$images = $this->sportService->getImages($entry);
        //dd($images->count());
        //$this->sportImageService->deleteImages($images);

        $entry->delete();
        return to_route('codeentry.index')->with('message', 'Entry: ' . $entry->title . ' deleted.');
    }
}
