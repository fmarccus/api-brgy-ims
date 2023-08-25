<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StreetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->image,
            'last_updated' => $this->updated_at->format('m/d/y'),
            'household_count' => $this->households->count(),
            'resident_count' => $this->households->flatMap->residents->count()
        ];
    }
}
