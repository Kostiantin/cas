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
        $modulesToDays = ModuleToDay::all()->toArray();
        dd($modulesToDays);
        $days = Day::all();
        $lectures = Lecture::all();
        $lecture_slots = LectureSlot::all();
        $settings = Setting::all();

        return view('admin.connection.index',compact('certificates', 'courses', 'modules', 'lectures', 'settings', 'days', 'lecture_slots', 'modulesToDays'));
    }

    public function storeConnections(Request $request)
    {

        // REMOVE ALL PREVIOUS CONNECTIONS OF CURRENT MODULE
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

                        $ls->delete();
                    }

                    if (!empty($day)) {
                        $day ->delete();
                    }


                    $mtd->delete();

                }
            }

            // ADD NEW CONNECTIONS OF CURRENT MODULE lectures, slots, days
            /*
            "module_id" => "1"
            "slotsLectures" => array:2 [
                0 => array:3 [
                  "day_number" => "1"
                  "lecture_slot_number" => "6"
                  "lecturesIds" => array:2 [
                    0 => "1"
                    1 => "2"
                  ]
                ]
                1 => array:3 [
                  "day_number" => "1"
                  "lecture_slot_number" => "7"
                  "lecturesIds" => array:1 [
                    0 => "3"
                  ]
                ]
              ]
            */
            $daysIds = [];

            foreach ($request->slotsLectures as $slotLecture) {

                // create day
                if (empty($daysIds[$slotLecture['day_number']])) {

                    $_day = Day::create([
                        'name' => 'Day ' . $slotLecture['day_number']
                    ]);

                    $daysIds[$slotLecture['day_number']] = $_day;
                }
                else {
                    $_day = $daysIds[$slotLecture['day_number']];
                }

                // create module_to_day
                $module_to_day = ModuleToDay::create([
                    'module_id' => $request->module_id,
                    'day_id' => $_day->id,
                    'sort_order' => $slotLecture['day_number'],
                ]);

                // create lecture slot
                $lecture_slot = LectureSlot::create([
                    'day_id' => $_day->id,
                    'sort_order' => $slotLecture['lecture_slot_number'],
                ]);

                // lecture_slots_to_lecture
                foreach ($slotLecture['lecturesIds'] as $index => $lecture_id) {

                    $lecture_slot_to_lecture = LectureSlotsToLecture::create([
                        'lecture_slot_id' => $lecture_slot->id,
                        'lecture_id' => $lecture_id,
                        'sort_order' => $index,
                    ]);

                }

            }

        }

        // set new lectures connections

        return response()->json(['success' => 'New connections were added']);
    }
}
