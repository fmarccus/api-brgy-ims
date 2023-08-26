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
            'date_created' => $this->created_at->format('m/d/y'),
            'last_updated' => $this->updated_at->format('m/d/y'),
            'resident_count' => $this->residents->count(),
            'household_income' => '₱' . number_format($this->residents->sum('income'), 2),
            'income_classification' => $this->getIncomeClassification($this->residents->sum('income'))
        ];
    }
    private function getIncomeClassification($income)
    {
        if ($income > 0 && $income <= 10957) {
            $income_classification = "Poor";
        } elseif ($income > 10957 && $income <= 21194) {
            $income_classification = "Low income";
        } elseif ($income > 21194 && $income <= 43828) {
            $income_classification = "Lower middle class";
        } elseif ($income > 43828 && $income <= 76669) {
            $income_classification = "Middle class";
        } elseif ($income > 76670 && $income <= 131484) {
            $income_classification = "Upper middle class";
        } elseif ($income > 131484 && $income <= 219140) {
            $income_classification = "High income";
        } elseif ($income > 219140) {
            $income_classification = "Rich";
        } elseif ($income === NULL) {
            $income_classification = NULL;
        } else {
            $income_classification = "No data";
        }
        return $income_classification;
    }
}
