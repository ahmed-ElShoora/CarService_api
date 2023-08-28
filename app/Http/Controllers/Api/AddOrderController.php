<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;
use App\Http\Traits\UplodeTrait;
use App\Models\Add;
use App\Models\Notify;
use App\Models\User;
use App\Models\Technical;
use App\Models\Manual;
use App\Models\Fatora;

class AddOrderController extends Controller
{
    use UplodeTrait;
    public function addOne(Request $request){
        try {
            if($request->image == null){
                $image = null;
            }else{
                $image = $this->uploud($request->image);
            }

            if($request->video == null){
                $video = null;
            }else{
                $video = $this->uploud($request->video);
            }
            $order = Order::create([
                'tec_id'=>$request->tec_id,
                'client_id'=>Auth::user()->id,
                'type'=>'waiting',
                'category_id'=>$request->category_id,
                'category_price'=>$request->category_price,
                'lat'=>$request->lat,
                'lng'=>$request->lng,
                'desc'=>$request->desc,
                'image'=>$image,
                'vidoe'=>$video,
            ]);
            Notify::create([
                'order_id'=>$order->id,
                'show_id'=>$request->tec_id,
                'type_show'=>'tec',
                'action'=>'go to google map and accept or decline',
                'photo'=>Auth::user()->photo,
                'name'=>Auth::user()->name,
                'desc'=>'برجاء قبول او رفض طلب الاصلاح'
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

    public function tecOperationOne(Request $request){
        try {
            if($request->type == 'true'){
                Order::find($request->id)->update([
                    'type'=>'containe'
                ]);
                $payment = Order::where('id',$request->id)->first();
                Notify::create([
                    'order_id'=>$request->id,
                    'show_id'=>$payment->client_id,
                    'type_show'=>'client',
                    'action'=>'no action',
                    'photo'=>Auth::user()->photo,
                    'name'=>Auth::user()->name,
                    'desc'=>'تم قبول العملية من قبل الفني و جاري استكمال المراحل'
                ]);
            }else{
                Order::find($request->id)->update([
                    'type'=>'cancelled'
                ]);
                $payment = Order::where('id',$request->id)->first();
                $user = User::where('id',$payment->client_id)->first();
                $user->update([
                    'earn'=>$user->earn+$payment->category_price
                ]);
                Notify::create([
                    'order_id'=>$request->id,
                    'show_id'=>$payment->client_id,
                    'type_show'=>'client',
                    'action'=>'no action',
                    'photo'=>Auth::user()->photo,
                    'name'=>Auth::user()->name,
                    'desc'=>'تم رفض العملية من قبل الفني و تم استرجاع ما دفعته الي محفظتك'
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
    public function tecOperationTwo($id){
        try {
            Order::find($id)->update([
                'arrive'=>true
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

    public function tecOperationThree(Request $request){
        try {
            
            $total_price = 0;
            foreach($request->manual as $data_manual){
                Manual::create([
                    'order_id'=>$request->id,
                    'name'=>$data_manual->name,
                    'price'=>$data_manual->price,
                ]);
                $total_price += $data_manual->price;
            }
            
            if($request->datas == null){}else{
                foreach($request->datas as $data){
                    Add::create([
                        'order_id'=>$request->id,
                        'name'=>$data->name,
                        'price'=>$data->price,
                    ]);
                    $total_price += $data->price;
                }
            }
            
            if($request->fators == null){}else{
                foreach($request->fators as $data_fators){
                    Fatora::create([
                        'order_id'=>$request->id,
                        'image'=>$this->uploud($data_fators->image),
                    ]);
                }
            }
            
            Order::find($request->id)->update([
                'price'=>$total_price,
                'day_work'=>$request->day_work,
                'add-addtions'=>true
            ]);
            $payment = Order::where('id',$request->id)->first();
            
            Notify::create([
                'order_id'=>$request->id,
                'show_id'=>$payment->client_id,
                'type_show'=>'client',
                'action'=>'go to pay',
                'photo'=>Auth::user()->photo,
                'name'=>Auth::user()->name,
                'desc'=>'تم اضافة فاتورة برجاء دفعها للاستكمال'
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

    // public function tecOperationSix(Request $request){
    //     try {
    //         Order::find($request->id)->update([
    //             'day_work'=>$request->day_work
    //         ]);
    //         $payment = Order::where('id',$request->id)->first();
    //         Notify::create([
    //             'order_id'=>$request->id,
    //             'show_id'=>$payment->client_id,
    //             'type_show'=>'client',
    //             'action'=>'no action',
    //             'photo'=>Auth::user()->photo,
    //             'name'=>Auth::user()->name,
    //             'desc'=>'تم تحديد عدد ايام العمل ('.$request->day_work.')'
    //         ]);
    //         return response()->json([
    //             'status'=>true,
    //             'msg'=>__('messages.success'),
    //             'data'=>''
    //         ]);
    //     }catch (Throwable $e){
    //         return response()->json([
    //             'status'=>false,
    //             'msg'=>__('messages.error'),
    //             'error-code'=>6000
    //         ]);
    //     }
    // }

    public function tecOperationSiven($id){
        try {
            Order::find($id)->update([
                'type'=>'complete'
            ]);
            $payment = Order::where('id',$id)->first();
            // $client_data = User::where('id',$payment->client_id)->first();
            //to tec
            // Notify::create([
            //     'order_id'=>$id,
            //     'show_id'=>$payment->tec_id,
            //     'type_show'=>'tec',
            //     'action'=>'go to rate page',
            //     'photo'=>$client_data->photo,
            //     'name'=>$client_data->name,
            //     'desc'=>'برجاء الضغط للذهاب للتقييم'
            // ]);
            //to client
            Notify::create([
                'order_id'=>$id,
                'show_id'=>$payment->client_id,
                'type_show'=>'client',
                'action'=>'go to rate page',
                'photo'=>Auth::user()->photo,
                'name'=>Auth::user()->name,
                'desc'=>'انتهي الفني من الاعمال بينكم'
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

    public function clientPay($id){
        try {
            Order::find($id)->update([
                'pay-invoice'=>true
            ]);
            $payment = Order::where('id',$id)->first();
            $tec_dataf = Technical::where('id',$payment->tec_id)->first();
            $price_kesma = $payment->price/100;
            $earn_tec = $price_kesma*30;
            $tec_dataf->update([
                'earn'=>$tec_dataf->earn+$earn_tec
                ]);
            Notify::create([
                'order_id'=>$id,
                'show_id'=>$payment->tec_id,
                'type_show'=>'tec',
                'action'=>'go show day work',
                'photo'=>Auth::user()->photo,
                'name'=>Auth::user()->name,
                'desc'=>'تم دفع سعر الاصلاح برجاء اكمال المراحل'
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
