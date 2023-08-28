<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use Illuminate\Http\Request;
use Throwable;
use App\Http\Traits\UplodeTrait;

class AdsController extends Controller
{
    use UplodeTrait;

    public function index(){
        try {
            $datas = Ad::paginate(env("paginate_num"));
            return view('admin.ads.index',compact('datas'));
        }catch (Throwable $e){
            return view('error.error');
        }
    }

    public function create(){
        try {
            return view('admin.ads.create');
        }catch (Throwable $e){
            return view('error.error');
        }
    }

    public function store(Request $request){
        try {
            $image = $this->uploud($request->image); 
            Ad::create([
                'image'=>$image,
                'title'=>$request->title,
                'link'=>$request->link,
                'app'=>$request->app
            ]);
            return redirect()->back();
        }catch (Throwable $e){
            return view('error.error');
        }
    }

    public function edite($id){
        try {
            $data = Ad::where('id',$id)->first();
            return view('admin.ads.edite',compact('id','data'));
        }catch (Throwable $e){
            return view('error.error');
        }
    }

    public function update(Request $request){
        try {
            if($request->image == null){
                $image = $request->image_old;
            }else{
                $image = $this->uploud($request->image);
            } 
            Ad::find($request->id)->update([
                'image'=>$image,
                'title'=>$request->title,
                'link'=>$request->link,
                'app'=>$request->app
            ]);
            return redirect()->back();
        }catch (Throwable $e){
            return view('error.error');
        }
    }

    public function delete(Request $request){
        try {
            Ad::find($request->id)->delete();
            return redirect()->back();
        }catch (Throwable $e){
            return view('error.error');
        }
    }
}
