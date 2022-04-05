<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;
use App\Models\Order;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\OrderCollection;

class Bill extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $orders = Order::select('*')->where('bill_id',$this->id)->get();
        $ordersCollection = new OrderCollection($orders);

        return [
            'id' => $this->id,
            'date' => $this->date,
            'type_pay' => $this->type_pay,
            'state' => $this->state,
            'iva' => $this->iva,
            'val_iva' => $this->val_iva,
            'subtotal' => $this->subtotal,  
            'total' => $this->total, 
            'user_id' => new UserResource(User::find($this->user_id)),
            'orders' => $ordersCollection
        ];
    }
}
