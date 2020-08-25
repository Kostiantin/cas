<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Certificate;
use App\Course;
use App\Module;
use App\Day;
use App\LectureSlot;
use App\Lecture;
use App\Setting;
use Validator;

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
}
