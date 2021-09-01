<?php

namespace Ryodevz\Validator\Support;

use Ryodevz\Validator\Support\Rule;
use Ryodevz\Validator\Support\Support;

class Handler
{
    public $data = [];

    public $rules = [];

    public $nullable = false;

    public $customErrorsMessage = [];

    public function __construct($data, $rules, $customErrorsMessage)
    {
        $this->data = $data;
        $this->rules = $rules;
        $this->customErrorsMessage = $customErrorsMessage;
    }

    /**
     * Validate
     *
     * @return  Ryodevz\Support\Support
     */
    public function validate()
    {
        $errors = [];
        $errorFields = [];

        foreach ($this->rules as $attribute => $rulesString) {

            $this->nullable = false;

            foreach (explode('|', $rulesString) as $rule) {

                if ($this->nullable == false) {
                    $response = null;
                    $explode = explode(':', $rule, 2);

                    if (!isset($this->data[$attribute])) {
                        $this->data[$attribute] = null;
                    }

                    if (isset($explode[1])) {
                        $rule = $explode[0];
                        $response = Rule::$rule($attribute, $this->data, $explode[1]);
                    } else {
                        $response = Rule::$rule($attribute, $this->data);
                    }

                    if ($response) {
                        if (!isset($response['nullable'])) {
                            if (isset($this->customErrorsMessage[$attribute][$rule])) {
                                $errors[$attribute][] = $this->customErrorsMessage[$attribute][$rule];
                            } else {
                                $errors[$attribute][] = $response;
                            }

                            $errorFields[] = $attribute;
                        } else {
                            if (isset($errors[$attribute])) {
                                unset($errors[$attribute]);
                            }
                            $this->nullable = true;
                        }
                    }
                }
            }
        }

        return new Support($errors, $errorFields);
    }
}
