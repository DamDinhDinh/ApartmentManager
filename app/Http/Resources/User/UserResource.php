<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name != null ? $this->name : "null",
            'email' => $this->email != null ? $this->email : "null",
            'phone_number' => $this->phone_number != null ? $this->name : "null",
            'href' => [
                'apartment' => $this->apartment != null ? route('api.apartment.show', ['id' => $this->apartment->id]) : "null"
            ],
        ];
    }
}
