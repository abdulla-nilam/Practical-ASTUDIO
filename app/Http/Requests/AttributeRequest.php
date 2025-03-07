<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttributeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:attributes,name'],
            'type' => ['required', 'string', 'in:text,date,number,select'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Attribute name is required.',
            'name.unique' => 'This attribute name already exists.',
            'type.required' => 'Attribute type is required.',
            'type.in' => 'Attribute type must be one of: text, date, number, select.',
        ];
    }
}
