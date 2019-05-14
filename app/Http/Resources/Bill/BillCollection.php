<?php

namespace App\Http\Resources\Bill;

use Illuminate\Http\Resources\Json\JsonResource;

class BillCollection extends JsonResource
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
            'apartment_name' => $this->usingService->apartment->name,
            'use_date' => $this->useData->use_date,
            'service_price' => $this->price,
            'bill_discount' => $this->discount,
            'bill_vat' => $this->vat,
            'bill_sum' => $this->sum,
            'bill_status' => $this->status,
            'bill_updated_at' => $this->updated_at,

            'href' => [
                'bill_show' => route('api.bill.show', $this->id),
            ]
        ];
    }
}
