<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class HouseholdUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'street_id' => ['integer', 'exists:streets,id'],
            'house_number' => ['required', 'max:255'],
            'waste_management' => ['required', 'in:Incineration,Composting,Recycled,Others'],
            'toilet' => ['required', 'in:Pail,Flushed,Others,None'],
            'dwelling_type' => ['required', 'in:Concrete,Semiconcrete,Wood,Others'],
            'ownership' => ['required', 'in:Rented,Owned,Shared,Informal'],
            'image' => ['image', 'max:2048']
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => 'The given data was invalid.',
            'errors' => $validator->errors()
        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
}
