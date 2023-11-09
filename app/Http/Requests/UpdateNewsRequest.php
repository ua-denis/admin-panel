<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNewsRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'headline' => 'sometimes|required|string|max:255',
            'body' => 'sometimes|required|string',
        ];
    }
}
