<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use Validator;

class SettingController extends Controller
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
        $settings = Setting::all();

        return view('admin.setting.index',compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $isEditMode = true;
        return view('admin.setting.show', compact('isEditMode'));
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
            'description' => 'required',
            'value' => 'required|max:255',
        ]);

        if ($validator->passes()) {

            Setting::updateOrCreate(['id' => $request->id], ['name' => $request->name, 'description' => $request->description, 'value' => $request->value]);



            return response()->json(['success' => 'New setting was added']);
        }
        else {
            return response()->json(['error' => $validator->errors()]);
        }

    }


    public function show(Request $request)
    {

        if ($request->ajax()) {

            if (!empty($request->id)) {

                $setting = Setting::find($request->id);

            }
        }

        return view('admin.setting.show', compact('setting'));

    }


    public function edit(Request $request)
    {
        $isEditMode = true;

        if ($request->ajax()) {

            if (!empty($request->id)) {

                $setting = Setting::find($request->id);

            }
        }

        return view('admin.setting.show', compact('setting','isEditMode'));
    }



    public function destroy(Setting $setting)
    {
        $setting->delete();

        return redirect()->route('settings.index')
            ->with('success','Setting deleted successfully');
    }

    public function bulk_remove(Request $request) {

        if ($request->removeElementsName == 'settings' && !empty($request->removeElementsIds)) {

            foreach($request->removeElementsIds as $mId){
                $setting = Setting::find($mId);
                $setting->delete();
            }

            return response()->json(['success' => 'Records were deleted']);
        }

    }
}
