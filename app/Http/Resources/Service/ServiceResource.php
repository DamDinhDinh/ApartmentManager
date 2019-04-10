<?php

namespace App\Http\Resources\Service;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'payment_method' => $this->payment_method == 1 ? "Theo tháng" : $this->payment_method == 2 ? "Theo ngày" : "null",
            'use_method' => $this->payment_method == 1 ? "Không thay đổi" : $this->payment_method == 2 ? "Thay đổi" : "null",
            'price' => $this->price,
            'description' => $this->description
        ];
    }
}
