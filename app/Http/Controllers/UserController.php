<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getSetupIntent( Request $request ){
        return $request->user()->createSetupIntent();
    }
}
