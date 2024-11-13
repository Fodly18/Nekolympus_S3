<?php

namespace Nekolympus\Project\core;

class Validation
{
    protected $errors = [];

    public function validate($data, $rules)
    {
        foreach ($rules as $field => $ruleSet) {
            $ruleSet = explode('|', $ruleSet);

            foreach ($ruleSet as $rule) {
                if (strpos($rule, ':') !== false) {
                    list($ruleName, $ruleValue) = explode(':', $rule);
                } else {
                    $ruleName = $rule;
                    $ruleValue = null;
                }

                $value = isset($data[$field]) ? $data[$field] : null;
                $this->$ruleName($field, $value, $ruleValue);
            }
        }

        return empty($this->errors);
    }

    protected function required($field, $value)
    {
        if (empty($value)) {
            $this->errors[$field][] = "$field wajib diisi.";
        }
    }

    protected function min($field, $value, $min)
    {
        if($value != null) {
            if (strlen($value) < $min) {
                $this->errors[$field][] = "$field harus minimal $min character.";
            }
        }
    }

    protected function max($field, $value, $max)
    {
        if($value != null) {
            if (strlen($value) > $max) {
                $this->errors[$field][] = "$field tidak boleh lebih $max character.";
            }
        }
    }

    protected function email($field, $value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field][] = "kolom $field tidak valid.";
        }
    }

    public function errors()
    {
        return $this->errors;
    }
}
