<?php

namespace App\Http\Resources;

use App\Models\Question;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
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
            'catID' => $this->category_id,
            'path' => $this->path,
            'title' => $this->title,
            'body' => $this->body,
            'user_name' =>$this->user->first_name . ' ' . $this->user->last_name,
            'created_at' => $this->created_at->diffForHumans()
        ];
    }
}
