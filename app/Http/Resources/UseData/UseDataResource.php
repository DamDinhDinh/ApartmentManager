<?php

namespace App\Http\Resources\UseData;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;
use App\Http\Resources\User\UserResource;

class UseDataResource extends JsonResource
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
            'service_name' => $this->usingService->service->name,
            'use_value_prev' => $this->use_value_prev,
            'use_value_curr' => $this->use_value_curr,
            'use_value' => $this->use_value,
            'use_date' => Carbon::parse($this->use_date)->format('m-Y'),
            'bill_status' => $this->bill == null ? 'Chưa có hóa đơn' : ($this->bill->status == 0 ? "Chưa thanh toán" : "Đã thanh toán"),
            'href' => [
                'using_service_show' => route('api.usingService.show', ['apartment' => $this->usingService->apartment_id, 'usingService' => $this->usingService->id]),
                'apartment_show' => route('api.apartment.show', ['apartment' => $this->usingService->apartment->id]),
                'service_show' => route('api.service.show', ['service' => $this->usingService->service->id]),
                'bill_show' => "",
                'user_paid' => $this->bill != null ? ($this->bill->user != null ? new UserResource($this->bill->user) : "Không có thông tin") : "Không có thông tin"
            ],
        ];
    }
}
