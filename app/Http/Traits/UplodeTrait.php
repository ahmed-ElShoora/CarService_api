<?php

namespace App\Http\Traits;

trait UplodeTrait {

    public function uploud($data) {
        $file_name = time().$data->getClientOriginalName();
        $path = 'uploads';
        $data->move($path,$file_name);
        return $path . '/' . $file_name;
    }

}
