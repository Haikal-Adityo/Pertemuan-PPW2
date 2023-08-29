<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        return view('web2.index');
    }

    public function about(){
        return view('about', [
            'name' => 'lala',
            'email' => 'lala@gmail.com'
        ]);
    }

}
