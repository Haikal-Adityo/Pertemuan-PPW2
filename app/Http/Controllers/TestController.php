<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function beranda(){
        return view('welcome');
    }

    public function about(){
        return view('about', [
            'name' => 'lala',
            'email' => 'lala@gmail.com'
        ]);
    }
    
    public function index(){
        return view('web2.index');
    }
    
    public function boomesport() {
        return view('esports.boom');
    }

    public function prxesport() {
        return view('esports.prx');
    }

    public function fnaticesport() {
        return view('esports.fnatic');
    }

    public function fpxesport() {
        return view('esports.fpx');
    }

}
