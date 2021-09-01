<?php

namespace Ryodevz\Validator\Support;

class Support
{
    public $data;

    public $errorsMessages;

    public $fieldsError;

    public function __construct($data, $errorsMessages, $fieldsError)
    {
        $this->data = $data;
        $this->errorsMessages = $errorsMessages;
        $this->fieldsError = $fieldsError;
    }

    public function all()
    {
        $errorMessages = [];
        foreach ($this->fieldsError as $field) {
            foreach ($this->errorsMessages[$field] as $message) {
                $errorMessages[] = $message;
            }
        }

        return $errorMessages;
    }

    public function errors(...$attributes)
    {
        if (empty($attributes)) {
            return $this->errorsMessages;
        }

        $errorsMessages = [];
        foreach ($attributes as $attribute) {
            $errorsMessages[$attribute] = $this->errorsMessages[$attribute];
        }

        return $errorsMessages;
    }

    public function error(string $attribute)
    {
        return $this->errorsMessages[$attribute][0] ?? '';
    }

    public function first()
    {
        foreach ($this->errorsMessages as $error) {
            return $error[0];
        }
    }

    public function is_fails()
    {
        if (empty($this->errorsMessages)) {
            return false;
        }

        return true;
    }
}
