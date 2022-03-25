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
        $students = Student::get();
        
        return view('students.index',compact('students'));
        
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
        $request->validate([
	        'parents_id'=>'required|numeric',
	        'f_name'=>'required|alpha',
	        'l_name'=>'required|alpha',
	        'gender'=>'required',
	        'dob'=>'required|date',
        ]);
        
        Student::create($request->all());
        
        return redirect()->route('student.index')->with('success','Student added successfully!');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        return view('student.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
		$request->validate([
			'parent_id'=>'required|numeric',
	        'f_name'=>'required',
	        'l_name'=>'required',
	        'gender'=>'required',
	        'dob'=>'required',
		]);
		
		$student->update($request->all());
		
		return redirect()->route('student.index')->with('success','Student details updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        
        $student->deleted();
        
        return redirect()->route('student.index')->with('success','Student deleted successfully!');
        
    }
}