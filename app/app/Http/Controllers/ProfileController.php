<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use Illuminate\Http\Request;
use App\Models\CustomerProfile;
use Illuminate\Http\JsonResponse;

class ProfileController extends Controller
{
    public function profilePage(){
        return view('pages.profilepage');
    }
    public function createProfile(Request $request): JsonResponse{
        $user_id = $request->header('id');
        $request->merge(['user_id'=>$user_id]);
        $data= CustomerProfile::updateOrCreate(
            ['user_id'=>$user_id],
            $request->input()
        );
        return ResponseHelper::Out('success',$data,200);
    }

    public function readProfile(Request $request): JsonResponse{
        $user_id = $request->header('id');
        
        $data= CustomerProfile::where('user_id',$user_id)->with('user')->first();
        return ResponseHelper::Out('success',$data,200);
    
    }
}
