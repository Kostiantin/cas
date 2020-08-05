<?php

namespace App\Http\Controllers;

use App\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modules = Module::all();

        return view('admin.module.index',compact('modules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $isEditMode = true;
        return view('admin.module.show', compact('isEditMode'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'code' => 'required|max:255',
            'description' => 'required',
        ]);

        Module::create($request->all());


        // if connections to sequences were done, also add them to table sequence_to_module


        return redirect()->route('modules.index')
            ->with('success','Module created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

        if ($request->ajax()) {

            if (!empty($request->id)) {

                $module = Module::find($request->id);

            }
        }

        return view('admin.module.show', compact('module'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $isEditMode = true;

        if ($request->ajax()) {

            if (!empty($request->id)) {

                $module = Module::find($request->id);

            }
        }

        return view('admin.module.show', compact('module','isEditMode'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Module $module)
    {
        $request->validate([
            'name' => 'required|max:255',
            'code' => 'required|max:255',
            'description' => 'required',
        ]);

        $module->update($request->all());

        // if connections to sequences were done, also add them to table sequence_to_module

        return redirect()->route('modules.index')
            ->with('success','Module updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function destroy(Module $module)
    {
        $module->delete();

        return redirect()->route('modules.index')
            ->with('success','Module deleted successfully');
    }
}
