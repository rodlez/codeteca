<?php

namespace App\Http\Controllers\Code;

use App\Http\Controllers\Controller;
use App\Http\Requests\Code\StoreTagRequest;
use App\Models\CodeTag;
use Illuminate\Http\Request;
use Illuminate\View\View;

use Exception;

class CodeTagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('code/tag/index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('code/tag/create');
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
    public function show(CodeTag $tag): View
    {
        return view('code/tag/show', [
            'tag' => $tag
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CodeTag $tag): View
    {
        return view('code/tag/edit', [
            'tag' => $tag
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreTagRequest $request, CodeTag $tag)
    {
        $formData = $request->validated();
        try {
            CodeTag::where('id', $tag->id)->update($formData);
            return to_route('codetag.show', $tag)->with('message', 'Tag successfully updated');
        } catch (Exception $e) {
            return to_route('codetag.show', $tag)->with('message', 'Error(' . $e->getCode() . ') Tag can not be updated.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CodeTag $tag)
    {
        /* resticted access - only user who owns the tag has access
        if ($tag->user_id !== request()->user()->id) {
            abort(403);
        }*/
        try {
            $tag->delete();
            return to_route('codetag.index')->with('message', 'Tag (' . $tag->name . ') deleted.');
        } catch (Exception $e) {
            return to_route('codetag.index')->with('message', 'Error (' . $e->getCode() . ') Tag: ' . $tag->name . ' can not be deleted.');
        }
    }
}