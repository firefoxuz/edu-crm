<?php

namespace Modules\Subject\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubjectRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:64',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
