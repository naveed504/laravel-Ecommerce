<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;

class BannerController extends Controller
{
    public function showbanner()
    {
        $bannerDetails= Banner::all();
        return view('admin.banner.index',compact('bannerDetails'));
    }
    public function banner()
    {
        return view('admin.banner.add_banner');
    }
    public function savebanner(Request $request)
    {

        try {
            $banner =new Banner;
            $banner->name = $request->banner_name;
            $banner->text_style = $request->text_style;
            $banner->content = $request->banner_content;
            $banner->link= $request->link;
            $banner->sort_order= $request->sort_order;
            $request->hasFile('image');
            $destinationPath = storage_path('app/public/banner');
            $file = $request->image;
            $fileName = time() . '.'.$file->clientExtension();
            $file->move($destinationPath, $fileName);
            $banner->image = $fileName;
            $status=$banner->save();
            if($status){
                return redirect()->back()->with('alert-success', 'Banner Inserted Successfully');
              }
        }catch(\Exception $e){
            return redirect()->back()->with('alert-danger', $e->getMessage());
        }

    }
}
