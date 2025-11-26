<?php

namespace App\Http\Controllers;


class GameController extends Controller
{
    public function game(){
        return view('user/game');
    }
    public function outdoorsGame(){
        return view('user/outdoorsGame');
    }
    public function kidsGame(){
        return view('user/kidsGame');
    }
    public function malesGame(){
        return view('user/malesGame');
    }
    public function femalesGame(){
        return view('user/femalesGame');
    }
    public function familyGame(){
        return view('user/familyGame');
    }
}
