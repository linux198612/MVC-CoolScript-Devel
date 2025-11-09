<?php
namespace System\Validation;

class Validator
{
    protected $errors = [];

    public function validate($data, $rules)
    {
        $this->errors = [];
        foreach ($rules as $field => $ruleSet) {
            $value = isset($data[$field]) ? $data[$field] : null;
            foreach (explode('|', $ruleSet) as $rule) {
                if ($rule === 'required' && empty($value)) {
                    $this->errors[$field][] = 'Field is required.';
                }
                if ($rule === 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->errors[$field][] = 'Invalid email format.';
                }
                if (strpos($rule, 'min:') === 0) {
                    $min = (int)substr($rule, 4);
                    if (strlen($value) < $min) {
                        $this->errors[$field][] = "Minimum length is $min.";
                    }
                }
                if (strpos($rule, 'max:') === 0) {
                    $max = (int)substr($rule, 4);
                    if (strlen($value) > $max) {
                        $this->errors[$field][] = "Maximum length is $max.";
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
