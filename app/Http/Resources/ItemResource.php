<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
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
            'id'                => $this->id,
            'details'           => $this->details,
            'category'          => new CategoryResource($this->category),
            'station'           => new StationResource($this->station),
            'storage'           => $this->storage,
            'date'              => $this->date->format('Y-m-d'),
            'time'              => $this->time->format('h:i A'),
            'fulldate'          => $this->date->format('Y-m-d') . ' - ' . $this->time->format('h:i A'),
            'location'          => $this->location,
            'primary_colour'    => $this->primary_colour,
            'secondary_colour'  => $this->secondary_colour,
            'tertiary_colour'   => $this->tertiary_colour,
            'description'       => $this->description,
            'image'             => $this->image ? url('/storage') . '/' . $this->image : null,
            'is_delivered'      => $this->is_delivered == 1 ? __('yes') : __('no'),
            'first_name'        => $this->first_name,
            'surname'           => $this->surname,
            'address'           => $this->address,
            'secondary_address' => $this->secondary_address,
            'city'              => $this->city,
            'postcode'          => $this->postcode,
            'phone'             => $this->phone,
            'mobile'            => $this->mobile,
            'email'             => $this->email,
        ];
    }
}
