<?php
namespace App\Http\Controllers\API;

trait ApiResponse
{
   public function apiResponse($data=null, $message=null, $status=null){
     
  $array = [
    'data'=> $data,
    'msg' => $message,
    'status' => $status
    ];
    
   return response($array,200);

  }
}