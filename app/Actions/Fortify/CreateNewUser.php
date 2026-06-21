<?php

namespace App\Actions\Fortify;

use App\Concerns\PasswordValidationRules;
use App\Concerns\ProfileValidationRules;
use App\Models\User;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
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
            'age' => ['required', 'integer', 'min:18', 'max:120', $this->birthdateMatchesAgeRule($input)],
            'gender' => ['required', Rule::in(['male', 'female', 'non_binary', 'prefer_not_to_say'])],
            'pronouns' => ['required', Rule::in(['he_him', 'she_her', 'they_them', 'prefer_not_to_say'])],
            'address_street' => ['required', 'string', 'max:255'],
            'address_city' => ['required', 'string', 'max:255'],
            'address_province_state' => ['required', 'string', 'max:255'],
            'address_country' => ['required', Rule::in(['PH', 'US'])],
            'address_postal_code' => ['required', 'string', 'max:20', $this->postalCodeRule($input)],
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
            'address' => $this->fullAddress($input),
            'address_street' => $input['address_street'],
            'address_city' => $input['address_city'],
            'address_province_state' => $input['address_province_state'],
            'address_postal_code' => $input['address_postal_code'],
            'address_country' => $input['address_country'],
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

    /**
     * @param  array<string, string>  $input
     */
    private function postalCodeRule(array $input): \Closure
    {
        return function (string $attribute, mixed $value, \Closure $fail) use ($input): void {
            $postalCode = (string) $value;

            $isValid = match ($input['address_country'] ?? 'PH') {
                'PH' => preg_match('/^\d{4}$/', $postalCode) === 1,
                'US' => preg_match('/^\d{5}(-\d{4})?$/', $postalCode) === 1,
                default => false,
            };

            if (! $isValid) {
                $fail('The postal code format is invalid for the selected country.');
            }
        };
    }

    /**
     * @param  array<string, string>  $input
     */
    private function fullAddress(array $input): string
    {
        return Str::of(implode(', ', [
            $input['address_street'],
            $input['address_city'],
            $input['address_province_state'],
            $input['address_postal_code'],
            $input['address_country'],
        ]))->squish()->toString();
    }
}
