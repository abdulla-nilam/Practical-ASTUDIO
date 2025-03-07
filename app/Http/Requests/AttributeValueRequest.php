<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttributeValueRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'attribute_id' => ['sometimes', 'exists:attributes,id'],
            'project_id' => ['sometimes', 'exists:projects,id'],
            'value' => ['required', 'string', 'max:500'],
        ];
    }

    public function messages()
    {
        return [
            'attribute_id.required' => 'The attribute ID is required and cannot be empty.',
            'attribute_id.exists' => 'The selected attribute does not exist.',
            'project_id.required' => 'The project ID is required and cannot be empty.',
            'project_id.exists' => 'The selected project does not exist.',
            'value.required' => 'The attribute value is required and cannot be empty.',
            'value.string' => 'The attribute value must be a valid string.',
            'value.max' => 'The attribute value should not exceed 500 characters.',
        ];
    }

}
