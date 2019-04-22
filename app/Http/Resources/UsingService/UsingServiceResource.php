<?php

namespace App\Http\Resources\UsingService;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UseData\UseDataCollection;

class UsingServiceResource extends JsonResource
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
            'apartment_name' => $this->apartment->name,
            'service_name' => $this->service->name,
            'service_type' => $this->service->type == 0 ? "Mặc định" : "Tùy chọn",
            'payment_method' => $this->service->payment_method == 1 ? "Theo tháng" : $this->payment_method == 2 ? "Theo ngày" : "null",
            'use_method' => $this->service->payment_method == 1 ? "Không thay đổi" : $this->payment_method == 2 ? "Thay đổi" : "null",
            'price' => $this->service->price,
            'description' => $this->service->description,
            'use_data' => $this->useDatas != null ? UseDataCollection::collection($this->useDatas) : 0,
            'start_date' => $this->start_date,
            'expire_date' => $this->expire_date,
            'href' => [
                'apartment_show' => route('api.apartment.show', ['id' => $this->apartment_id]),
                'service_show' => route('api.service.show', ['service' => $this->service_id])
            ]
        ];
    }
}
