<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Throwable;
use App\Http\Traits\UplodeTrait;
use App\Models\Category;

class CategoryController extends Controller
{
    use UplodeTrait;

    public function index(){
        try {
            $datas = Category::paginate(env("paginate_num"));
            return view('admin.category.index',compact('datas'));
        }catch (Throwable $e){
            return view('error.error');
        }
    }

    public function create(){
        try {
            return view('admin.category.create');
        }catch (Throwable $e){
            return view('error.error');
        }
    }

    public function store(Request $request){
        try {
            $image = $this->uploud($request->image); 
            Category::create([
                'image'=>$image,
                'name'=>$request->name,
                'desc'=>$request->desc,
                'price'=>$request->price
            ]);
            return redirect()->back();
        }catch (Throwable $e){
            return view('error.error');
        }
    }

    public function edite($id){
        try {
            $data = Category::where('id',$id)->first();
            return view('admin.category.edite',compact('id','data'));
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
            Category::find($request->id)->update([
                'image'=>$image,
                'name'=>$request->name,
                'desc'=>$request->desc,
                'price'=>$request->price
            ]);
            return redirect()->back();
        }catch (Throwable $e){
            return view('error.error');
        }
    }
}
