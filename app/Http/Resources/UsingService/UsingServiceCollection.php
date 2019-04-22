<?php

namespace App\Http\Resources\UsingService;

use Illuminate\Http\Resources\Json\Resource;

class UsingServiceCollection extends Resource
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
            'apartment_name' => $this->apartment->name,
            'service_name' => $this->service->name,
            'use_data' => $this->use_datas != null ? $this->use_datas->count() : 0,
            'start_date' => $this->start_date,
            'expire_date' => $this->expire_date,
            'href' => [
                'using_service_show' => ""
            ]
        ];
    }
}
