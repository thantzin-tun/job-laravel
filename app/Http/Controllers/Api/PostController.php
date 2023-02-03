<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Helper\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\PostDetailResource;

class PostController extends Controller
{

    private function checkJobData($request) {
        Validator::make($request->all(),
        [  
            'title' => 'required | min:4  ',
            'company_name' => 'required',
            'salary' => 'required',
            'applicant' => 'required',
            'address' => 'required',
            'job_deadline' => 'required | min:4',
            'description' => 'required | min:5',
            'category_id' => 'required',
            'city_id' => 'required',
            'level_id' => 'required'
        ],
        [
            'title.required' => "Enter job title",
            'company_name.required' =>"Enter you company",
            'address.required' =>"Enter company address",
            'applicant.required' =>"How many?",
            'salary.required' =>"How much salary pay?",
            'job_deadline.required' => "fill the deadline",
            'description.required' => "fill job description",
            'category_id.required' => "Enter job type",
            'city_id.required' => "You need enter your location",
            'level_id.required' => "Enter level",
        ])->validate();
    }

    public function jobData($request) {

        $logo = null;
        if($request->hasFile("logo")){
            $file = $request->file("logo");
            $logo =  uniqid() . "." . $file->getClientOriginalExtension();
            Storage::put("company-logo/" . $logo, file_get_contents($file));
        }
        return [
            'title' => $request->title,
            'applicant' => $request->applicant,
            'company_name' => $request->company_name,
            'address' => $request->address,
            'logo' => $logo,
            'salary' => $request->salary,
            'description' => $request->description,
            'job_deadline' => $request->job_deadline,
            'category_id'=> $request->category_id,
            'city_id'=> $request->city_id,
            'level_id'=> $request->level_id
        ];
    }


    //All Job Post and ById
    public function index(Request $request){

        if($request->post_id){
            $data = Post::where("id",$request->post_id)->get();
            return ResponseHelper::success(PostDetailResource::collection($data));
        }

        $data = Post::orderByDesc("created_at")->paginate(2);
        return ResponseHelper::success(PostResource::collection($data));
    }

    //All Job search with params Use when Query
    public function searchJobs(Request $request){

        $data = Post::query();
        //Filter
        $data->when($request->category_id,function ($query) use($request){
            $query->where('category_id',$request->category_id);
            });
        
            $data->when($request->city_id,function ($query) use($request){
                $query->where('city_id',$request->city_id);
                });

                $data->when($request->level_id,function ($query) use($request){
                    $query->where('level_id',$request->level_id);
                    });

                    $data->when($request->title,function ($query) use($request){
                        $query->where('title',$request->title);
                        });

                        $data->when($request->salary,function ($query) use($request){
                            $query->where('salary', '>' , $request->salary);
                            });
        $result = $data->paginate(10);
        return ResponseHelper::success(PostResource::collection($result));


    }    

    //Creat Post
    public function createPost(Request $request){
        $this->checkJobData($request);
        $data = $this->jobData($request);
        $jobpost = Post::create($data);
        return ResponseHelper::success($jobpost);
    }

}
