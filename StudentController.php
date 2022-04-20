<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students=Student::latest()->paginate(5);
        return view('students.index',compact('students'))->with('i',(request()->input('page',1)-1)*5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['studname'=>'required','course'=>'required','fee'=>'required']);

        Student::create($request->all());

        return redirect()->route('students.index')->with('success','Students creatred successfully.');
    }

    public function  show(Student $student)
    {
        return view('students.show',compact('student'));
    }

    public function edit(Student $student)
    {
        return view('students.edit',compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $request->valiate([]);

        $student->update($request->all());
        return redirect()->route('students.index')->with('success','Student updated successfully');

    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success','Student deleted successfully');
    }
    

}
