<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class ReplyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'bodi' => $this->body,
            'question' => new QuestionResource($this->question),
            'user' => new UserResource($this->user),
            'created_at' => Carbon::parse($this->created_at)->diffForHumans(),
        ];
    }
}
