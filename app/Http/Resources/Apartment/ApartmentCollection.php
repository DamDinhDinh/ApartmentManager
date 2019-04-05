<?php

namespace App\Http\Resources\Apartment;

use Illuminate\Http\Resources\Json\JsonResource;

class ApartmentCollection extends JsonResource
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
            'name' => $this->name,
            'address' => $this->address,
            'user_number' => $this->users->count(),
            'href' => [
                'apartment' => route('api.apartment.show', ['id' => $this->id])
            ],
        ];
    }
}
