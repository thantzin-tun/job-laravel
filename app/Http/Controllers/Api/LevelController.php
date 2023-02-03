<?php

namespace App\Http\Controllers\Api;

use App\Models\Level;
use Illuminate\Http\Request;
use App\Helper\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\LevelResource;

class LevelController extends Controller
{
    public function index() {

        $data = Level::get();
        return ResponseHelper::success(LevelResource::collection($data));
    }

    public function createLevel(Request $request) {
        
            $request->validate([
                "job_level" => "required | min:2",
            ],
            [
                "job_level.required" => "please enter job level",
            ] );
            
            $data = [
                "job_level" => $request->job_level,
            ];
            $success= Level::create($data);
            return ResponseHelper::success($success,"Successfully Job Level Created!");
    }
}
