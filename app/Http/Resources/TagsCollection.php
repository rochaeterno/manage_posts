<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class TagsCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        try {
            return $this->name;
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                "serve_error_message" => $e->getMessage()
            ], 402);
        }
    }
}
