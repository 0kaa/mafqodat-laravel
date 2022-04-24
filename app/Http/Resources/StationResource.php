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
            'id'            => $this->id,
            'type'          => [
                'name'      => __($this->type),
                'value'     => $this->type,
            ],
            'name'          => $this->name,
            'name_ar'       => $this->name_ar,
            'name_en'       => $this->name_en,
            'number'        => $this->number,
            'description'   => substr($this->description, 0, 50),
            'location'      => $this->location,
            'lat'           => $this->lat,
            'lng'           => $this->lng,
        ];
    }
}
