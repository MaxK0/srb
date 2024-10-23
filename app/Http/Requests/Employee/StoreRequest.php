<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

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
            'branch_id' => ['required', 'integer', 'exists:branches,id'],
            'position_id' => ['required', 'integer', 'exists:positions,id'],
            'sex' => ['required', 'string', 'max:1'],
            'phone' => ['required', 'string', 'min:11', 'max:11', 'unique:users'],
            'work_phone' => ['nullable', 'string', 'min:11', 'max:11'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'patronymic' => ['nullable', 'string', 'max:255'],
            'password' => ['required', 'string', Password::default(), 'confirmed']
        ];
    }


    public function prepareForValidation()
    {
        if (! empty($this->branch['id'])) {
            $dataMerge['branch_id'] = $this->branch['id'];
        }

        if (! empty($this->position['id'])) {
            $dataMerge['position_id'] = $this->position['id'];
        }

        if (! empty($this->sex['id'])) {
            $dataMerge['sex'] = $this->sex['id'];
        }

        if (! empty($this->phone)) {
            $dataMerge['phone'] = preg_replace("/[^0-9]/", "", $this->phone);
        }

        if (! empty($this->work_phone)) {
            $dataMerge['work_phone'] = preg_replace("/[^0-9]/", "", $this->work_phone);
        }

        $this->merge($dataMerge);
    }
}
