<?php

namespace App\Http\Controllers;

use App\LectureSlotsToLecture;
use Illuminate\Http\Request;
use App\Certificate;
use App\Course;
use App\Module;
use App\Day;
use App\LectureSlot;
use App\Lecture;
use App\Setting;
use Validator;
use App\ModuleToDay;

class ConnectionController extends Controller
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
        $certificates = Certificate::all();
        $courses = Course::all();
        $modules = Module::all();
        $lectures = Lecture::all();
        $lecture_slots = LectureSlot::all();
        $days = Day::all();
        $settings = Setting::all();

        return view('admin.connection.index',compact('certificates', 'courses', 'modules', 'lectures', 'settings', 'days', 'lecture_slots'));
    }

    public function storeConnections(Request $request)
    {



        if (!empty($request->module_id) && !empty($request->slotsLectures)) {

            // get module_to_day

            $modules_to_days = ModuleToDay::where('module_id', $request->module_id)->get();

            if ( count($modules_to_days) > 0 ) {


                // get days

                foreach ($modules_to_days as $mtd) {

                    $day = Day::find($mtd->day_id);

                    $lecture_slots = LectureSlot::where('day_id', $mtd->day_id)->get();

                    foreach ($lecture_slots as $ls) {

                        $lecture_slots_to_lecture = LectureSlotsToLecture::where('lecture_slot_id', $ls->id)->get();

                        foreach ($lecture_slots_to_lecture as $lstl) {
                            $lstl->delete();
                        }
                    }

                }


                /*foreach ($modules_to_days as $mtd) {
                    $mtd->delete();
                }*/

            }

            // get days

            // get lecture slots

            // get lectures slots to lecture
        }

        // remove previous lectures connections

        // set new lectures connections

        return response()->json(['success' => 'New day was added']);
    }
}
