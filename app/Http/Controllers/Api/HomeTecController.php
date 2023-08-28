<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Add;
use App\Models\Order;
use App\Models\Technical;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class HomeTecController extends Controller
{
    public function index(){
        try {
            $datas_complete = Order::where('tec_id',Auth::user()->id)->where('type','complete')->get();
            foreach($datas_complete as $data_complete){
                $data_complete->category_image = User::where('id',$data_complete->client_id)->first()->photo;
                $data_complete->category_name = User::where('id',$data_complete->client_id)->first()->name;
            }
            
            
            $datas_cancelled = Order::where('tec_id',Auth::user()->id)->where('type','cancelled')->get();
            foreach($datas_cancelled as $data_cancelled){
                $data_cancelled->image_user = User::where('id',$data_cancelled->client_id)->first()->photo;
                $data_cancelled->name_user = User::where('id',$data_cancelled->client_id)->first()->name;
            }
            
            
            
            $datas_waiting = Order::where('tec_id',Auth::user()->id)->where('type','waiting')->get();
            foreach($datas_waiting as $data_waiting){
                $data_waiting->image_user = User::where('id',$data_waiting->client_id)->first()->photo;
                $data_waiting->name_user = User::where('id',$data_waiting->client_id)->first()->name;
            }
            
            
            $datas_containe = Order::where('tec_id',Auth::user()->id)->where('type','containe')->get();
            foreach($datas_containe as $data_containe){
                $data_containe->image_user = User::where('id',$data_containe->client_id)->first()->photo;
                $data_containe->name_user = User::where('id',$data_containe->client_id)->first()->name;
            }
            
            
            return response()->json([
                'status'=>true,
                'msg'=>__('messages.success'),
                'data'=>[
                    'waiting'=>$datas_waiting,
                    'cancelled'=>$datas_cancelled,
                    'complete'=>$datas_complete,
                    'containe'=>$datas_containe,
                ]
            ]);
        }catch (Throwable $e){
            return response()->json([
                'status'=>false,
                'msg'=>__('messages.error'),
                'error-code'=>6000
            ]);
        }
    }

    public function getDataOrder($id){
        try {
            $data = Add::where('order_id',$id)->get();
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

    public function online(){
        try {
            if(Auth::user()->online){
                Technical::find(Auth::user()->id)->update([
                    'online'=>false
                ]);
            }else{
                Technical::find(Auth::user()->id)->update([
                    'online'=>true
                ]);
            }
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
    
    public function checkOnline(){
        try {
            Technical::find(Auth::user()->id)->first()->online;
            return response()->json([
                'status'=>true,
                'msg'=>__('messages.success'),
                'data'=>Technical::where('id',Auth::user()->id)->first()->online
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
