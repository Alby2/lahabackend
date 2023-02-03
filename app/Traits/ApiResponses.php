<?php
    namespace App\Traits;
    trait ApiResponses{
        protected function success($data,$message=null,$code = 200)
        {
            return response()->json([
                "status"=>true,
                "message"=>$message,
                "data"=>$data,
            ],$code);
        }
        protected function error($data,$message=null,$code = 400)
        {
            return response()->json([
                "status"=>false,
                "message"=>$message,
                "data"=>$data,
            ],$code);
        }
    }