<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('HomeRegistration');
    }

    public function signinadmin()
    {
        return view('SignInAdmin');
    }

    public function signupadmin()
    {
        return view('SignUpAdmin');
    }

    public function signinuser()
    {
        return view('SignInUser');
    }

    public function signupuser()
    {
        return view('SignUpUser');
    }
}
