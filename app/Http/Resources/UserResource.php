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
            'first_name'     => $this->first_name,
            'family_name'    => $this->family_name,
            'full_name'      => $this->first_name . ' ' . $this->family_name,
            'email'          => $this->email,
            'address'        => $this->address,
            'second_address' => $this->second_address,
            'phone'          => $this->phone,
            'mobile'         => $this->mobile,
            'country'        => new CountryResource($this->country),
            'city'           => new CityResource($this->city),
            'post_code'      => $this->post_code,
            'image'          => $this->image ? url('/storage') . '/' . $this->image : null,
            "permissions"    => $this->getPermissionNames(),
        ];
    }
}
