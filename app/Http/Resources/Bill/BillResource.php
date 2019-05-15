<?php

namespace App\Http\Resources\Bill;

use Illuminate\Http\Resources\Json\JsonResource;

class BillResource extends JsonResource
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
            'apartment_id' => $this->apartment_id,
            'apartment_name' => $this->usingService->apartment->name,
            'use_data_id' => $this->useData->id,
            'use_value' => $this->useData->use_value,
            'use_date' => $this->useData->use_date,
            'service_id' => $this->service_id,
            'service_name' => $this->usingService->service->name,
            'service_price' => $this->price,
            'bill_discount' => $this->discount,
            'bill_vat' => $this->vat,
            'bill_sum' => $this->sum,
            'bill_status' => $this->status == 0 ? trans('tableLabel.bill_not_paid_yet') : ($this->status == 1 ? trans('tableLabel.bill_paid') : trans('tableLabel.bill_not_create_yet')),
            'bill_paid_method' => $this->paid_method != null ? $this->paid_method : 'Chưa thanh toán',
            'bill_paid_date' => $this->paid_date != null ? $this->paid_date : 'Chưa thanh toán',
            'bill_updated_at' => $this->updated_at,

        ];
    }
}
