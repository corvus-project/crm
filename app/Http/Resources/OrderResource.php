<?php

namespace App\Http\Resources;

use App\Models\OrderStatus;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'account_name' => $this->account_name,
            'account_number' => $this->account_number,
            'order_number' => $this->order_number,
            'status' => OrderStatus::getLabel(OrderStatus::from($status)),
            'products' => OrderedProductResource::collection($this->whenLoaded('ordered_products')),
            'order_date' => $this->order_date,
            'created_at' => $this->created_at,
        ];
    }
}
