<?php

namespace App\Controllers;

class HomeController
{
    public function index()
    {
        return view('home', ['name' => 'JDBD']);
    }

    public function about()
    {
        return view('about');
    }

    public function login()
    {
        return view('login');
    }
}
