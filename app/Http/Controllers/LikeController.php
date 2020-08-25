<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Reply;

class LikeController extends Controller
{

    public function LikeIt(Reply $reply)
    {
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
