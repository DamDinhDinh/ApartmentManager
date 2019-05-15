<?php

namespace App\Http\Resources\Bill;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

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
            'apartment_name' => $this->apartment != null ? $this->apartment->name : trans('messages.item_deleted'),
            'use_data_id' => $this->use_data_id,
            'use_value' => $this->use_value,
            'use_date' => $this->use_date,
            'service_id' => $this->service_id,
            'service_name' => $this->service != null ? $this->service->name : trans('messages.item_deleted'),
            'service_price' => $this->price,
            'bill_discount' => $this->discount,
            'bill_vat' => $this->vat,
            'bill_sum' => $this->sum,
            'bill_status' => $this->status == 0 ? trans('tableLabel.bill_not_paid_yet') : ($this->status == 1 ? trans('tableLabel.bill_paid') : trans('tableLabel.bill_not_create_yet')),
            'bill_paid_method' => $this->paid_method != null ? $this->paid_method : 'Chưa thanh toán',
            'bill_paid_date' => $this->paid_date != null ? Carbon::parse($this->paid_date)->format('d-m-Y H:i:s') : 'Chưa thanh toán',
            'bill_user_paid_name' => $this->user_name,
            'bill_updated_at' => Carbon::parse($this->updated_at)->format('d-m-Y H:i:s'),

        ];
    }
}
