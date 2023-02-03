<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Helper\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function getUserProfile(Request $request){
                $user = auth()->guard()->user();
                return ResponseHelper::success(new UserResource($user));
    }

    public function getUser(Request $request) {
        $user;

        if($request->userID){
            $user = User::where("id", $request->userID)->first();
            // return ResponseHelper::success(new UserResource($user));
        }

        if($request->name){
            $user = User::where("name", $request->name)->first();
        }
   
        return ResponseHelper::success($user);
        
    }
}
