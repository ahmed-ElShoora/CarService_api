<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Technical;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Throwable;
use App\Http\Traits\SendTrait;
use App\Http\Traits\UplodeTrait;
use App\Models\Order;
use App\Models\Rate;
use Illuminate\Support\Facades\Auth;

class TecnicalController extends Controller
{
    use SendTrait;
    use UplodeTrait;
    public function signUp(Request $request){
        try {
            if(Technical::where('email',$request->email)->count() ==0){
                Technical::create([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'password'=>Hash::make($request->password),
                    'phone'=>$request->phone,
                    'town'=>$request->town,
                    'gender'=>$request->gender,
                    'age'=>$request->age,
                    'exeperince'=>$request->exeperince,
                    'status'=>false,
                    'password_hash'=>$request->password,
                    'category_id'=>$request->category_id
                ]);
                return response()->json([
                    'status'=>true,
                    'msg'=>__('messages.success'),
                    'data'=>''
                ]);
            }else{
                return response()->json([
                    'status'=>true,
                    'msg'=>__('messages.error'),
                    'error-code'=>6006
                ]);
            }
        }catch (Throwable $e){
            return response()->json([
                'status'=>false,
                'msg'=>__('messages.error'),
                'error-code'=>6000
            ]);
        }
    }

    public function sendMail(Request $request){
        try {
            $this->sendEmail($request->email,$request->msg);
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

    public function logIn(Request $request){
        try {
            if(Technical::where('phone',$request->phone)->where('status',true)->count() != 0){
                if (! $token = Auth::guard('technical')->attempt(['email' => Technical::where('phone',$request->phone)->first()->email, 'password' => $request->password])) {
                    return response()->json([
                        'status'=>false,
                        'msg'=>__('messages.error'),
                        'error-code'=>6008
                    ]);
                }
                return response()->json([
                    'status'=>true,
                    'msg'=>__('messages.error'),
                    'data'=>$token
                ]);
            }else{
                return response()->json([
                    'status'=>false,
                    'msg'=>__('messages.error'),
                    'error-code'=>6007
                ]);
            }
        }catch (Throwable $e){
            return response()->json([
                 'status'=>false,
                'msg'=>__('messages.error'),
                 'error-code'=>6000
             ]);
        }
    }

    public function delete(){
        try {
            $datas = Order::where('tec_id',Auth::user()->id)->get();
            foreach($datas as $data){
                Rate::where('order_id',$data->id)->get()->delete();
            }
            Order::where('tec_id',Auth::user()->id)->delete();
            Technical::find(Auth::user()->id)->delete();
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

    public function updatePassword(Request $request){
        try {
            if(Technical::where('email',$request->email)->count() != 0){
                Technical::where('email',$request->email)->first()->update([
                    'password_hash'=>$request->password,
                    'password'=>Hash::make($request->password)
                ]);
                return response()->json([
                    'status'=>true,
                    'msg'=>__('messages.success'),
                    'data'=>''
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

    public function getData(){
        try {
            return response()->json([
                'status'=>true,
                'msg'=>__('messages.success'),
                'data'=>Auth::user()
            ]);
        }catch (Throwable $e){
            return response()->json([
                'status'=>false,
                'msg'=>__('messages.error'),
                'error-code'=>6000
            ]);
        }
    }


    public function updateProfile(Request $request){
        try {
            $user = Technical::where('id',Auth::user()->id)->first();
            $user->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
                'phone'=>$request->phone,
                'town'=>$request->town,
                'age'=>$request->age,
                'password_hash'=>$request->password,
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
    
    public function updateProfilePhoto(Request $request){
        try {
            $user = Technical::where('id',Auth::user()->id)->first();
            if($request->photo == null){
                $photo = $user->photo;
            }else{
                $photo = $this->uploud($request->photo);
            }
            $user->update([
                'photo'=>$photo
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

    public function reEmailTec(Request $request){
        try {
            $email = Technical::where('phone',$request->phone)->first()->email;
            return response()->json([
                'status'=>true,
                'msg'=>__('messages.success'),
                'data'=>$email
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
