<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    public function addcategoryform()
    {
        $categories= Category::where('parent_id', 0)->get();
        return view('admin.category.add_category',compact('categories'));
    }
    public function viewcategory()
    {
        $categories=Category::all();
        return view('admin.category.view_category',compact('categories'));
    }
    public function savecategory(Request $request)
    {
        // return $request->all();
        try {
            $category= new Category;
            $category->name = $request->category_name;
            $category->url = $request->category_url;
            $category->parent_id =$request->parent_id;
            $category->description = $request->category_description;
            $status=$category->save();
            if($status){
                return redirect()->back()->with('alert-success', 'Category Inserted Successfully');
              }
        }catch(\Exception $e){
            return redirect()->back()->with('alert-danger', $e->getMessage());
        }
    }
    public function editcategory($id)
    {
        $categoryDetails=Category::find($id);
        $levels=Category::all();
        return view('admin.category.edit_category',compact('categoryDetails','levels'));

    }
    public function updatecategory(Request $request, $id)
    {

        $upcat= Category::find($id);
        $upcat->name =$request->category_name;
        $upcat->parent_id =$request->parent_id;
        $upcat->url =$request->category_url;
        $upcat->description =$request->category_description;
        $upcat->save();
        return redirect()->back();

    }

    public function deletecategory($id)
    {
        $result=Category::find($id);
        $result->delete();
        Alert::success('Deleted Successfully', 'Record Delete Successfully');
        return redirect()->back();


    }

    public function categoriesstatus(Request $request)
    {
        Category::where('id',$request->id)->update(['status' => $request->status]);

    }
}
