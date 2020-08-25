<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use Validator;

class CourseController extends Controller
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
        $courses = Course::all();

        return view('admin.course.index',compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $isEditMode = true;
        return view('admin.course.show', compact('isEditMode'));
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
            'title' => 'required|max:255',
            //'description' => 'required',
        ]);

        if ($validator->passes()) {

            Course::updateOrCreate(['id' => $request->id], ['title' => $request->title, 'description' => $request->description]);

            // if connections to courses were done, also add them to table course_to_module

            return response()->json(['success' => 'New course was added']);
        }
        else {
            return response()->json(['error' => $validator->errors()]);
        }

    }


    public function show(Request $request)
    {

        if ($request->ajax()) {

            if (!empty($request->id)) {

                $course = Course::find($request->id);

            }
        }

        return view('admin.course.show', compact('course'));

    }


    public function edit(Request $request)
    {
        $isEditMode = true;

        if ($request->ajax()) {

            if (!empty($request->id)) {

                $course = Course::find($request->id);

            }
        }

        return view('admin.course.show', compact('course','isEditMode'));
    }



    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('courses.index')
            ->with('success','Course deleted successfully');
    }

    public function bulk_remove(Request $request) {

        if ($request->removeElementsName == 'courses' && !empty($request->removeElementsIds)) {

            foreach($request->removeElementsIds as $mId){
                $course = Course::find($mId);
                $course->delete();
            }

            return response()->json(['success' => 'Records were deleted']);
        }

    }
}
