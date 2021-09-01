<?php

namespace Ryodevz\Validator\Support;

class Support
{
    private $errors;

    private $errorFields;

    public function __construct(array $errors, $errorFields)
    {
        $this->errors = $errors;
        $this->errorFields = $errorFields;
    }

    public function all()
    {
        $errorMessages = [];
        foreach ($this->errorFields as $field) {
            foreach ($this->errors[$field] as $message) {
                $errorMessages[] = $message;
            }
        }

        return $errorMessages;
    }

    public function errors(...$attributes)
    {
        if (empty($attributes)) {
            return $this->errors;
        }

        $errors = [];
        foreach ($attributes as $attribute) {
            $errors[$attribute] = $this->errors[$attribute];
        }

        return $errors;
    }

    public function error(string $attribute)
    {
        return $this->errors[$attribute][0] ?? '';
    }

    public function first()
    {
        foreach ($this->errors as $error) {
            return $error[0];
        }
    }

    public function is_fails()
    {
        if (!empty($this->errors)) {
            return true;
        }

        return false;
    }
}
