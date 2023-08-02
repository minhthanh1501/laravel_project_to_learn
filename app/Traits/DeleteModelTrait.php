<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait DeleteModelTrait
{
    public function deleteModelTrait($id,$model)
    {
        try {
            $model->find($id)->delete();

            return response()->json([
                'code' => 200,
                'message' => 'delete success'
            ],200);
        } catch (\Exception $exception) {
           Log::error("message: ". $exception->getMessage() . '--line: ' . $exception->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'delete fail'
            ],500);
        }
    }


    
}
