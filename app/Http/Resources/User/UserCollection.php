<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserCollection extends JsonResource
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
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'apartment_name' => $this->apartment != null ? $this->apartment->name : null,
            'href' => [
                'user_show' => route('api.user.show', ['id' => $this->id]),
                'apartment_show' => $this->apartment != null ? route('api.apartment.show', ['id' => $this->apartment->id]): null,
            ]
        ];
    }
}
