<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class LogResource extends JsonResource
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
            'id'      => $this->id,
            'item_id' => $this->item_id,
            'message' => $this->message,
            'date'    => $this->created_at->format('Y-m-d'),
            'time'    => $this->created_at->format('h:i A'),
        ];
    }
}
