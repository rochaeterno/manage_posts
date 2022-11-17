<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        try {
            return [
                "id" => $this->id,
                "title" => $this->title,
                "author" => $this->author,
                "content" => $this->content,
                "tags" => TagsCollection::collection($this->tags),
            ];
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                "serve_error_message" => $e->getMessage()
            ], 402);
        }
    }
}
