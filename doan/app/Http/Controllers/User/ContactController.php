<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function contact(){
        return view('user/contact');
    }
    
}
