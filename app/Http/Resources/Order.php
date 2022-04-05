<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Product;
use App\Http\Resources\Product as ProductResource;

class Order extends JsonResource
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
            'amount' => $this->amount,
            'user_id' => $this->user_id,
            'bill_id' => $this->bill_id,
            'product' => new ProductResource(Product::find($this->product_id)),
        ];

       
    }
}
