<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function signUp()
    {
    	return view('sign_up');
    }

    
}
