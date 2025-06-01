<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Support\Str;


class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'nis' => [
                'required',
                'numeric',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'nis' => $input['nis'],
            'barcode' => 'BRW-' . $input['nis'] . '-' . Carbon::now()->format('YmdHis') . '-' . Str::random(4), //' BRW - ' . $user->user_id . ' - ' . Carbon::now()->format(' YmdHis ') . ' - ' . Str::random(4);'
            'password' => Hash::make($input['password']),
        ]);

        $user->assignRole('member');

        return $user;
    }
}
