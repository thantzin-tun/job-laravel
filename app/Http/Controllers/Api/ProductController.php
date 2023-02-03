<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Helper\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    private function checkProductInfo($request) {
        Validator::make($request->all(),
        [  
            'name' => 'required | min:2 | max:20 ',
            'description' => 'required | min:4 ',
            'price' => 'required |  min:4',
            'qty' => 'required',
            'category_id' => 'required'
            // 'image' => 'mimes:png,jpg,jpeg | file'
        ],[
            'name.required' => "the name field is required",
            'description.required' =>"Enter product description",
            'price.required' => "Enter product price",
            'qty.required' => "Enter product instock",
            'category_id.required' => "please select category"
        ]
        )->validate();
    }

    public function productInputData($request) {
        $photo = null;
        if($request->hasFile("photo")){
            $file = $request->file("photo");
            $photo = uniqid() . "." . $file->getClientOriginalExtension();
            Storage::put("product/" . $photo, file_get_contents($file));
        }
        return [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'qty' => $request->qty,
            'photo' => $photo,
            'discount' => $request->discount,
            'category_id' => $request->category_id
        ];
    }

    
    public function index(){
        $data = Product::orderByDesc('created_at')->paginate(4);
       return ResponseHelper::success(ProductResource::collection($data));
    }

    public function create(Request $request){
        $this->checkProductInfo($request);
        $data = $this->productInputData($request);
        $product = Product::create($data);
        return ResponseHelper::success($product);
    }
}
