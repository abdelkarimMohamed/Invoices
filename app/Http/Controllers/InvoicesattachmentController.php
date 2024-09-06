<?php

namespace App\Http\Controllers;

use App\Models\Invoicesattachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoicesattachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        

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
        $this->validate($request, [

            'file_name' => 'mimes:pdf,jpeg,png,jpg',
    
            ], [
                'file_name.mimes' => 'صيغة المرفق يجب ان تكون   pdf, jpeg , png , jpg',
        ]);

        $image = $request->file('file_name');
        $file_name = $image->getClientOriginalName();
        $id=$request->invoice_id;
       // Storage::disk('public_uploads')->delete($request->invoice_number);
        //Invoicesattachment::find($id);
        //Invoicesattachment::where('invoice_id',$id)->destroy();

        Invoicesattachment::create([
            'invoice_number'=>$request->invoice_number,
            'invoice_id'=>$request->invoice_id,
            'Created_by' => Auth::user()->name,
            'file_name'=>$file_name,
        ]);

        $imageName = $request->file_name->getClientOriginalName();

        $request->file_name->move(public_path('Attachments/'. $request->invoice_number), $imageName);


        session()->flash('Add', 'تم اضافة المرفق بنجاح');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoicesattachment  $invoicesattachment
     * @return \Illuminate\Http\Response
     */
    public function show(Invoicesattachment $invoicesattachment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoicesattachment  $invoicesattachment
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoicesattachment $invoicesattachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoicesattachment  $invoicesattachment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoicesattachment $invoicesattachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoicesattachment  $invoicesattachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoicesattachment $invoicesattachment)
    {
        //
    }
}
