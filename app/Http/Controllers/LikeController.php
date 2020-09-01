<?php

namespace App\Http\Controllers;

use App\Events\LikeEvent;
use App\Models\Like;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class LikeController extends Controller
{

    public function LikeIt(Request $request)
    {

        Like::create([
            'user_id' => $request->user_id,
            'reply_id' => $request->reply_id
        ]);

        broadcast(new LikeEvent( $request->reply_id, 1))->toOthers();

        return \response('data has been created.', Response::HTTP_CREATED);
    }


    public function UnlikeIt(Request $request)
    {
        Like::where([
            'user_id' => $request['user_id'],
            'reply_id' => $request['reply_id']
        ])->delete();

        broadcast(new LikeEvent( $request['reply_id'], 0))->toOthers();

        return \response('deleted', Response::HTTP_NO_CONTENT);
    }


}
