<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Helper\ResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    //check Validation
    private function checkInputValue($request) {
        Validator::make($request->all(),
        [  
            'name' => 'required | min:4 | max:20 ',
            'phone' => 'required',
            'address' => 'required | min:4 ',
            'email' => 'required | email | min:4 | unique:users,email',
            'password' => 'required | min:8 | max:20',
            'confirm_password' => 'required|same:password'
            // 'image' => 'mimes:png,jpg,jpeg | file'
        ],[
            'name.required' => "the name field is required",
            'address.required' =>"Enter you address",
            'phone.required' => "Enter a valid phone number",
            'email.required' => "Enter your email",
            'password.required' => "Enter your password",
            'password.min' => "password must be at least 8 characters in length",
            'confirm_password.same' => "password not match",
        ]
        )->validate();
    }

    public function userInputData($request) {
        return [
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];
    }



    public function login(Request $request) {
        
        $request->validate([
            'email' => 'required | email',
            'password' => 'required',
        ],
        [
            'email.required' => 'Enter your email',
            'password.required' => 'Enter your password',
        ]
        );

        $user = User::where("email", $request->email)->first();
        if($user) {
            if(Hash::check($request->password,$user->password)){
                $token = $user->createToken("access_token")->accessToken;
                return ResponseHelper::success(["access_token" => $token],"Login Successfully");
            }
            else {
                return ResponseHelper::fail("This user is do not match our credentials");
            }
        }

    }


    public function register(Request $request) {
        $this->checkInputValue($request);
        $fields = $this->userInputData($request);
        $data = User::create($fields);
        return ResponseHelper::success($data,"Register Successfully");
    }


    public function logout(Request $request) {
        auth()->user()->token()->revoke();
        return ResponseHelper::success("Logout!","success");
    }
}
