<?php

namespace Ryodevz\Validator\Support;

use Ryodevz\Validator\Support\Rule;
use Ryodevz\Validator\Support\Support;

class Handler
{
    public $data = [];

    public $rules = [];

    public $fieldsError = [];

    public $errorsMessages = [];

    public $customErrorsMessage = [];

    public $nullable = false;

    public $isFail = false;

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
        foreach ($this->rules as $attribute => $rulesString) {

            $this->nullable = false;
            $this->isFail = false;

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
                                $this->errorsMessages[$attribute][] = $this->customErrorsMessage[$attribute][$rule];
                            } else {
                                $this->errorsMessages[$attribute][] = $response;
                            }

                            $this->isFail = true;
                        } else {
                            if (isset($this->errorsMessages[$attribute])) {
                                unset($this->errorsMessages[$attribute]);
                            }
                            $this->nullable = true;
                        }
                    }
                }
            }

            if ($this->isFail) {
                $this->fieldsError[] = $attribute;
            }
        }

        return new Support($this->data, $this->errorsMessages, $this->fieldsError);
    }
}
