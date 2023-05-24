<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Image;

class BrandController extends Controller
{
    //BrandView
    public function BrandView(){
        $brands = Brand::latest()->get();
        return view('backend.brand.brand_view',compact('brands'));
    }

    public function BrandStore(Request $request){
        $request->validate([
            'brand_name_en' => 'required',  
            'brand_image' => 'required',   
        ],[
            'brand_name_en.required' => 'Input Brand Name',  
        ]);

        $image = $request->file('brand_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save('upload/brand/'.$name_gen);
        $save_url = 'upload/brand/'.$name_gen;

        Brand::insert([
            'brand_name_en' => $request->brand_name_en,
            'brand_slug_en' => strtolower(str_replace(' ', '-', $request->brand_name_en)),
            'brand_image' => $save_url,
        ]); 

        $notification = array(
            'message' => 'Brand Inserted successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }

    public function BrandEdit($id){
        $brand = Brand::findOrFail($id);
        return view('backend.brand.brand_edit',compact('brand'));
    }

    public function BrandUpdate(Request $request){
        $brand_id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('brand_image')) {
            # code...

            unlink($old_img);
            $image = $request->file('brand_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save('upload/brand/'.$name_gen);
            $save_url = 'upload/brand/'.$name_gen;
    
            Brand::findOrFail($brand_id)->update([
                'brand_name_en' => $request->brand_name_en,
                'brand_slug_en' => strtolower(str_replace(' ', '-', $request->brand_name_en)),
                'brand_image' => $save_url,
            ]); 
    
            $notification = array(
                'message' => 'Brand Updated successfully',
                'alert-type' => 'info'
            );
            return redirect()->route('all.brand')->with($notification);
        } else {
            # code...
            Brand::findOrFail($brand_id)->update([
                'brand_name_en' => $request->brand_name_en,
                'brand_slug_en' => strtolower(str_replace(' ', '-', $request->brand_name_en)),
            ]); 
    
            $notification = array(
                'message' => 'Brand Updated successfully',
                'alert-type' => 'info'
            );
            return redirect()->route('all.brand')->with($notification);
        }
        
    }




    public function BrandDelete($id){
        $brand = Brand::findOrFail($id);
        $img = $brand->brand_image;
        unlink($img);

        Brand::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Brand Deleted successfully',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }

}

