<?php

namespace App\Concerns;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

trait PasswordValidationRules
{
    /**
     * Get the validation rules used to validate passwords.
     *
     * @param  array<string, mixed>  $input
     * @return array<int, Password|ValidationRule|\Closure|array<mixed>|string>
     */
    protected function passwordRules(array $input = []): array
    {
        return [
            'required',
            'string',
            Password::default(),
            'confirmed',
            function (string $attribute, mixed $value, \Closure $fail) use ($input): void {
                $password = Str::lower((string) $value);
                $restrictedValues = collect([
                    $input['name'] ?? null,
                    $input['email'] ?? null,
                    isset($input['email']) ? Str::before((string) $input['email'], '@') : null,
                ])
                    ->filter()
                    ->flatMap(fn (string $value): array => array_merge([$value], preg_split('/\s+/', $value) ?: []))
                    ->map(fn (string $value): string => Str::lower(trim($value)))
                    ->filter(fn (string $value): bool => Str::length($value) >= 3)
                    ->unique();

                if ($restrictedValues->contains(fn (string $value): bool => Str::contains($password, $value))) {
                    $fail('The password must not contain your name or email address.');
                }
            },
        ];
    }

    /**
     * Get the validation rules used to validate the current password.
     *
     * @return array<int, Password|ValidationRule|array<mixed>|string>
     */
    protected function currentPasswordRules(): array
    {
        return ['required', 'string', 'current_password'];
    }
}
