<?php

namespace App\Actions\Fortify;

use App\Models\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        if ($input['sex']['id']) {
            $input['sex'] = $input['sex']['id'];
        }

        $input['phone'] = preg_replace("/[^0-9]/", "", $input['phone']);

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['nullable', 'string', 'max:255'],
            'patronymic' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['nullable', 'string', 'max:11', 'unique:users'],
            'sex' => ['required', 'string', 'max:1'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->after(function ($validator) use ($input) {
            if (empty($input['email']) && empty($input['phone'])) {
                $validator->errors()->add('email', 'The email or phone field is required.');
                $validator->errors()->add('phone', 'The email or phone field is required.');
            }
        })->validate();

        return User::create($input);
    }
}
