<?php

namespace App\Http\Controllers;

use App\Models\Clazz;
use Illuminate\Http\Request;

class ClazzController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	    return view('classes.create');
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
	        'class'=>'required|unique:clazzs'
        ]);
        
        $clazz=Clazz::create($request->all());
        return redirect()->route('class.index')->with('success',"Class : \"{$request->class}\" has added successfully.");
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Clazz  $clazz
     * @return \Illuminate\Http\Response
     */
    public function show(Clazz $clazz)
    {
        return view('classes.show', compact('clazz'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Clazz  $clazz
     * @return \Illuminate\Http\Response
     */
    public function edit(Clazz $clazz)
    {
        return view('classes.edit', compact('clazz'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Clazz  $clazz
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clazz $clazz)
    {
        $request->validate([
	        'class'=>'required'
        ]);
        
        $clazz->update($request->all());
        
        return redirect()->route('class.index')->with('success',"Class : \"{$request->class}\" has updated successfully.");
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clazz  $clazz
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clazz $clazz)
    {
       $clazz->delete();
       
        return redirect()->route('class.index')->with('success',"Class : \"{$request->class}\" has updated successfully.");
        
    }
}