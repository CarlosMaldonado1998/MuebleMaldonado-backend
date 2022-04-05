<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Image as ImageResource;
use App\Http\Resources\Price as PriceResource;
use App\Http\Resources\Color as ColorResource;


class Product extends JsonResource
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
            'name' => $this->name, 
            'code' => $this->code,  
            'description' => $this->description, 
            'warranty' => $this->warranty,
            'material' => $this->material,
            'delivery_time' => $this->delivery_time,
            'images' =>ImageResource::collection($this->images),
            'prices' =>PriceResource::collection($this->prices),
            'colors' =>ColorResource::collection($this->colors),
            'room_id' => $this->room_id,
            'category_id' => $this->category_id
        ];
    }
}
