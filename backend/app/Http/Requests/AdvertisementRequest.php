<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class AdvertisementRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return match ($this->method()) {
            'POST' => [
                'title' => 'required|string|max:200',
                'description' => 'required|string|max:1000',
                'price'=> 'required|decimal:2|min:0.01|regex:/^\d{1,6}(\.\d{0,2})?$/',
                'links' =>'array|max:3',
                'links.*' =>'required|regex:/^(?!\s*["\'\s]+\s*$).+$/',
            ],
            'GET' => [
                'order' => 'in:price,created_at',
                'orderBy' => 'in:asc,desc'
            ]
        };
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors'      => $validator->errors()
        ], 422));
    }
}
