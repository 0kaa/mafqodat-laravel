<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'type'        => $this->type,
            'name'        => $this->name,
            'number'      => $this->number,
            'description' => $this->description,
            'location'    => $this->location,
            'lat'         => $this->lat,
            'lng'         => $this->lng,
        ];
    }
}
