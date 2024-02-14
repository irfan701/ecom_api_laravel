<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResearchRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|unique:research',
            'phone'=>'required|unique:research',
            'address'=>'required',
//            'password' => [
//                'required',
//                'string',
//                Password::min(8)->mixedCase()->numbers()->symbols()->uncompromised(),
//                'confirmed',
//            ]
        ];
    }
}
