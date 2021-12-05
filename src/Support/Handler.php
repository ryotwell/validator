<?php

namespace Ryodevz\Validator\Support;

class Handler extends Rule
{
    protected $attribute;

    protected $rules;

    protected $errors;

    protected $firstError;

    protected $all;

    protected $messages = [];

    public function validate()
    {
        foreach ($this->rules as $attribute => $rules) {

            $this->attribute = $attribute;
            $this->run(explode('|', $rules));
        }

        return new Support($this->errors, $this->firstError, $this->all);
    }
}
