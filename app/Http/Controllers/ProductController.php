<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections=Section::all();
        $products=Product::all();
      //  $products=Section::all()->products;
        
        return view('products.products',compact('sections','products'));
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
        $validated=$request->validate([
            'Product_name'=>'required',
            'section_id'=>'required',
           ],[
            'Product_name.required'=>'يرجي ادخال اسم المنتج',
            'section_id.required'=>'يرجي ادخال اسم القسم',
    
           ]);
        Product::create([
            'Product_name'=>$request->Product_name,
            'description'=>$request->description,
            'section_id'=>$request->section_id,
        ]);
            session()->flash('Add','تم اضافه المنتج بنجاح');
            return redirect('/products'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $validated=$request->validate([
            'Product_name'=>'required',
            'section_name'=>'required',
           ],[
            'Product_name.required'=>'يرجي ادخال اسم المنتج',
            'section_name.required'=>'يرجي ادخال اسم القسم',
    
           ]);
        $id = Section::where('section_name', $request->section_name)->first()->id;

       $Products = Product::findOrFail($request->pro_id);

       $Products->update([
       'Product_name' => $request->Product_name,
       'description' => $request->description,
       'section_id' => $id,
       ]);

       session()->flash('Edit', 'تم تعديل المنتج بنجاح');
       return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $product = Product::findOrFail($request->pro_id);
         $product->delete();
         session()->flash('delete', 'تم حذف المنتج بنجاح');
         return back();
    }
}
