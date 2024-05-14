<?php

namespace App\Http\Resources\API\MainDisplayResource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'requested_users_id'=>$this->requested_users_id,
            'routings_id'=>$this->routings_id,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
