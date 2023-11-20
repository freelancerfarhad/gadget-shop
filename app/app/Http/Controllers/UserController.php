<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Mail\OTPMail;
use App\Helper\JWTToken;
use Illuminate\Http\Request;
use App\Helper\ResponseHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function UserLogin(Request $request): JsonResponse{
        try{
            $UserEmail = $request->UserEmail;
            $OPT = rand(100000,999999);
            $details = ['code'=>$OPT];
            Mail::to($UserEmail)->send(new OTPMail($details));
            User::updateOrCreate(['email'=>$UserEmail],['email'=>$UserEmail,'otp'=>$OPT]);
            return ResponseHelper::Out('success','A 6 Digite OTP  has been send your email address',200);

        }catch(Exception $e){
            return ResponseHelper::Out('fail',$e,401);
        }
    }
    public function VerifyLogin(Request $request){
        $UserEmail = $request->UserEmail;
        $OTP = $request->OTP;

        $verification = User::where('email',$UserEmail)->where('otp',$OTP)->first();

        if($verification){
             User::where('email',$UserEmail)->where('otp',$OTP)->update(['otp'=>'0']);
             $token = JWTToken::CreateToken($UserEmail,$verification->id);
             return ResponseHelper::Out('success','',200)->cookie('token',$token,60*24*30);
        }else{
            return ResponseHelper::Out('fail',null,401);
        }


    } 
      public function loginPage(){
        return view('pages.loginPage');
    }
    public function verifyPage(){
        return view('pages.verifyPage');
    }
    public function UserLogout(){
        return redirect('/')->cookie('token','',-1);
    }
}
