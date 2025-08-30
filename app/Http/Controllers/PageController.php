<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){
        return view('index');
    }
    public function about(){
        return view('about');
    }
    public function contact(){
        return view('contact');
    }
    public function service(){
        return view('service');
    }
    public function testimonial(){
        return view('testimonial');
    }
    public function quote(){
        return view('quote');
    }
    public function feature(){
        return view('feature');
    }
    public function careers(){
        return view('careers');
    }
}
