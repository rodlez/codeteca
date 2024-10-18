<?php

namespace App\Http\Controllers\Code;

use App\Http\Controllers\Controller;
use App\Http\Requests\Code\StoreCategoryRequest;
use App\Models\CodeCategory;
use Illuminate\Http\Request;
use Illuminate\View\View;

use Exception;

class CodeCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('code/category/index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('code/category/create');
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
    public function show(CodeCategory $category): View
    {
        return view('code/category/show', [
            'category' => $category
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CodeCategory $category): View
    {
        return view('code/category/edit', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCategoryRequest $request, CodeCategory $category)
    {
        $formData = $request->validated();
        try {
            CodeCategory::where('id', $category->id)->update($formData);
            return to_route('codecategory.show', $category)->with('message', 'Category successfully updated');
        } catch (Exception $e) {
            return to_route('codecategory.show', $category)->with('message', 'Error(' . $e->getCode() . ') Category can not be updated.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CodeCategory $category)
    {
        /* resticted access - only user who owns the category has access
        if ($category->user_id !== request()->user()->id) {
            abort(403);
        }*/
        try {
            $category->delete();
            return to_route('codecategory.index')->with('message', 'Category (' . $category->name . ') deleted.');
        } catch (Exception $e) {
            return to_route('codecategory.index')->with('message', 'Error (' . $e->getCode() . ') Category: ' . $category->name . ' can not be deleted.');
        }
    }
}
