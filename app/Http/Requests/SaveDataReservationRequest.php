<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveDataReservationRequest extends FormRequest
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
        return [
            'restaurant' => 'required',
            'meal' => 'required',
            'amount_people' => 'required|numeric|min:0|max:10',
            'dishes' => 'required|array',
            'dishes.*' => 'required|string',
            'quantities' => 'required|array',
            'quantities.*' => 'required|numeric',
        ];
    }
}
