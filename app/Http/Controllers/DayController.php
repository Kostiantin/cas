<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Day;
use Validator;

class DayController extends Controller
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
        $days = Day::all();

        return view('admin.day.index',compact('days'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $isEditMode = true;
        return view('admin.day.show', compact('isEditMode'));
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
        ]);

        if ($validator->passes()) {

            Day::updateOrCreate(['id' => $request->id], ['name' => $request->name, 'description' => (!empty($request->description) ? $request->description : ''), 'value' => (!empty($request->value) ? $request->value : '')]);



            return response()->json(['success' => 'New day was added']);
        }
        else {
            return response()->json(['error' => $validator->errors()]);
        }

    }


    public function show(Request $request)
    {

        if ($request->ajax()) {

            if (!empty($request->id)) {

                $day = Day::find($request->id);

            }
        }

        return view('admin.day.show', compact('day'));

    }


    public function edit(Request $request)
    {
        $isEditMode = true;

        if ($request->ajax()) {

            if (!empty($request->id)) {

                $day = Day::find($request->id);

            }
        }

        return view('admin.day.show', compact('day','isEditMode'));
    }



    public function destroy(Day $day)
    {
        $day->delete();

        return redirect()->route('days.index')
            ->with('success','Day deleted successfully');
    }

    public function bulk_remove(Request $request) {

        if ($request->removeElementsName == 'days' && !empty($request->removeElementsIds)) {

            foreach($request->removeElementsIds as $mId){
                $day = Day::find($mId);
                $day->delete();
            }

            return response()->json(['success' => 'Records were deleted']);
        }

    }
}
