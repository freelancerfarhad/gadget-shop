<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Helper\ResponseHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function ProductByCategoryPage(){
        return view('pages.product_by_category_page');
    }
    public function CategoryPage():View{
        return view('pages.dashboard.category-page');
    }
    /**
     * API Method CategoryList()
     */
    public function CategoryList()
    {
        $data= Category::all();
        return ResponseHelper::Out('success',$data,200);
    }

    public function CreateCategory(Request $request){
        $img=$request->file('categoryImg');
        $t=time();
        $file_name=$img->getClientOriginalExtension();
        $img_name="{$t}.{$file_name}";
        $img_url="uploads/category/{$img_name}";

        // Upload File
        $img->move(public_path('uploads/category/'),$img_name);
        // Save To Database
       $data = Category::create([
            'categoryName'=>$request->input('categoryName'),
            'categoryImg'=>$img_url,
        ]);
        // return ResponseHelper::Out('success',$data,200);
        return response()->json([
            'status' => 'success',
            'message' => 'Catgegory insert Successful',
        ],200);
    }
    public function UpdateCategory(Request $request){
        // $brand_id = Brand::find($id); 
        $category_id=$request->input('id');

        if ($request->hasFile('categoryImg')) {

            // Upload New File
            $img=$request->file('categoryImg');
            $t=time();
            $file_name=$img->getClientOriginalExtension();
            $img_name="{$category_id}-{$t}.{$file_name}";
            $img_url="uploads/category/{$img_name}";
            $img->move(public_path('uploads/category'),$img_name);

            // Delete Old File
            $filePath=$request->input('file_path');
            File::delete($filePath);

            // Update Product

            $data = Category::where('id',$category_id)->update([
                'categoryName'=>$request->input('categoryName'),
                'categoryImg'=>$img_url,
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Category Updated Successful',
            ],200);
            // return ResponseHelper::Out('success',$data,200);
        } else {
           $data = Category::where('id',$category_id)->update([
                'categoryName'=>$request->input('categoryName'),
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Category Updated Successful',
            ],200);
            // return ResponseHelper::Out('success',$data,200);
        }

    }
    
    public function DeleteCategory(Request $request){
        $category_id=$request->input('id');
        $filePath=$request->input('file_path');
        File::delete($filePath);
        return Category::where('id',$category_id)->delete();

    }
    function CategoryById(Request $request)
    {
       
        $category_id=$request->input('id');
        return Category::where('id',$category_id)->first();
    }


}
