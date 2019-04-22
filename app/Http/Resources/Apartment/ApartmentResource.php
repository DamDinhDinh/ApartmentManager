<?php

namespace App\Http\Resources\Apartment;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\UsingService\UsingServiceCollection;;

class ApartmentResource extends JsonResource
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
            'address' => $this->address,
            'users' => $this->users->count() > 0 ? ( UserCollection::collection($this->users)) : 0,
            'using_services' => $this->usingServices->count() > 0 ? (UsingServiceCollection::collection($this->usingServices)) : 0
        ];
    }
}
