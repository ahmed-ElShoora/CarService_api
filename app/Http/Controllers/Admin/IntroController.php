<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Intro;
use App\Models\Setting;
use Illuminate\Http\Request;
use Throwable;
use App\Http\Traits\UplodeTrait;
class IntroController extends Controller
{
    use UplodeTrait;

    public function index(Request $request){
        try {
            $image_phane = Setting::where('var','logo_phane')->first()->val;
            $image_client = Setting::where('var','logo_client')->first()->val;
            $data_one_one = Intro::where('id',1)->first();
            $data_one_two = Intro::where('id',3)->first();
            $data_two_one = Intro::where('id',2)->first();
            $data_two_two = Intro::where('id',4)->first();
            return view('admin.intro.intro',compact('image_phane','image_client','data_one_one','data_one_two','data_two_one','data_two_two'));
        }catch (Throwable $e){
            return view('error.error');
        }
    }

    public function store(Request $request){
        try {
            if($request->image_splash_phane != null){
                $val = $this->uploud($request->image_splash_phane);
                Setting::where('var','logo_phane')->first()->update([
                    'val'=>$val
                ]);
            }
            if($request->image_splash_client != null){
                $val = $this->uploud($request->image_splash_client);
                Setting::where('var','logo_client')->first()->update([
                    'val'=>$val
                ]);
            }

            if($request->data_one_one_image == null){
                $data_one_one_image = $request->data_one_one_image_old;
            }else{
                $data_one_one_image = $this->uploud($request->data_one_one_image);
            }
            Intro::where('id',1)->first()->update([
                'image'=>$data_one_one_image,
                'title'=>$request->data_one_one_title,
                'desc'=>$request->data_one_one_desc
            ]);

            if($request->data_one_two_image == null){
                $data_one_two_image = $request->data_one_two_image_old;
            }else{
                $data_one_two_image = $this->uploud($request->data_one_two_image);
            }
            Intro::where('id',3)->first()->update([
                'image'=>$data_one_two_image,
                'title'=>$request->data_one_two_title,
                'desc'=>$request->data_one_two_desc
            ]);

            if($request->data_two_one_image == null){
                $data_two_one_image = $request->data_two_one_image_old;
            }else{
                $data_two_one_image = $this->uploud($request->data_two_one_image);
            }
            Intro::where('id',2)->first()->update([
                'image'=>$data_two_one_image,
                'title'=>$request->data_two_one_title,
                'desc'=>$request->data_two_one_desc
            ]);

            if($request->data_two_two_image == null){
                $data_two_two_image = $request->data_two_two_image_old;
            }else{
                $data_two_two_image = $this->uploud($request->data_two_two_image);
            }
            Intro::where('id',4)->first()->update([
                'image'=>$data_two_two_image,
                'title'=>$request->data_two_two_title,
                'desc'=>$request->data_two_two_desc
            ]);

            return redirect()->back();
        }catch (Throwable $e){
            return view('error.error');
        }
    }
}
