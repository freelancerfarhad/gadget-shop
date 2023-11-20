<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\ProductSlider;
use App\Helper\ResponseHelper;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    public function SliderPage(): View{
        return view('pages.dashboard.slider-page');
    }
    public function SliderById(Request $request){
        $slider_id=$request->input('id');
        return ProductSlider::where('id',$slider_id)->first();
    }
    public function UpdateSlider(Request $request){
        $slider_id=$request->input('id');

        if ($request->hasFile('image')) {

            // Upload New File
            $img=$request->file('image');
            $t=time();
            $file_name=$img->getClientOriginalExtension();
            $img_name="{$slider_id}-{$t}.{$file_name}";
            $img_url="uploads/slider/{$img_name}";
            $img->move(public_path('uploads/slider'),$img_name);

            // Delete Old File
            $filePath=$request->input('file_path');
            File::delete($filePath);

            // Update Product

            $data = ProductSlider::where('id',$slider_id)->update([
                'title'=>$request->input('title'),
                'short_des'=>$request->input('short_des'),
                'price'=>$request->input('price'),
                'product_id'=>$request->input('product_id'),
                'image'=>$img_url,
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Slider Updated Successful',
            ],200);
            // return ResponseHelper::Out('success',$data,200);
        } else {
           $data = ProductSlider::where('id',$slider_id)->update([
            'title'=>$request->input('title'),
            'short_des'=>$request->input('short_des'),
            'price'=>$request->input('price'),
            'product_id'=>$request->input('product_id'),
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Slider Updated Successful',
            ],200);
            // return ResponseHelper::Out('success',$data,200);
        }

    }
    public function CreateSlider(Request $request){
        $img=$request->file('image');
        $t=time();
        $file_name=$img->getClientOriginalExtension();
        $img_name="{$t}.{$file_name}";
        $img_url="uploads/slider/{$img_name}";

        // Upload File
        $img->move(public_path('uploads/slider/'),$img_name);
        // Save To Database
       $data = ProductSlider::create([
        'title'=>$request->input('title'),
        'short_des'=>$request->input('short_des'),
        'price'=>$request->input('price'),
        'product_id'=>$request->input('product_id'),
        'image'=>$img_url,
        ]);
        // return ResponseHelper::Out('success',$data,200);
        return response()->json([
            'status' => 'success',
            'message' => 'Product Updated Successful',
        ],200);
    }
    public function DeleteSlider(Request $request){
        $slider_id=$request->input('id');
        $filePath=$request->input('file_path');
        File::delete($filePath);
        return ProductSlider::where('id',$slider_id)->delete();

    }
}
