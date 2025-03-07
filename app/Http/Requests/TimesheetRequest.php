<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TimesheetRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'task_name' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date', 'before_or_equal:today'],
            'hours' => ['required', 'integer', 'min:1', 'max:24'],
            'user_id' => ['required', 'exists:users,id'],
            'project_id' => ['required', 'exists:projects,id'],
        ];
    }

    public function messages()
    {
        return [
            'task_name.required' => 'Task name is required.',
            'date.required' => 'Date is required.',
            'date.before_or_equal' => 'Date cannot be in the future.',
            'hours.required' => 'Hours must be provided.',
            'hours.min' => 'Hours must be at least 1.',
            'hours.max' => 'You cannot log more than 24 hours.',
            'user_id.exists' => 'The selected user does not exist.',
            'project_id.exists' => 'The selected project does not exist.',
        ];
    }
}
