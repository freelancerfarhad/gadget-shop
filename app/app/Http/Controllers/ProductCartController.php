<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCart;
use Illuminate\Http\Request;
use App\Models\ProductDetail;
use App\Helper\ResponseHelper;

class ProductCartController extends Controller
{
    public function productCartPage()
    {
        return view('pages.procutCartPage');
    }
    public function CreateProdudtCart(Request $request){
        $user_id = $request->header('id');
        $product_id = $request->input('product_id');
        $color = $request->input('color');
        $size = $request->input('size');
        $qty = $request->input('qty');
        $UnitPrice = 0;
        $ProductDetails  = Product::where('id',$product_id)->first();

        if($ProductDetails->discount==1){
            $UnitPrice = $ProductDetails->discount_price;
        }else{
            $UnitPrice = $ProductDetails->price;
        }

        $totalPridct = $qty*$UnitPrice;
        $data = ProductCart::updateOrCreate(
            ['user_id'=>$user_id,'product_id'=>$product_id],
            ['user_id' => $user_id,
                'product_id'=>$product_id,
                'color' => $color,
                'size' => $size,
                'qty' => $qty,
                'price' => $totalPridct,
            ]
        );
        return ResponseHelper::Out('success',$data,200);
    }
    public function ListProductCart(Request $request){
        $user_id = $request->header('id');
        $data = ProductCart::where('user_id',$user_id)->with('product')->get();
        return ResponseHelper::Out('success',$data,200);
    }
    public function RemoveProductCart(Request $request){
        $user_id = $request->header('id');
        $data = ProductCart::where('user_id',$user_id)->where('product_id',$request->product_id)->delete();
        return ResponseHelper::Out('success',$data,200);
    }
    public function CartQTYCount(Request $request){
        $user_id=$request->header('id');
        $CartQTys= ProductCart::where('user_id','=',$user_id)->count();
        return [
            'cartqty' => $CartQTys,
        ];
    }
}
