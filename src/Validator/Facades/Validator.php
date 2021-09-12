<?php

namespace Ryodevz\Validator\Facades;

use Ryodevz\Validator\Support\Handler;

class Validator
{
    /**
     * Error messages
     *
     * @return  array
     */
    protected static $messages = [
        'array' => 'The :attribute must be an array.',
        'active_url' => 'The :attribute is not a valid URL.',
        'boolean' => 'The :attribute field must be true or false.',
        'confirmed' => 'The :attribute confirmation does not match.',
        'in' => 'The selected :attribute is invalid.',
        'ip' => 'The :attribute must be a valid IP address.',
        'ip4' => 'The :attribute must be a valid IPv4 address.',
        'ip6' => 'The :attribute must be a valid IPv6 address.',
        'integer' => 'The :attribute must be an integer.',
        'max' => [
            'integer' => 'The :attribute must not be greater than :max.',
            'string' => 'The :attribute must not be greater than :max characters.',
            'array' => 'The :attribute must not have more than :max items.',
        ],
        'min' => [
            'integer' => 'The :attribute must be at least :min.',
            'string' => 'The :attribute must be at least :min characters.',
            'array' => 'The :attribute must have at least :min items.',
        ],
        'not_in' => 'The selected :attribute is invalid.',
        'required' => 'The :attribute field is required.',
        'required_with' => 'The :attribute field is required when :values is present.',
        'required_without' => 'The :attribute field is required when :values is not present.',
        'same' => 'The :attribute and :values must match.',
        'string' => 'The :attribute must be a string.',
        'timezone' => 'The :attribute must be a valid timezone.',
        'url' => 'The :attribute must be a valid URL.'
    ];

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
        return new Handler($data, $rules, $customErrorsMessage, self::config());
    }

    /**
     * merge error messages from config file and error messages from $messages
     *
     * @return  array
     */
    public static function config()
    {
        if (file_exists('config/validator.php')) {
            $config = require 'config/validator.php';

            self::$messages = array_merge(self::$messages, $config);
        }

        return self::$messages;
    }
}
