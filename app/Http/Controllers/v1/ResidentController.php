<?php

namespace App\Http\Controllers\v1;

use Carbon\Carbon;
use App\Models\Resident;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class ResidentController extends Controller
{
    public function store(Request $request)
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
            $resident->job_title = ($resident->employed == 'No') ? NULL : $request->job_title;
            $resident->income = ($resident->employed == 'No') ? 0 : $request->income;
            $resident->income_classification = ($resident->employed == 'No') ? 'Poor' : $request->income_classification;
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
}
