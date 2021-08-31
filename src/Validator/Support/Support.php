<?php

namespace Ryodevz\Validator\Support;

class Support
{
    private $errors;

    public function __construct(array $errors)
    {
        $this->errors = $errors;
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
