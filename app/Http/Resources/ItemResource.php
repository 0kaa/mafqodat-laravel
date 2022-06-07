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
            'report_number'     => $this->report_number,
            'report_type'       => $this->report_type,
            'informer_name'     => $this->informer_name ? $this->informer_name : null,
            'informer_phone'    => $this->informer_phone ? $this->informer_phone : null,
            'category'          => new CategoryResource($this->category),
            'station'           => new StationResource($this->station),
            'user'              => [
                'id'                => $this->user->id,
                'first_name'        => $this->user->name,
            ],
            'storage'           => [
                'id'                => $this->storage->id,
                'name'              => $this->storage->name,
            ],
            'date'              => $this->date->format('Y-m-d'),
            'time'              => $this->time->format('h:i'),
            'fulldate'          => $this->date->format('Y-m-d') . ' - ' . $this->time->format('h:i A'),
            'location'          => $this->location,
            'details'           => $this->details,
            // 'image'             => $this->image ? url('/storage') . '/' . $this->image : null,
            'media'             => $this->itemMedia->map(function ($itemMedia) {
                return new MediaResource($itemMedia->media);
            }),
            'is_delivered'      => $this->is_delivered == 1 ? 1 : 0,
            'full_name'         => $this->full_name,
            'cost'              => $this->cost,
            'type'              => $this->type,
            'phone'             => $this->phone,
            'delivery_date'     => $this->delivery_date ? $this->delivery_date->format('Y-m-d | h:i A') : null,
        ];
    }
}
