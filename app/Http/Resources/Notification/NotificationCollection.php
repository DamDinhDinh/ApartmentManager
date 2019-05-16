<?php

namespace App\Http\Resources\Notification;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class NotificationCollection extends JsonResource
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
            "id" => $this->id,
            "created_by" => $this->user != null ? $this->user->name : "Unknow",
            "title" => $this->title,
            "created_at" => Carbon::parse($this->created_at)->format("H:m d-m-Y"),
            "updated_at" =>Carbon::parse($this->updated_at)->format("H:m d-m-Y"),

            'href' => [
                'notification_show' => route('api.notification.show', $this->id),
            ]
        ];
    }
}
