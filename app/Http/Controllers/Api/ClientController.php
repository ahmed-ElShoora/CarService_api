<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Technical;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Throwable;
use App\Http\Traits\SendTrait;
use App\Models\Order;
use App\Models\Rate;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\UplodeTrait;

class ClientController extends Controller
{
    use UplodeTrait;
    use SendTrait;

    public function index(){
        try {
            return response()->json([
                'status'=>true,
                'msg'=>__('messages.success'),
                'data'=>[
                    'waiting'=>Order::where('client_id',Auth::user()->id)->where('type','waiting')->get(),
                    'complete'=>Order::where('client_id',Auth::user()->id)->where('type','complete')->get(),
                    'containe'=>Order::where('client_id',Auth::user()->id)->where('type','containe')->get(),
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

    public function signUp(Request $request){
        try {
            if(User::where('email',$request->email)->count() ==0){
                User::create([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'password'=>Hash::make($request->password),
                    'phone'=>$request->phone,
                    'town'=>$request->town,
                    'gender'=>$request->gender,
                    'password_hash'=>$request->password
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

    public function logIn(Request $request){
        try {
            if(User::where('phone',$request->phone)->count() != 0){
                if (! $token = Auth::guard('user')->attempt(['email' => User::where('phone',$request->phone)->first()->email, 'password' => $request->password])) {
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
            $datas = Order::where('client_id',Auth::user()->id)->get();
            foreach($datas as $data){
                Rate::where('order_id',$data->id)->get()->delete();
            }
            $datas->delete();
            User::find(Auth::user()->id)->delete();
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
            if(User::where('email',$request->email)->count() != 0){
                User::where('email',$request->email)->first()->update([
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
            $user = User::where('id',Auth::user()->id)->first();
            $user->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
                'phone'=>$request->phone,
                'town'=>$request->town,
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
            $user = User::where('id',Auth::user()->id)->first();
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

    public function getTecs($id){
        try {
            $data = Technical::select(
                'name',
                'gender',
                'exeperince',
                'status',
                'online',
                'lat',
                'lng',
                'category_id'
            )->where('category_id',$id)->where('status',true)->where('online',true)->get();
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

    public function reEmailClient(Request $request){
        try {
            $email = User::where('phone',$request->phone)->first()->email;
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
