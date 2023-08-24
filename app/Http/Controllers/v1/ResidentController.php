<?php

namespace App\Http\Controllers\v1;

use Carbon\Carbon;
use App\Models\Resident;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\ResidentStoreRequest;

class ResidentController extends Controller
{
    public function store(ResidentStoreRequest $request)
    {
        try {
            $resident = new Resident();
            $resident->household_id = $request->household_id;
            $resident->first_name = $request->first_name;
            $resident->middle_name = $request->middle_name;
            $resident->last_name = $request->last_name;
            $resident->birth_date = $request->birth_date;
            $resident->age = Carbon::parse($request->birth_date)->age;
            $resident->sex = $request->sex;
            $resident->pregnant = ($request->sex == 'Male') ? "No" : $request->pregnant;
            $resident->civil_status = $request->civil_status;
            $resident->religion = $request->religion;
            $resident->contact = $request->contact;
            $resident->nationality = $request->nationality;
            $resident->household_head = $request->household_head;
            $resident->bona_fide = $request->bona_fide;
            $resident->resident_six_months = $request->resident_six_months;
            $resident->solo_parent = $request->solo_parent;
            $resident->voter = $request->voter;
            $resident->pwd = $request->pwd;
            $resident->disability = ($request->pwd == 'No') ? NULL : $request->disability;
            $resident->studying = $request->studying;
            $resident->highest_education = $request->highest_education;
            $resident->employed = $request->employed;
            $resident->job_title = $request->job_title;
            $resident->income = $request->income;
            $resident->income_classification = $this->getIncomeClassification($resident->income);
            $resident->save();
            return response()->json([
                'msg' => 'Resident saved successfully',
            ], JsonResponse::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json([
                'msg' => $e->getMessage()
            ]);
        }
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
