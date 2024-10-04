<?php

namespace App\Http\Requests\Branch;

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
            'title' => ['required', 'string', 'max:255'],
            'city_id' => ['required', 'integer', 'exists:cities,id'],
            'business_id' => ['required', 'integer', 'exists:businesses,id'],
            'address' => ['required', 'string', 'max:255'],
            'information' => ['nullable', 'string'],
        ];
    }

    protected function prepareForValidation()
    {
        if (! isset($this->city['id'])) return back()->withErrors([
            'city' => "Поле 'city' обязательно для заполнения."
        ]);

        if (! isset($this->business['id'])) return back()->withErrors([
            'business' => "Полу 'business' обязательно для заполнения."
        ]);

        $this->merge([
            'city_id' => $this->city['id'],
            'business_id' => $this->business['id']
        ]);
    }
}
