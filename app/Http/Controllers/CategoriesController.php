<?php

namespace App\Http\Controllers;
use App\Models\categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Validated;
class CategoriesController extends Controller
{
  
    public function index()
    {
        $sections  = categories::all();
        return view('category.categories' , compact('sections'));

    }// end of index

    public function store(Request $request)
    {
  
            $request->validate([
                'section_name'=>['required','unique:categories','max:255'],
                'description'=>['required']
            ]);

            categories::create(
                [
                    'section_name' => $request->section_name,
                    'description' => $request->description,
                    'created_by' => (Auth::user()->name),
                ]
                );
                session()->flash('Add','تم اضافة القسم بنجاح');
                return redirect('/categories');
        
     }// end of store

    public function update(Request $request, categories $categories)
    {

        $id = $request->section_id;

        $this->validate($request,[
            'section_name'=>'required|max:255|unique:categories,section_name,'.$id,
            'description' =>'required',
        ]);
    
        $category = categories::find($id);

       $category->update([
            'section_name' => $request->section_name,
            'description' => $request->description,
       ]);
       session()->flash('Add','تم تعديل القسم بنجاح');
                return redirect('/categories');

    }// end of update

 
    public function destroy(Request $request,categories $categories)
    {

        $id = $request->section_id;
        $category = categories::find($id);
        $category->delete();
        session()->flash('delete','تم حذف القسم بنجاح');
        return redirect('/categories');

    }// end of destroy
}
