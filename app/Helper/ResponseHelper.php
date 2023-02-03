<?php
namespace App\Helper;

class ResponseHelper {
    public static function success($data = [],$message = "success") {
        return response()->json([
            "data" => $data,
            "message" => $message 
        ]);
    }

    public static function fail($message = "fail") {
      return response()->json([
          "message" => $message 
      ]);
  }
}