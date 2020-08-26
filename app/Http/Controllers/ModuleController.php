<?php

namespace App\Http\Controllers;

use App\CourseToModule;
use App\Module;
use App\ModuleToDay;
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

            $module = Module::updateOrCreate(['id' => $request->id], ['name' => $request->name, 'description' => (!empty($request->description) ? $request->description : ''), 'code' => $request->code]);

            // if connections to sequences were done, also add them to table sequence_to_module

            return response()->json(['success' => 'New module was added', 'id' => $module->id]);
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

        $courses_to_modules = CourseToModule::where('module_id', $module->id)->get();


        if (count($courses_to_modules) > 0) {
            foreach ($courses_to_modules as $ctm) {
                $ctm->delete();
            }
        }

        $modules_to_days = ModuleToDay::where('module_id', $module->id)->get();

        if (count($modules_to_days) > 0) {
            foreach ($modules_to_days as $mtd) {
                $mtd->delete();
            }
        }


        $module->delete();

        return redirect()->route('modules.index')
            ->with('success','Module deleted successfully');
    }

    public function bulk_remove(Request $request) {

        if ($request->removeElementsName == 'modules' && !empty($request->removeElementsIds)) {

            foreach($request->removeElementsIds as $mId){
                $module = Module::find($mId);

                $courses_to_modules = CourseToModule::where('module_id', $module->id)->get();


                if (count($courses_to_modules) > 0) {
                    foreach ($courses_to_modules as $ctm) {
                        $ctm->delete();
                    }
                }

                $modules_to_days = ModuleToDay::where('module_id', $module->id)->get();

                if (count($modules_to_days) > 0) {
                    foreach ($modules_to_days as $mtd) {
                        $mtd->delete();
                    }
                }

                $module->delete();
            }

            return response()->json(['success' => 'Records were deleted']);
        }

    }
}
