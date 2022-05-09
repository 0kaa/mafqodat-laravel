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
            'user'              => [
                'id'                => $this->user->id,
                'first_name'        => $this->user->first_name,
                'family_name'       => $this->user->family_name,
                'fullname'          => $this->user->first_name . ' ' . $this->user->family_name,
            ],
            'storage'           => $this->storage,
            'date'              => $this->date->format('Y-m-d'),
            'time'              => $this->time->format('h:i'),
            'fulldate'          => $this->date->format('Y-m-d') . ' - ' . $this->time->format('h:i A'),
            'location'          => $this->location,
            'primary_colour'    => $this->primary_colour,
            'secondary_colour'  => $this->secondary_colour,
            'tertiary_colour'   => $this->tertiary_colour,
            'details'           => $this->details,
            'image'             => $this->image ? url('/storage') . '/' . $this->image : null,
            'is_delivered'      => $this->is_delivered == 1 ? 1 : 0,
            'first_name'        => $this->first_name,
            'surname'           => $this->surname,
            'address'           => $this->address,
            'secondary_address' => $this->secondary_address,
            'cost'              => $this->cost,
            'type'              => $this->type,
            'city'              => new CityResource($this->city),
            'country'           => new CountryResource($this->country),
            'postcode'          => $this->postcode,
            'phone'             => $this->phone,
            'mobile'            => $this->mobile,
            'email'             => $this->email,
        ];
    }
}
