<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResidentResource extends JsonResource
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
            'household_id' => $this->household_id,
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'full_name' => $this->first_name . " " . $this->middle_name . " " . $this->last_name,
            'birth_date' => $this->birth_date,
            'age' => $this->age,
            'sex' => $this->sex,
            'pregnant' => $this->pregnant,
            'civil_status' => $this->civil_status,
            'religion' => $this->religion,
            'contact' => $this->contact,
            'nationality' => $this->nationality,
            'household_head' => $this->household_head,
            'bona_fide' => $this->bona_fide,
            'resident_six_months' => $this->resident_six_months,
            'solo_parent' => $this->solo_parent,
            'voter' => $this->voter,
            'pwd' => $this->pwd,
            'disability' => $this->disability,
            'studying' => $this->studying,
            'highest_education' => $this->highest_education,
            'employed' => $this->employed,
            'job_title' => $this->job_title,
            'income' => $this->income,
            'income_classification' => $this->income_classification,
        ];
    }
}
