<?php
namespace App\Traits;


trait JsonResponse
{
    function jsonError($message){
        return response()->json(["error"=>true, "message" => $message]);
    }

    function jsonSuccess($message){
        return response()->json(["error"=>false, "message" => $message]);
    }
}