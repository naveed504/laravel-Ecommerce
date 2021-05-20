<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\ProductModel;
use App\Models\Category;
use App\Models\ProductAttribute;

class IndexController extends Controller
{
    public function index(){
        $banners = Banner::where('status','1')->orderby('sort_order','asc')->get();
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();
        $products = ProductModel::all(  nnz);
        return view('wayshop.index')->with(compact('banners','categories','products'));
    }

    public function displaySubCategory($category_id)
    {
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();
        $products = ProductModel::where('category_id',$category_id)->get();
        $product_name = ProductModel::where(['category_id'=>$category_id])->first();
        return view('wayshop.category')->with(compact('categories','products','product_name'));
    }
    public function getPrice(Request $request)
    {
        $data = $request->all();
        $proArr = explode("-",$data['idSize']);
        $proAttr = ProductAttribute::where(['product_id'=>$proArr[0],'size'=>$proArr[1]])->first();

        echo $proAttr->price;

    }
}
