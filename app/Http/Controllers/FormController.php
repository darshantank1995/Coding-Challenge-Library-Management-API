<?php

namespace App\Http\Controllers;

use App\Models\Additional;
use App\Models\Pkg;
use App\Models\Student;
use App\Models\Transaport;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $package=Pkg::where('student_id',$id)->get();
        return view('welcome', compact('student', 'package'));
    }

public function save(Request $request)
    {
        // $request->validate([
        //     'file' => 'required|file|mimes:jpg,png,pdf|max:2048',
        // ]);
        // dd( $request->all());

        $student = new Student();
        $student->title = $request->input('title');
        $student->btn_title = $request->input('btn_title');
        $student->reg_date_start = $request->input('reg_date_start');
        $student->reg_time_start = $request->input('reg_time_start');
        $student->reg_date_end = $request->input('reg_date_end');
        $student->reg_time_end = $request->input('reg_time_end');

        if ($request->file('file')) {
            // Store the file in the 'uploads' directory on the 'public' disk
            $filePath = $request->file('file')->store('uploads', 'public');
            
            $student->upload_data = $filePath;
        }

        $student->status = $request->input('status');
        $student->pkg_class = implode(",",$request->input('pkg_class'));
        $student->pkg_status = $request->input('pkg_status');
        $student->save();

        if(count($request->package_task) > 0)
        {
            foreach($request->package_task as $package1)
            {
                $pkg = new Pkg();
                $pkg->pkg = $package1['packege'];
                $pkg->price = $package1['price'];
                $pkg->status = $package1['status'];
                $pkg->student_id = $student->id;
                $pkg->save();
            }
        }

        if(count($request->additional_detail) > 0)
        {
            foreach($request->additional_detail as $package1)
            {
                $pkg = new Additional();
                $pkg->tital = $package1['tital'];
                $pkg->price = $package1['price'];
                $pkg->indexs = $package1['index'];
                $pkg->status = $package1['status'];
                $pkg->student_id = $student->id;
                $pkg->save();
            }
        }

          if(count($request->transaport_detail) > 0)
        {
            foreach($request->transaport_detail as $package1)
            {
                $pkg = new Transaport();
                $pkg->tital = $package1['tital'];
                $pkg->price = $package1['price'];
                $pkg->status = $package1['status'];
                $pkg->student_id = $student->id;
                $pkg->save();
            }
        }

      

     

        return view('welcome', compact('student'));
    }
}
