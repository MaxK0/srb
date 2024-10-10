<?php

namespace App\Http\Requests\Position;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('positions')
                    ->where('branch_id', $this->branch_id)
            ],
        ];
    }

    protected function prepareForValidation()
    {
        if (! isset($this->branch['id'])) return back()->withErrors([
            'branch' => "Поле 'branch' обязательно для заполнения"
        ]);

        $this->merge([
            'branch_id' => $this->branch['id']
        ]);
    }
}
