<?php

namespace App\Http\Controllers;

use App\Models\Invoicesdetail;
use App\Models\Invoice;
use App\Models\Invoicesattachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class InvoicesdetailController extends Controller
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoicesdetail  $invoicesdetail
     * @return \Illuminate\Http\Response
     */
    public function show(Invoicesdetail $invoicesdetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoicesdetail  $invoicesdetail
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $invoices = Invoice::where('id',$id)->first();
        
        $details  = Invoicesdetail::where('id_Invoice',$id)->get();

        $attachments  = Invoicesattachment::where('invoice_id',$id)->get();
        

        return view('invoices.details_invoice',compact('invoices','details','attachments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoicesdetail  $invoicesdetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoicesdetail $invoicesdetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoicesdetail  $invoicesdetail
     * @return \Illuminate\Http\Response
     */
    
    public function destroy(Request $request)
    {
        $invoices = Invoicesattachment::findOrFail($request->id_file);
        $invoices->delete();
        Storage::disk('public_uploads')->delete($request->invoice_number.'/'.$request->file_name);
        session()->flash('delete', 'تم حذف المرفق بنجاح');
        return back();
    }

    public function get_file($invoice_number,$file_name)
    {
    $st="Attachments";
    $pathToFile = public_path($st.'/'.$invoice_number.'/'.$file_name);
    return response()->download($pathToFile);
    }



   
    public function open_file($invoice_number,$file_name)
    {
        $st="Attachments";
        $pathToFile = public_path($st.'/'.$invoice_number.'/'.$file_name);
        return response()->file($pathToFile);
        }
    
}
