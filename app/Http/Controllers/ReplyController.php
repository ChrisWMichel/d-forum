<?php

namespace App\Http\Controllers;

use App\Events\DeleteReplyEvent;
use App\Http\Resources\ReplyResource;
use App\Models\Question;
use App\Models\Reply;
use App\Notifications\NewReplyNotification;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Question $question)
    {
        /*
         *  This index isn't being used because the replies are being called
         *  via the Question model with...
         *  protected $with = ['replies'];
         */
        //return ReplyResource::collection($question->replies)->get();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Question $question, Request $request)
    {
        $reply = $question->replies()->create($request->all());

        $user = $question->user;
        if($reply->user_id !== $question->user_id){
            $user->notify(new NewReplyNotification($reply));
        }

        return response(['reply' => new ReplyResource($reply)], Response::HTTP_ACCEPTED );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reply  $reply
     */
    public function show(Question $question, Reply $reply)
    {
        //return new ReplyResource($question->replies);
        return  new ReplyResource($reply);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function update(Question $question, Request $request, Reply $reply)
    {
        $reply->update($request->all());

        //$updated = ReplyResource::collection($question->replies);

        return response('updated', Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question, Reply $reply)
    {
        $reply->delete();
        broadcast(new DeleteReplyEvent($reply->id))->toOthers();
        $firstReply = ReplyResource::collection($question->replies)->first();
        return response($firstReply, 201);
    }
}
