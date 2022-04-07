<?php

namespace App\Http\Resources;

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
            'id'         => $this->id,
            'user_name'  => $this->user->first_name . ' ' . $this->user->family_name,
            'modal_type' => $this->modal_type,
            'modal_name' => $this->modal_name,
            'action'     => $this->action,
            'message'    => $this->message,
            'created_at' => $this->created_at->format('Y-m-d H:i A'),
        ];
    }
}
