<?php

namespace App\Http\Controllers\v1;

use App\Models\Street;
use App\Models\Household;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\HouseholdStoreRequest;
use App\Http\Requests\HouseholdUpdateRequest;
use App\Http\Resources\HouseholdResource;


class HouseholdController extends Controller
{

    public function store(HouseholdStoreRequest $request)
    {
        try {
            $household = new Household();
            $household->street_id = $request->street_id;
            $household->house_number = $request->house_number;
            $household->waste_management = $request->waste_management;
            $household->toilet = $request->toilet;
            $household->dwelling_type = $request->dwelling_type;
            $household->ownership = $request->ownership;
            $household->save();
            return response()->json([
                'msg' => 'Household saved successfully',
            ], JsonResponse::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(['msg' => 'An error has occurred'], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function edit($id)
    {
        try {
            $household = Household::with('street')->findOrFail($id);
            return new HouseholdResource($household);
        } catch (\Exception $e) {
            return response()->json(['msg' => 'An error has occurred'], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function update(HouseholdUpdateRequest $request, $id)
    {
        try {
            $household = Household::findOrFail($id);
            $household->street_id = $request->street_id;
            $household->house_number = $request->house_number;
            $household->waste_management = $request->waste_management;
            $household->toilet = $request->toilet;
            $household->dwelling_type = $request->dwelling_type;
            $household->ownership = $request->ownership;
            $household->save();
            return response()->json([
                'msg' => 'Household updated successfully',
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['msg' => 'An error has occurred'], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function destroy($id)
    {
        try {
            $household = Household::findOrFail($id);
            $household->delete();
            return response()->json([
                'msg' => 'Household deleted successfully'
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['msg' => 'An error has occurred'], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
