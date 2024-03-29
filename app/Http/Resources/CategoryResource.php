<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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

            'id'    => $this->id,
            'name'  => $this->name,
            'slug'  => $this->slug,
            'storage' => $this->storage ? [
                'id'   => $this->storage->id,
                'name' => $this->storage->name,
            ] : null,
            'image' => $this->image ? url('/storage') . '/' . $this->image : null,
        ];
    }
}
