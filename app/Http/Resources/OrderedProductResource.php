<?php

namespace App\Http\Resources;

use App\Models\OrderStatus;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderedProductResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $status = $this->status;
        return [
            'id' => $this->id,
            'name' => $this->name,
            'sku' => $this->sku,
            'quantity' => $this->quantity,
            'amount' => $this->amount,
            'status' => OrderStatus::getLabel(OrderStatus::from($status)),
            'created_at' => $this->created_at,
        ];
    }
}
