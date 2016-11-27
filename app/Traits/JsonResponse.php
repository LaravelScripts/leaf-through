<?php
namespace App\Traits;


trait JsonResponse
{
    function jsonError($message): \Illuminate\Http\JsonResponse{
        return response()->json(["error"=>true, "message" => $message]);
    }

    function jsonSuccess($message = null, $data = null): \Illuminate\Http\JsonResponse{
        return response()->json(["error"=>false, "data" => $message]);
    }
}
