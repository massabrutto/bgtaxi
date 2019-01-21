<?php

use Dpl\Bgtaxi\Components\MailComponent;
use Illuminate\Support\Facades\Input;

Route::post('/contact', function () {
    $obMailSend = new MailComponent();
    $obMailSend->onContactUs();
    if(!empty($url = Input::get('page'))){
        return redirect($url . '?popup=show');
    }
    return redirect('/contacts?popup=show');
});