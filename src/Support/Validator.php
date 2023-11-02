<?php

namespace Ryodevz\Validator\Support;

class Validator
{
    protected $attribute;

    protected $param;

    protected $data;

    protected $errors;

    protected $firstError;

    protected $all;

    protected $rule;

    protected function setError(string $message)
    {
        $message = $this->format($message);

        $this->all[] = $message;
        $this->errors[$this->attribute][$this->rule] = $message;

        return $this->setResponse(false, $message);
    }

    protected function setResponse(bool $status, string $message = null)
    {
        return [
            'status' => $status,
            'message' => $message,
        ];
    }

    protected function format(string $message)
    {
        return str_replace([':attribute', ':' . $this->rule], [$this->attribute, $this->param], $message);
    }

    protected function data()
    {
        return $this->data[$this->attribute] ?? null;
    }

    protected function transRuleTo(string $toRule, string $fromRule)
    {
        $this->rule = $toRule;
        $response = $this->$toRule();
        $this->rule = $fromRule;

        return $response;
    }

    protected function run(array $rules)
    {
        foreach ($rules as $rule) {
            $explodeRule = explode(':', $rule);

            $rule = $explodeRule[0];
            $param = (isset($explodeRule[1]) ? $explodeRule[1] : null);

            $this->rule = $rule;
            $this->param = $param;

            $run = $this->runRule($rule);

            if (is_null($run['status'])) {
                return true;
            }

            if (!$this->firstError) {
                $this->firstError = $run['message'];
            }
        }

        return $this;
    }


    protected function runRule($rule)
    {
        return $this->$rule();
    }
}
