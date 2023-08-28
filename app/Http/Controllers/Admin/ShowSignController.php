<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Technical;
use App\Models\User;
use Illuminate\Http\Request;
use Throwable;

class ShowSignController extends Controller
{
    public function tecnicals(){
        try{
            $datas = Technical::paginate(env("paginate_num"));
            foreach($datas as $data){
                $data->category_name = Category::where('id',$data->category_id)->first()->name;
            }
            return view('admin.signs.tecnical',compact('datas'));
        }catch (Throwable $e){
            return view('error.error');
        }
    }

    public function users(){
        try{
            $datas = User::paginate(env("paginate_num"));
            return view('admin.signs.users',compact('datas'));
        }catch (Throwable $e){
            return view('error.error');
        }
    }

    public function statusFalTec($id){
        try{
            Technical::where('id',$id)->first()->update([
                'status'=>false
            ]);
            return redirect()->back();
        }catch (Throwable $e){
            return view('error.error');
        }
    }

    public function statusTrueTec($id){
        try{
            Technical::where('id',$id)->first()->update([
                'status'=>true
            ]);
            return redirect()->back();
        }catch (Throwable $e){
            return view('error.error');
        }
    }

    public function deleteUser($id){
        try{
            Order::where('client_id',$id)->delete();
            User::find($id)->delete();
            return redirect()->back();
        }catch (Throwable $e){
            return view('error.error');
        }
    }
}
