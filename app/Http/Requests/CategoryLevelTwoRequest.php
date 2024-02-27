<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryLevelTwoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'cat1_id'=>'required|string|max:255',
            'cat2_name'=>'required|string|max:255',

        ];
    }
}
