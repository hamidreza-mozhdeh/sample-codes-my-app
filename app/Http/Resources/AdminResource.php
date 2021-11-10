<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class AdminResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable
     */
    public function toArray($request): array
    {
        return [
            'id'            => $this->id,
            'first_name'    => $this->first_name,
            'surname'       => $this->surname,
            'full_name'     => $this->full_name,
            'email'         => $this->email,
            'status'        => $this->status,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
        ];
    }
}
