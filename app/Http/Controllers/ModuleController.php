<?php

namespace App\Http\Controllers;

use App\Module;
use Illuminate\Http\Request;
use Validator;

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

        $validator = Validator::make($request->all(),[
            'name' => 'required|max:255',
            'code' => 'required|max:255',
           // 'description' => 'required',
        ]);

        if ($validator->passes()) {

            Module::updateOrCreate(['id' => $request->id], ['name' => $request->name, 'description' => $request->description, 'code' => $request->code]);

            // if connections to sequences were done, also add them to table sequence_to_module

            return response()->json(['success' => 'New module was added']);
        }
        else {
            return response()->json(['error' => $validator->errors()]);
        }

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

    public function bulk_remove(Request $request) {

        if ($request->removeElementsName == 'modules' && !empty($request->removeElementsIds)) {

            foreach($request->removeElementsIds as $mId){
                $module = Module::find($mId);
                $module->delete();
            }

            return response()->json(['success' => 'Records were deleted']);
        }

    }
}
