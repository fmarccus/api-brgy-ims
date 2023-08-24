<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class ResidentStoreRequest extends FormRequest
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
            'household_id' => ['required', 'exists:households,id'],
            'first_name' => ['required', 'max:255'],
            'middle_name' => ['max:255'],
            'last_name' => ['required', 'max:255'],
            'birth_date' => ['required', 'date'],
            'sex' => ['required', 'in:Male,Female'],
            'pregnant' => ['nullable'],
            'civil_status' => ['required', 'in:Single,Married,Annulled,Separated,Widowed'],
            'religion' => ['required', 'in:Catholic,Islam,INC,PIC,Adventist,Baptist,UCCP,Jehova,COC,Others,None'],
            'contact' => ['required', 'max:255'],
            'nationality' => ['required', 'in:Filipino,Others'],
            'household_head' => ['required', 'in:Yes,No'],
            'bona_fide' => ['required', 'in:Yes,No'],
            'resident_six_months' => ['required', 'in:Yes,No'],
            'solo_parent' => ['required', 'in:Yes,No'],
            'voter' => ['required', 'in:Yes,No'],
            'pwd' => ['required', 'in:Yes,No'],
            'disability' => ['nullable'],
            'studying' => ['required', 'in:Yes,No'],
            'highest_education' => ['required', 'in:None,Elementary,JHS,SHS,College,Postgrad'],
            'employed' => ['required', 'in:Yes,No'],
            'job_title' => ['nullable'],
            'income' => ['nullable', 'numeric', 'min:0', 'max:10000000000'],
            'income_classification' => ['nullable'],
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
