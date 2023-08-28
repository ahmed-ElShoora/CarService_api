<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rate;
use Illuminate\Http\Request;
use Throwable;

class RateController extends Controller
{
    public function addRate(Request $request){
        try {
            Rate::create([
                'order_id'=>$request->order_id,
                'msg'=>$request->msg,
                'app'=>$request->app
            ]);
            return response()->json([
                'status'=>true,
                'msg'=>__('messages.success'),
                'data'=>''
            ]);
        }catch (Throwable $e){
            return response()->json([
                'status'=>false,
                'msg'=>__('messages.error'),
                'error-code'=>6000
            ]);
        }
    }
}
