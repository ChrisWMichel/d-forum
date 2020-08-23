<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\Sanctum;
use App\Models\User;

class LikeController extends Controller
{

    public function LikeIt(Reply $reply)
    {   // api/reply/1/like
        // Auth::guard('api')->user()->id
        // \auth()->user()
        // Auth::guard($guard)->check()
        // Auth::id()
        // Auth::check()
        // Auth::user()
        //$user = new User()
        dd(Auth::id());
        $reply->like()->create([
            'user_id' => auth()->id()
            //'user_id' => 12
        ]);
    }


    public function UnlikeIt(Reply $reply)
    {
        $reply->like()->where('user_id', 12)->first()->delete(); //auth()->id()
    }


}
