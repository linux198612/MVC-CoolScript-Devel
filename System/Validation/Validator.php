<?php
namespace System\Validation;

class Validator
{
    protected $errors = [];

    public function validate(array $data, array $rules)
    {
        $this->errors = [];

        foreach ($rules as $field => $fieldRules) {
            $value = isset($data[$field]) ? $data[$field] : null;
            foreach ($fieldRules as $rule) {
                if ($rule === 'required' && (is_null($value) || $value === '')) {
                    $this->errors[$field][] = 'Field is required.';
                }
                if ($rule === 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->errors[$field][] = 'Invalid email format.';
                }
                if ($rule === 'numeric' && !is_numeric($value)) {
                    $this->errors[$field][] = 'Must be numeric.';
                }
                if ($rule === 'alpha' && !ctype_alpha($value)) {
                    $this->errors[$field][] = 'Only alphabetic characters allowed.';
                }
                if ($rule === 'url' && !filter_var($value, FILTER_VALIDATE_URL)) {
                    $this->errors[$field][] = 'Invalid URL format.';
                }
                if (strpos($rule, 'in:') === 0) {
                    $allowed = explode(',', substr($rule, 3));
                    if (!in_array($value, $allowed)) {
                        $this->errors[$field][] = 'Value must be one of: ' . implode(', ', $allowed);
                    }
                }
            }
        }

        return empty($this->errors);
    }

    public function errors()
    {
        return $this->errors;
    }
}
