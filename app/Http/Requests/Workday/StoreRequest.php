<?php

namespace App\Http\Requests\Workday;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'date_start' => ['required', 'date'],
            'days_work' => ['required', 'integer', 'min:0'],
            'days_rest' => ['required', 'integer', 'min:0'],
            'time_start' => ['required', 'date'],
            'time_end' => ['required', 'date'],
        ];
    }
}
