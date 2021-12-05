<?php

namespace Ryodevz\Validator\Support;

class Support
{
    protected $errors;

    protected $firstError;

    protected $all;

    public function __construct($errors, $firstError, $all)
    {
        $this->errors = $errors;
        $this->firstError = $firstError;
        $this->all = $all;
    }

    public function errors()
    {
        return $this->errors;
    }

    public function all()
    {
        return $this->all;
    }

    public function first()
    {
        return $this->firstError;
    }

    public function fails()
    {
        if ($this->errors) {
            return true;
        }

        return false;
    }
}
