<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Helper\ResponseHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\File;

class BrandController extends Controller
{
    public function ProductByBrandPage(){
        return view('pages.product_by_brand_page');
    }
    public function BrandPage():View{
        return view('pages.dashboard.brand-page');
    }
    /**
     * API Method BrandList()
     */
    public function BrandList()
    {
        $data= Brand::all();
        return ResponseHelper::Out('success',$data,200);
    }
    public function CreateBrind(Request $request){
        $img=$request->file('brandImg');
        $t=time();
        $file_name=$img->getClientOriginalExtension();
        $img_name="{$t}.{$file_name}";
        $img_url="uploads/brand/{$img_name}";

        // Upload File
        $img->move(public_path('uploads/brand/'),$img_name);
        // Save To Database
       $data = Brand::create([
            'brandName'=>$request->input('brandName'),
            'brandImg'=>$img_url,
        ]);
        // return ResponseHelper::Out('success',$data,200);
        return response()->json([
            'status' => 'success',
            'message' => 'Product Updated Successful',
        ],200);
    }
    public function UpdateBrind(Request $request){
        // $brand_id = Brand::find($id); 
        $brand_id=$request->input('id');

        if ($request->hasFile('brandImg')) {

            // Upload New File
            $img=$request->file('brandImg');
            $t=time();
            $file_name=$img->getClientOriginalExtension();
            $img_name="{$brand_id}-{$t}.{$file_name}";
            $img_url="uploads/brand/{$img_name}";
            $img->move(public_path('uploads/brand'),$img_name);

            // Delete Old File
            $filePath=$request->input('file_path');
            File::delete($filePath);

            // Update Product

            $data = Brand::where('id',$brand_id)->update([
                'brandName'=>$request->input('brandName'),
                'brandImg'=>$img_url,
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Product Updated Successful',
            ],200);
            // return ResponseHelper::Out('success',$data,200);
        } else {
           $data = Brand::where('id',$brand_id)->update([
                'brandName'=>$request->input('brandName'),
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Product Updated Successful',
            ],200);
            // return ResponseHelper::Out('success',$data,200);
        }

    }
    
    public function DeleteBrind(Request $request){
        $product_id=$request->input('id');
        $filePath=$request->input('file_path');
        File::delete($filePath);
        return Brand::where('id',$product_id)->delete();

    }
    function BrandById(Request $request)
    {
       
        $brand_id=$request->input('id');
        return Brand::where('id',$brand_id)->first();
    }

}
