<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class FindRequest extends FormRequest
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
            'phone' => ['nullable', 'string', 'min:11', 'max:11'],
            'email' => ['nullable', 'email', 'max:255']
        ];
    }


    public function prepareForValidation()
    {
        if (empty($this->phone)) return;

        $phone = preg_replace("/[^0-9]/", "", $this->phone);

        $this->merge([
            'phone' => $phone
        ]);
    }


    public function after(): array
    {
        return [
            function (Validator $validator) {
                if (empty($this->phone) && empty($this->email)) {
                    $validator->errors()->add(
                        'phone',
                        'Одно из полей обязательно'
                    );
                };
            }
        ];
    }
}
