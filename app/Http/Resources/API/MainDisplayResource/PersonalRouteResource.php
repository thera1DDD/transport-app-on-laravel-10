<?php

namespace App\Http\Resources\API\MainDisplayResource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PersonalRouteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'route_type'=>$this->route_type,
            'name'=>$this->name,
            'description'=>$this->description,
            'price'=>$this->price,
            'from_place'=>$this->from_place,
            'to_place'=>$this->to_place,
            'start_time'=>$this->start_time,
            'end_time'=>$this->end_time,
            'load_type'=>$this->load_type,
            'load_size'=>$this->load_size,
            'status'=>$this->status,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'owners_id'=>$this->owners_id,
        ];
    }
}
