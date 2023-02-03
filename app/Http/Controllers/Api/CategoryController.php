<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Helper\ResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{

    //Get Category
    public function index(Request $request){
        if($request->category_id){
            $data = Category::where("id",$request->category_id)->firstOrFail();
            return ResponseHelper::success(new CategoryResource($data));
        }
        $responseData = Category::get();
        return ResponseHelper::success(CategoryResource::collection($responseData));
    }


    //Creat Category
    public function creatCategory(Request $request){
        $request->validate([
            "name" => "required | min:2",
        ],
        [
            "name.required" => "please enter job category"
        ] );
        
        $logo = null;
        if($request->hasFile("logo")){
            $file = $request->file("logo");
            $logo =  uniqid() . "." . $file->getClientOriginalExtension();
            Storage::put("category-logo/" . $logo, file_get_contents($file));
        }
        $data = [
            "name" => $request->name,
            "logo" => $logo
        ];
        $success= Category::create($data);
        return ResponseHelper::success($success,"Successfully Job Category Created!");
    }

}
