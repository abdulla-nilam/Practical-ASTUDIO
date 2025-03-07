<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'in:active,inactive,pending'],
        ];
    }

    public function messages()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'in:active,inactive,pending'],
            'user_ids' => ['sometimes', 'array'],
            'user_ids.*' => ['exists:users,id'],
            'attributes' => ['sometimes', 'array'],
            'attributes.*.attribute_id' => ['required', 'exists:attributes,id'],
            'attributes.*.value' => ['required', 'string', 'max:500'],
        ];
    }
}
