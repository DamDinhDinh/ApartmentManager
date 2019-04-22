<?php

namespace App\Http\Resources\UsingService;

use Illuminate\Http\Resources\Json\JsonResource;

class UsingServiceCollection extends JsonResource
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
            'apartment_id' => $this->apartment_id,
            'apartment_name' => $this->apartment->name,
            'service_name' => $this->service->name,
            'service_id' => $this->service->id,
            'start_date' => $this->start_date,
            'expire_date' => $this->expire_date,
            'href' => [
                'using_service_show' => route('api.usingService.show', ['usingService' => $this->id])
            ]
        ];
    }
}
