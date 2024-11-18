<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class HireRequest extends FormRequest
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
            'branch_id' => ['required', 'integer', 'exists:branches,id'],
            'position_id' => ['required', 'integer', 'exists:positions,id'],
            'work_phone' => ['nullable', 'string', 'min:11', 'max:11']
        ];
    }

    public function prepareForValidation()
    {
        $dataMerge = [];

        if (! empty($this->branch['id'])) {
            $dataMerge['branch_id'] = $this->branch['id'];            
        }

        if (! empty($this->position['id'])) {
            $dataMerge['position_id'] = $this->position['id'];
        }

        if (! empty($this->work_phone)) {
            $dataMerge['work_phone'] = preg_replace("/[^0-9]/", "", $this->work_phone);
        }
        
        $this->merge($dataMerge);
    }
}
