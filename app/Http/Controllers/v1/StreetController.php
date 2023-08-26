<?php

namespace App\Http\Controllers\v1;

use App\Models\Street;
use App\Models\Household;
use App\Http\Controllers\Controller;
use App\Http\Resources\StreetResource;
use App\Http\Requests\StreetStoreRequest;
use App\Http\Requests\StreetUpdateRequest;
use App\Http\Resources\HouseholdResource;
use Illuminate\Http\JsonResponse;


class StreetController extends Controller
{
    public function index()
    {
        try {
            $streetsPerPage = 6;
            $streets = StreetResource::collection(Street::simplePaginate($streetsPerPage));

            $streetsCount = Street::count();
            $pageCount = count(Street::all()) / $streetsPerPage;
            return response()->json([
                'streets' => $streets,
                'streets_count' => $streetsCount,
                'page_count' => ceil($pageCount)
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['msg' => 'An error has occurred'], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function store(StreetStoreRequest $request)
    {
        try {
            $street = new Street();
            $street->name = $request->name;
            if ($request->hasFile('image')) {
                $path = public_path('street_images/');
                $imageName = md5(rand(1000, 10000)) . '-' . time() . '.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->move($path, $imageName);
                $street->image = $imageName;
            }
            $street->save();
            return response()->json([
                'msg' => 'Street saved successfully',
            ], JsonResponse::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(['msg' => 'An error has occurred'], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function edit($id)
    {
        try {
            return new StreetResource(Street::findOrFail($id));
        } catch (\Exception $e) {
            return response()->json(['msg' => 'An error has occurred'], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function update(StreetUpdateRequest $request, $id)
    {
        try {
            $street = Street::findOrFail($id);
            $imageNameOld = $street->image;
            $street->name = $request->name;
            if ($request->hasFile('image')) {
                $path = public_path('street_images/');
                $imageName = md5(rand(1000, 10000)) . '-' . time() . '.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->move($path, $imageName);
                unlink(public_path('street_images/' . $imageNameOld));
                $street->image = $imageName;
            } else {
                $street->image = $imageNameOld;
            }
            $street->save();
            return response()->json([
                'msg' => 'Street updated successfully',
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['msg' => 'An error has occurred'], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id)
    {
        try {
            $street = Street::findOrFail($id);
            $image = $street->image;
            if ($street->delete()) {
                if (file_exists(public_path('street_images/' . $image))) {
                    unlink(public_path('street_images/' . $image));
                }
            }
            return response()->json([
                'msg' => 'Street deleted successfully'
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['msg' => 'An error has occurred'], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function households($id)
    {
        try {
            $streetName = Street::where('id', $id)->get()->pluck('name')->first();
            $householdsPerPage = 20;
            $households = HouseholdResource::collection(Household::with('street')->where('street_id', $id)->simplePaginate($householdsPerPage));
            $householdsCount = Household::where('street_id', $id)->count();
            $pageCount = count(Household::where('street_id', $id)->get()) / $householdsPerPage;
            return response()->json([
                'street_name' => $streetName,
                'households' => HouseholdResource::collection($households),
                'households_count' => $householdsCount,
                'page_count' => ceil($pageCount)
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['msg' => 'An error has occurred'], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
