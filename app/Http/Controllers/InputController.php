<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InputController extends Controller
{
    public function hello(Request $request, $name)
    {
        $name = $request->input('name');
        return "Hello $name";
    }
}
