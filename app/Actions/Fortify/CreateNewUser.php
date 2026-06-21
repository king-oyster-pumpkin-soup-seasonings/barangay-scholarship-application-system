<?php

namespace App\Actions\Fortify;

use App\Concerns\PasswordValidationRules;
use App\Concerns\ProfileValidationRules;
use App\Models\User;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules, ProfileValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            ...$this->profileRules(),
            'phone' => ['required', 'string', 'max:20'],
            'birthdate' => ['required', 'date', 'before_or_equal:today'],
            'age' => ['required', 'integer', 'min:15', 'max:167', $this->birthdateMatchesAgeRule($input)],
            'gender' => ['required', Rule::in(['male', 'female', 'non_binary', 'prefer_not_to_say'])],
            'pronouns' => ['required', Rule::in(['he_him', 'she_her', 'they_them', 'prefer_not_to_say'])],
            'password' => $this->passwordRules($input),
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'phone' => $input['phone'],
            'birthdate' => $input['birthdate'],
            'age' => $input['age'],
            'sex' => in_array($input['gender'], ['male', 'female'], true) ? $input['gender'] : null,
            'gender' => $input['gender'],
            'pronouns' => $input['pronouns'],
            'role' => 'user',
            'password' => $input['password'],
        ]);
    }

    /**
     * @param  array<string, string>  $input
     */
    private function birthdateMatchesAgeRule(array $input): \Closure
    {
        return function (string $attribute, mixed $value, \Closure $fail) use ($input): void {
            if (empty($input['birthdate']) || ! is_numeric($value)) {
                return;
            }

            try {
                $birthdate = CarbonImmutable::parse($input['birthdate']);
            } catch (\Throwable) {
                return;
            }

            if ($birthdate->isFuture() || $birthdate->age !== (int) $value) {
                $fail('The age must match the date of birth.');
            }
        };
    }
}
