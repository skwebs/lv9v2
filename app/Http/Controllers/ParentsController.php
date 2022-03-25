<?php

namespace App\Http\Controllers;

use App\Models\Parents;
use Illuminate\Http\Request;

class ParentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('parents.index', compact('parents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('parents.create');
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
	        'father_name'=>'required',
	        'father_edu'=>'required',
	        'father_occup'=>'required',
	        'father_inc'=>'required|numeric',
	        'father_mob'=>'numeric',
	        'father_email'='email',
	        'mother_name'=>'required',
	        'mother_edu'=>'required',
	        'mother_occup'=>'required',
	        'mother_inc'=>'required|numeric',
	        'mother_mob'=>'numeric',
	        'mother_email'='email',
	        
        ]);
        
        Parents::create($request->all());
        
        return redirect()->route('parent.index')->with('success','Parents details added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Parents  $parents
     * @return \Illuminate\Http\Response
     */
    public function show(Parents $parents)
    {
        return view('parents.show', compact('parents'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Parents  $parents
     * @return \Illuminate\Http\Response
     */
    public function edit(Parents $parents)
    {
        return view('parents.edit', compact('parents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Parents  $parents
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Parents $parents)
    {
        $request->validate([
	        'father_name'=>'required',
	        'father_edu'=>'required',
	        'father_occup'=>'required',
	        'father_inc'=>'required|numeric',
	        'father_mob'=>'numeric',
	        'father_email'='email',
	        'mother_name'=>'required',
	        'mother_edu'=>'required',
	        'mother_occup'=>'required',
	        'mother_inc'=>'required|numeric',
	        'mother_mob'=>'numeric',
	        'mother_email'='email',
        	        
        ]);
        
        $parents->update($request->all());
        
        return redirect()->route('parents.index')->with('success','Parents details updated successfully!');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Parents  $parents
     * @return \Illuminate\Http\Response
     */
    public function destroy(Parents $parents)
    {
        $parents->delete();
        
        return redirect()->route('parents.index')->with('success','Parents details updated successfully!');
        
    }
}