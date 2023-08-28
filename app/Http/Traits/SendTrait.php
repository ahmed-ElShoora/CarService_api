<?php

namespace App\Http\Traits;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;

trait SendTrait {

    // public function sendSms($toPerson,$msg){
    //     $url = 'https://api.taqnyat.sa/v1/messages?bearerTokens=448f416e39158af8ea02a7e073874203&sender=Ramadia&recipients='.$toPerson.'&body='.$msg;
    //     Http::get($url);
    // }

    public function sendEmail($toPerson,$msg) {
        Mail::raw($msg, function($message)use($toPerson) {
            $message -> from('support@kash5tak.com', 'Ramadia Team');
            $message -> to($toPerson);
            $message -> subject('ramadia.sa');
        });
        
    }

}
