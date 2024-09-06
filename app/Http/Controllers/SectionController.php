<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sections=Section::all();
        return view('sections.sections',compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
       $validated=$request->validate([
        'section_name'=>'required|unique:sections|max:255',
       ],[
        'section_name.required'=>'يرجي ادخال اسم القسم',
        'section_name.unique'=>'اسم القسم مسجل مسبقا',
        'section_name.max'=>'يرجي عدم ادخال اكثر من 255 حرف',
       ]);
       
            Section::create([
                'section_name'=>$request->section_name,
                'description'=>$request->description,
                'Created_by'=>auth()->user()->name
            ]);
            session()->flash('Add','تم اضافه القسم بنجاح');
            return redirect('/sections'); 
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;

        $this->validate($request, [

            'section_name' => 'required|max:255|unique:sections,section_name,'.$id,
            'description' => 'required',
        ],[

            'section_name.required' =>'يرجي ادخال اسم القسم',
            'section_name.unique' =>'اسم القسم مسجل مسبقا',
            'description.required' =>'يرجي ادخال البيان',

        ]);

        $section=Section::find($id);
        $section->update([
            'section_name'=>$request->section_name,
            'description'=>$request->description,
        ]);
        session()->flash('edit','تم تعديل القسم بنجاح');
            return redirect('/sections'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $id = $request->id;
        Section::find($id)->delete();
        session()->flash('delete','تم حذف القسم بنجاح');
        return redirect('/sections'); 
    }
}
