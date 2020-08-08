<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Certificate;
use Validator;

class CertificateController extends Controller
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

        return view('admin.certificate.index',compact('certificates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $isEditMode = true;
        return view('admin.certificate.show', compact('isEditMode'));
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
            'sub_title' => 'required|max:255',
            'description' => 'required',
        ]);

        if ($validator->passes()) {

            Certificate::updateOrCreate(['id' => $request->id], ['title' => $request->title, 'sub_title' => $request->sub_title, 'description' => $request->description]);

            // if connections to certificates were done, also add them to table certificate_to_module

            return response()->json(['success' => 'New certificate was added']);
        }
        else {
            return response()->json(['error' => $validator->errors()]);
        }

    }


    public function show(Request $request)
    {

        if ($request->ajax()) {

            if (!empty($request->id)) {

                $certificate = Certificate::find($request->id);

            }
        }

        return view('admin.certificate.show', compact('certificate'));

    }


    public function edit(Request $request)
    {
        $isEditMode = true;

        if ($request->ajax()) {

            if (!empty($request->id)) {

                $certificate = Certificate::find($request->id);

            }
        }

        return view('admin.certificate.show', compact('certificate','isEditMode'));
    }



    public function destroy(Certificate $certificate)
    {
        $certificate->delete();

        return redirect()->route('certificates.index')
            ->with('success','Certificate deleted successfully');
    }

    public function bulk_remove(Request $request) {

        if ($request->removeElementsName == 'certificates' && !empty($request->removeElementsIds)) {

            foreach($request->removeElementsIds as $mId){
                $certificate = Certificate::find($mId);
                $certificate->delete();
            }

            return response()->json(['success' => 'Records were deleted']);
        }

    }
}
