<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'longitude'=>$this->longitude,
            'latitude'=>$this->latitude,
            'event_date'=>$this->event_date,
            'created_at'=>$this->created_at,
            'playlists'=>$this->playlists
        ];
    }
}
