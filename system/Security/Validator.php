<?php

namespace System\Security;

class Validator
{
    protected array $errors = [];

    public function validate(array $data, array $rules): bool
    {
        foreach ($rules as $field => $rule) {
            $value = $data[$field] ?? null;
            $methods = explode('|', $rule);

            foreach ($methods as $method) {
                if ($method === 'required' && empty($value)) {
                    $this->errors[$field][] = "The $field field is required.";
                }

                if ($method === 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->errors[$field][] = "The $field must be a valid email.";
                }

                if (str_starts_with($method, 'min:')) {
                    $min = (int) explode(':', $method)[1];
                    if (strlen($value) < $min) {
                        $this->errors[$field][] = "The $field must be at least $min characters.";
                    }
                }
            }
        }

        return empty($this->errors);
    }

    public function errors(): array
    {
        return $this->errors;
    }
}
