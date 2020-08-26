<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lecture;
use App\LectureSlotsToLecture;
use Validator;
use Illuminate\Support\Facades\DB;

class LectureController extends Controller
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
        $lectures = Lecture::all();

        return view('admin.lecture.index',compact('lectures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $isEditMode = true;
        return view('admin.lecture.show', compact('isEditMode'));
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
            //'description' => 'required',
            //'duration' => 'required',
        ]);

        if ($validator->passes()) {

            $lecture = Lecture::updateOrCreate(['id' => $request->id], ['name' => $request->name, 'description' => (!empty($request->description) ? $request->description : ''), 'duration' => (!empty($request->duration) ? $request->duration : 45)]);



            return response()->json(['success' => 'New lecture was added', 'id' => $lecture->id]);
        }
        else {
            return response()->json(['error' => $validator->errors()]);
        }

    }


    public function show(Request $request)
    {

        if ($request->ajax()) {

            if (!empty($request->id)) {

                $lecture = Lecture::find($request->id);

            }
        }

        return view('admin.lecture.show', compact('lecture'));

    }


    public function edit(Request $request)
    {
        $isEditMode = true;

        if ($request->ajax()) {

            if (!empty($request->id)) {

                $lecture = Lecture::find($request->id);

            }
        }

        return view('admin.lecture.show', compact('lecture','isEditMode'));
    }

    public function destroy(Lecture $lecture, Request $request)
    {

        $lecture_slots_to_lectures = LectureSlotsToLecture::where('lecture_id', $lecture->id)->get();


        if (count($lecture_slots_to_lectures) > 0) {
            foreach ($lecture_slots_to_lectures as $lstl) {
                $lstl->delete();
            }
        }

        $lecture->delete();

        if ($request->ajax()){
            return response()->json(['success' => 'Records were deleted']);
        }

        return redirect()->route('lectures.index')
            ->with('success','Lecture deleted successfully');
    }

    public function bulk_remove(Request $request) {

        if ($request->removeElementsName == 'lectures' && !empty($request->removeElementsIds)) {

            foreach($request->removeElementsIds as $mId){
                $lecture = Lecture::find($mId);

                $lecture_slots_to_lectures = LectureSlotsToLecture::where('lecture_id', $lecture->id)->get();


                if (count($lecture_slots_to_lectures) > 0) {
                    foreach ($lecture_slots_to_lectures as $lstl) {
                        $lstl->delete();
                    }
                }

                $lecture->delete();
            }

            return response()->json(['success' => 'Records were deleted']);
        }

    }
}
