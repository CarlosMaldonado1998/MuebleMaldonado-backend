<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Price extends JsonResource
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
            'dimension' => $this->dimension,
            'value' => $this->value,
            'product_id' => $this->product_id,
        ];
    }
}
