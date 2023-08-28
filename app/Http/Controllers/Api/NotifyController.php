<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;
class NotifyController extends Controller
{
    public function getNotifyTec(){
        try {
            $data = Notify::where('show_id',Auth::user()->id)->where('type_show','tec')->latest()->get();
            return response()->json([
                'status'=>true,
                'msg'=>__('messages.success'),
                'data'=>$data
            ]);
        }catch (Throwable $e){
            return response()->json([
                'status'=>false,
                'msg'=>__('messages.error'),
                'error-code'=>6000
            ]);
        }
    }

    public function getNotifyClient(){
        try {
            $data = Notify::where('show_id',Auth::user()->id)->where('type_show','client')->latest()->get();
            return response()->json([
                'status'=>true,
                'msg'=>__('messages.success'),
                'data'=>$data
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
