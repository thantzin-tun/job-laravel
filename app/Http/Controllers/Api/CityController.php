<?php

namespace App\Http\Controllers\Api;

use App\Models\City;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Helper\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;

class CityController extends Controller
{
    public function index(){
        if($request->city_id){
            $data = City::where("id",$request->city_id)->firstOrFail();
            return ResponseHelper::success(new CityResource($data));
        }
        $data = City::get();
        return ResponseHelper::success(CityResource::collection($data));
    }

    public function createCity(Request $request){

        $newCity = Str::lower($request->name);
        $hasCity = City::where("name", $newCity)->first();

        // if(empty($hasCity)) {
        //     $request->validate(
        //         [
        //             "name" => "required | min:2 | max:20"
        //         ],
        //         [
        //             "name.required" => "Enter job city",
        //             "name.max" => "Must have max 20 characters",
        //             "name.min" => "Must have at least 3 characters"
        //         ]
        //         );
    
        //     $data = [
        //         "name" => $request->name
        //     ];
            
        //     $data = City::create($data);
        //     return ResponseHelper::success($data);
        // }
        // else {
        //     return ResponseHelper::fail("City have already exist");
        // }
        
        $request->validate(
                    [
                        "name" => "required | min:2 | max:20 | unique:cities,name"
                    ],
                    [
                        "name.required" => "Enter job city",
                        "name.max" => "Must have max 20 characters",
                        "name.min" => "Must have at least 3 characters",
                        "name.unique" => "City have already exits"
                    ]
                    );
        
                $data = [
                    "name" => $request->name
                ];
                
                $data = City::create($data);
                return ResponseHelper::success($data);
    }
}
