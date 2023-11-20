<?php

namespace App\Http\Controllers;

use App\Models\Policy;
use Illuminate\Http\Request;

class PolicyController extends Controller
{
    /**
     * API Method PolicyByType
     */
    public function PolicyPage(){
        return view('pages.policy_page');
    }

     public function PolicyByType(Request $request)
    {
        return Policy::where('type','=',$request->type)->first();
    }


}
