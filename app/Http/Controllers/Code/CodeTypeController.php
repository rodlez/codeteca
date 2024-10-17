<?php

namespace App\Http\Controllers\Code;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

use App\Http\Requests\Code\StoreTypeRequest;

use App\Models\CodeType;

use Exception;

class CodeTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('code/type/index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('code/type/create');
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
    public function show(CodeType $type): View
    {
        return view('code/type/show', [
            'type' => $type
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CodeType $type): View
    {
        return view('code/type.edit', [
            'type' => $type
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreTypeRequest $request, CodeType $type)
    {
        $formData = $request->validated();
        CodeType::where('id', $type->id)->update($formData);
        return to_route('codetype.show', $type)->with('message', 'Type (' . $request->input('name') . ') successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CodeType $type)
    {
        /* resticted access - only user who owns the type has access
        if ($type->user_id !== request()->user()->id) {
            abort(403);
        }*/
        try {
            $type->delete();

            return to_route('codetype.index')->with('message', 'type: ' . $type->name . ' deleted.');
        } catch (Exception $e) {

            return to_route('codetype.index')->with('message', 'Error(' . $e->getCode() . ') Type: ' . $type->name . ' can not be deleted.');
        }
    }
}
