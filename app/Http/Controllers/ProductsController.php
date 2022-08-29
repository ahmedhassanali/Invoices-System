<?php

namespace App\Http\Controllers;

use App\Models\categories;
use App\Models\products;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    
    public function index()
    {

        $sections = categories::all();
        $products = products::all();
        return view('products.products',compact('sections','products'));

    }// end of index


    public function store(Request $request)
    {
        $request->validate([

            'product_name' =>['required', Rule::unique('products')->where('categories_id', $request->section_name)],

        ]);

        products::create(
            [
                'product_name' => $request->product_name,
                'description' => $request->description,
                'categories_id' => $request->section_name,
            ]
        );

        session()->flash('Add','تم اضافة المنتج بنجاح');
        return redirect('/products');

    }// end of store


    public function update(Request $request, products $products)
    {
        
        $id = $request->product_id;
        $section_id = categories::where('section_name',$request->section_name)->first()->id;
        $product = products::find($id);
        
        $this->validate($request,[

            'product_name' => ['required', Rule::unique('products')->ignore($product)->where('categories_id',  $section_id)]

        ]);
    
        $product->update([
        'product_name' => $request->product_name,
        'description' => $request->description,
        'categories_id' => $section_id,
        ]);
        
        session()->flash('Add','تم تعديل المنتج بنجاح');
        return redirect('/products');

    }// end of update

    public function destroy(products $products , Request $request)
    {
        $id=$request->product_id;
        products::find($id)->delete();

        session()->flash('delete','تم حذف المنتج بنجاح');
        return redirect('/products');
        
    }// end of destroy

}
