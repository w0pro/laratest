<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdvertisementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $fields = $request->input('fields');
        $arrayResponse = [
            'title' => $this->title,
            'price'=>$this->price,
            'headPhoto' => new AdvertisementPhotoResource($this->headPhoto),
        ];
        if ($fields) {
            $arrayResponse[$fields] = match ($fields) {
                'links' => new AdvertisementPhotoCollection($this->links),
                'description' => $this->description,
            };
        }
        return $arrayResponse;
    }
}
