<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Intro;
use App\Models\Ad;
use App\Models\Setting;
use Throwable;

class IntroController extends Controller
{
    public function index(){
        try {
            $logo_phane = Setting::where('var','logo_phane')->first()->val;
            $logo_client = Setting::where('var','logo_client')->first()->val;

            return response()->json([
                'status'=>true,
                'msg'=>__('messages.success'),
                'data'=>[
                    'logo_client'=>asset('/'.$logo_client),
                    'logo_phane'=>asset('/'.$logo_phane),
                    'app_client_intro'=>[
                        'one'=>Intro::where('id',1)->first(),
                        'two'=>Intro::where('id',3)->first()
                    ],
                    'app_phane_intro'=>[
                        'one'=>Intro::where('id',2)->first(),
                        'two'=>Intro::where('id',4)->first()
                    ],
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

    public function category(){
        try {
            return response()->json([
                'status'=>true,
                'msg'=>__('messages.success'),
                'data'=>Category::get()
            ]);
        }catch (Throwable $e){
            return response()->json([
                'status'=>false,
                'msg'=>__('messages.error'),
                'error-code'=>6000
            ]);
        }
    }
    
    public function reAddsTec(){
        try {
            return response()->json([
                'status'=>true,
                'msg'=>__('messages.success'),
                'data'=>Ad::where('app','1')->get()
            ]);
        }catch (Throwable $e){
            return response()->json([
                'status'=>false,
                'msg'=>__('messages.error'),
                'error-code'=>6000
            ]);
        }
    }
    
    public function reAddsClient(){
        try {
            return response()->json([
                'status'=>true,
                'msg'=>__('messages.success'),
                'data'=>Ad::where('app','2')->get()
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
