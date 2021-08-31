<?php

namespace Ryodevz\Validator\Facades;

use Ryodevz\Validator\Support\Handler;

class Validator
{
    /**
     * Make validation
     *
     * @param array $data
     * @param array $rules
     * @param array $customErrorsMessage
     * @return  Ryodevz\Support\Handler
     */
    public static function make(array $data = [], array $rules = [], array $customErrorsMessage = [])
    {
        return new Handler($data, $rules, $customErrorsMessage);
    }
}
