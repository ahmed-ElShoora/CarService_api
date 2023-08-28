<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Rate;
use App\Models\Technical;
use App\Models\User;
use Illuminate\Http\Request;
use Throwable;

class RateController extends Controller
{
    public function tecs(){
        try{
            $datas = Rate::where('app','1')->paginate(env("paginate_num"));
            foreach($datas as $data){
                $data->order_data = Order::select('tec_id','client_id')->where('id',$data->order_id)->first();
                $data->client_name = User::where('id',$data->order_data->client_id)->first()->name;
                $data->tec_name = Technical::where('id',$data->order_data->tec_id)->first()->name;
            }
            return view('admin.rate.rate',compact('datas'));
        }catch (Throwable $e){
            return view('error.error');
        }
    }

    public function users(){
        try{
            $datas = Rate::where('app','2')->paginate(env("paginate_num"));
            foreach($datas as $data){
                $data->order_data = Order::select('tec_id','client_id')->where('id',$data->order_id)->first();
                $data->client_name = User::where('id',$data->order_data->client_id)->first()->name;
                $data->tec_name = Technical::where('id',$data->order_data->tec_id)->first()->name;
            }
            return view('admin.rate.rate',compact('datas'));
        }catch (Throwable $e){
            return view('error.error');
        }
    }
}
