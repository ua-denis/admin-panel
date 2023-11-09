<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreNewsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'headline' => 'required|string|max:255',
            'body' => 'required|string',
        ];
    }
}
