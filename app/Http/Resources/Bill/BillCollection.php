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
            'bill_name' => $this->name,
            'use_date' => $this->useData->use_date,
            'service_price' => $this->price,
            'bill_discount' => $this->discount,
            'bill_vat' => $this->vat,
            'bill_sum' => $this->sum,
            'bill_status' => $this->status == 0 ? trans('tableLabel.bill_not_paid_yet') : ($this->status == 1 ? trans('tableLabel.bill_paid') : trans('tableLabel.bill_not_create_yet')),
            'bill_updated_at' => $this->updated_at,

            'href' => [
                'bill_show' => route('api.bill.show', $this->id),
            ]
        ];
    }
}
