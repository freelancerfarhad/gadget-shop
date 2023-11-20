<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\ProductDetail;
use App\Models\ProductReview;
use App\Models\ProductSlider;
use App\Helper\ResponseHelper;
use App\Models\CustomerProfile;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function ProductPage(): View{
        return view('pages.dashboard.product-page');
    }

    public function ProductList(){
        return Product::with('brand','category')->get();
    }
    public function Details()
    {
        return view('pages.details_page');
    }
    /**
     * API Method ListProductByCategory
     */
    public function ListProductByCategory(Request $request): JsonResponse
    {
        $data = Product::where('category_id',$request->id)->with('brand','category')->get();
        return ResponseHelper::Out('success',$data,200);
    }

    /**
     * API Method ListProductByRemark
     */
    public function ListProductByRemark(Request $request): JsonResponse
    {
        $data = Product::where('remark',$request->remark)->with('brand','category')->get();
        return ResponseHelper::Out('success',$data,200);
    }

    /**
     * API Method ListProductByBrand
     */
    public function ListProductByBrand(Request $request): JsonResponse
    {
        $data = Product::where('brand_id',$request->id)->with('brand','category')->get();
        return ResponseHelper::Out('success',$data,200);
    }

    /**
     * API Method ListProductBySlider
     */
    public function ListProductBySlider(): JsonResponse
    {
        $data = ProductSlider::all();
        return ResponseHelper::Out('success',$data,200);
    }

    /**
     * API Method ProductDetailsById
     */
    public function ProductDetailsById(Request $request): JsonResponse
    {
        $data = ProductDetail::where('product_id',$request->id)->with('product','product.brand','product.category')->get();
        return ResponseHelper::Out('success',$data,200);
    }

    /**
     * API Method ListReviewByProduct
     */
    public function ListReviewByProduct(Request $request): JsonResponse
    {
        $data = ProductReview::where('product_id',$request->product_id)->with(['profile'=>function($query){
            $query->select('id','cus_name');
        }])->get();
        return ResponseHelper::Out('success',$data,200);
    }
    public function CreateReviwByProduct(Request $request): JsonResponse
    {

        $user_id = $request->header('id');
        $profiles = CustomerProfile::where('user_id',$user_id)->first();
        if($profiles){
            $request->merge(['customer_id'=>$profiles->id]);
            $data=ProductReview::updateOrCreate(
                ['customer_id'=>$profiles->id,'product_id'=>$request->input('product_id')],
                $request->input());
                return ResponseHelper::Out('success',$data,200);
        }else{
            return ResponseHelper::Out('fail','customer profile not exist',401);
        }
    }



    
    /**
     * ProductCreate
     */
    public function CreateProduct(Request $request)
    {
        
            $img=$request->file('image');
            $t=time();
            $file_name=$img->getClientOriginalExtension();
            $img_name="{$t}.{$file_name}";
            $img_url="uploads/product/{$img_name}";
            $img->move(public_path('uploads/product/'),$img_name);

                // product insert and save
                $product                 = new Product();
                $product->brand_id       = $request->brand_id;
                $product->category_id    = $request->category_id;
                $product->title          = $request->title;
                $product->short_des      = $request->short_des;
                $product->price          = $request->price;
                $product->discount       = $request->discount;
                $product->discount_price = $request->discount_price;
                $product->stock          = $request->stock;
                $product->star           = $request->star;
                $product->remark         = $request->remark;
                $product->logn_des       = $request->logn_des;
                $product->image          = $img_url;
                $product->save();
// product details

        $images = $request->file('detailsImg');
        foreach($images as $imgs){
            $t=time();
            // $file_names=$imgs->getClientOriginalExtension();
            $file_names =hexdec(uniqid()).'.'.$imgs->getClientOriginalExtension();
            $img_names="{$t}.{$file_names}";
            $img_urls="uploads/product/details/{$img_names}";
            $imgs->move(public_path('uploads/product/details/'),$img_names);
        
            $multiimage = new ProductDetail();
            $multiimage->color= $request->color;
            $multiimage->size= $request->size;
            $multiimage->product_id=$product->id;
            $multiimage->detailsImg=$img_urls;
            $multiimage->save();
        }

         
            return redirect()->back();
            // return response()->json([
            //     'status'=>'success',
            //     'message'=>'Product Create Successfuly !'
            // ],200);


        
    }
    public function ProductEdit(){
        
    }
    public function ProductById(Request $request){
        $product_id=$request->input('id');
        return Product::where('id',$product_id)->first();
    }

    public function search_products(Request $request){
        $data = Product::whereBetween('price',[$request->left_value, $request->right_value])->get();
        // return view('search_result',compact('all_products'))->render();
            $data = $data->render();
        return ResponseHelper::Out('success',$data,200);
        // return "ok";
    }


    public function sort_by(Request $request)
    {
        if($request->sort_by == 'lowest_price'){
            $data = Product::orderBy('price','asc')->get();
        }
        if($request->sort_by == 'highest_price'){
            $data = Product::orderBy('price','desc')->get();
        }
        // return view('search_result',compact('all_products'))->render();
        return ResponseHelper::Out('success',$data,200);

    }
}
