<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
        // $permission = [];
        // foreach ($this->getPermissionNames() as $key => $value) {
        //     $permission[] = __($value);
        // }

        return [
            'id'             => $this->id,
            'name'           => $this->name,
            'email'          => $this->email,
            'phone'          => $this->phone,
            'job_number'     => $this->job_number,
            'working_period' => $this->working_period,
            'date_of_hiring' => $this->date_of_hiring->format('Y-m-d'),
            'image'          => $this->image ? url('/storage') . '/' . $this->image : null,
            "permissions"    => $this->getPermissionNames(),
        ];
    }
}
