<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function  index()
    {
        
    }


     public function  store(Request $request)
    {
        $vadidater=$request->validate([
            'email'=>'required|string|max:100',
            'password'=>'required|min:6',

        ]);
       
    }
}
