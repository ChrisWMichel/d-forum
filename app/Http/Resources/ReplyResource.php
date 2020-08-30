<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ReplyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'reply' => $this->body,
            'user_id' => $this->user->id,
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans(),
            'like_count' => $this->like->count(),
            'user' => $this->user->first_name . ' ' . $this->user->last_name,
            //'liked' => $this->like->where('user_id', Auth::user())->count(), //auth()->user()
            'likes' => $this->like,
            'question_id' => $this->question->id
        ];
    }
}
