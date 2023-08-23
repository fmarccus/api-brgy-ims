<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HouseholdResource extends JsonResource
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
            'street_id' => $this->street_id,
            'house_number' => $this->house_number,
            'waste_management' => $this->waste_management,
            'toilet' => $this->toilet,
            'dwelling_type' => $this->dwelling_type,
            'ownership' => $this->ownership,

        ];
    }
}
