<?php

namespace App\Http\Resources\UseData;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class UseDataCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'service_name' => $this->usingService->service->name,
            'use_value' => $this->use_value,
            'use_date' => Carbon::parse($this->use_date)->format('m-Y'),
            'bill_status' => $this->bill == null ? 'Chưa có hóa đơn' : ($this->bill->status == 0 ? "Chưa thanh toán" : "Đã thanh toán"),
            'href' => [
                'use_data_show' => route('api.useData.show', $this->id),
                'bill_show' => $this->bill != null ? route('api.bill.show', $this->bill->id) : 'Chưa có hóa đơn',
            ],
        ];
    }
}
