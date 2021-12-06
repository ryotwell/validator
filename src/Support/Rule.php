<?php

namespace Ryodevz\Validator\Support;

use DateTimeZone;

class Rule extends Validator
{
    protected $attribute;

    protected $rule;

    protected $param;

    protected $errors;

    protected $data;

    protected $messages = [];

    protected function array()
    {
        if (!is_array($this->data())) {
            return $this->setError($this->messages[__FUNCTION__]);
        }

        return $this->setResponse(true);
    }

    protected function active_url()
    {
        if (empty(@dns_get_record(parse_url($this->data())['host']))) {
            return $this->setError($this->messages[__FUNCTION__]);
        }

        return $this->setResponse(true);
    }

    protected function boolean()
    {
        if (!filter_var($this->data(), FILTER_VALIDATE_BOOLEAN)) {
            return $this->setError($this->messages[__FUNCTION__]);
        }

        return $this->setResponse(true);
    }

    protected function bool()
    {
        return $this->boolean();
    }

    protected function confirmed()
    {
        if (!($this->data() == (string) $this->data[$this->attribute . '_confirmation'])) {
            return $this->setError($this->messages[__FUNCTION__]);
        }

        return $this->setResponse(true);
    }

    protected function email()
    {
        if (!filter_var($this->data(), FILTER_VALIDATE_EMAIL)) {
            return $this->setError($this->messages[__FUNCTION__]);
        }

        return $this->setResponse(true);
    }

    protected function in()
    {
        if (!in_array((string) $this->data(), explode(',', $this->param))) {
            return $this->setError($this->messages[__FUNCTION__]);
        }

        return $this->setResponse(true);
    }

    protected function ip()
    {
        if (!filter_var($this->data(), FILTER_VALIDATE_IP)) {;
            return $this->setError($this->messages[__FUNCTION__]);
        }

        return $this->setResponse(true);
    }

    protected function ip4()
    {
        if (!filter_var($this->data(), FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            return $this->setError($this->messages[__FUNCTION__]);
        }

        return $this->setResponse(true);
    }

    protected function ip6()
    {
        if (!filter_var($this->data(), FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            return $this->setError($this->messages[__FUNCTION__]);
        }

        return $this->setResponse(true);
    }

    protected function integer()
    {
        if (!filter_var($this->data(), FILTER_VALIDATE_INT)) {
            return $this->setError($this->messages[__FUNCTION__]);
        }

        return $this->setResponse(true);
    }

    protected function int()
    {
        return $this->integer();
    }

    protected function min()
    {
        if (is_int($this->data())) {
            if ($this->param > $this->data()) {
                return $this->setError($this->messages[__FUNCTION__]['integer']);
            }
        } elseif (is_array($this->data())) {
            if ($this->param > count($this->data())) {
                return $this->setError($this->messages[__FUNCTION__]['array']);
            }
        } else {
            if ($this->param > strlen($this->data())) {
                return $this->setError($this->messages[__FUNCTION__]['string']);
            }
        }

        return $this->setResponse(true);
    }

    protected function max()
    {
        if (is_int($this->data())) {
            if ($this->param < $this->data()) {
                return $this->setError($this->messages[__FUNCTION__]['integer']);
            }
        } elseif (is_array($this->data())) {
            if ($this->param < count($this->data())) {
                return $this->setError($this->messages[__FUNCTION__]['array']);
            }
        } else {
            if ($this->param < strlen($this->data())) {
                return $this->setError($this->messages[__FUNCTION__]['string']);
            }
        }

        return $this->setResponse(true);
    }

    protected function nullable()
    {
        if (empty($this->data())) {
            unset($this->errors[$this->attribute]);

            return null;
        }

        return $this->setResponse(true);
    }

    protected function not_in()
    {
        if (in_array((string) $this->data(), explode(',', $this->param))) {
            return $this->setError($this->messages[__FUNCTION__]);
        }

        return $this->setResponse(true);
    }

    protected function required()
    {
        if (empty($this->data())) {
            return $this->setError($this->messages[__FUNCTION__]);
        }

        return $this->setResponse(true);
    }

    protected function required_with()
    {
        $this->transRuleTo('required', 'required_with');

        $attributes = explode(',', $this->param);

        foreach ($attributes as $attribute) {
            if (empty($this->data[$attribute])) {
                return $this->setError($this->messages[__FUNCTION__]);
            }
        }

        return $this->setResponse(true);
    }

    protected function required_without()
    {
        $this->transRuleTo('required', 'required_without');

        $attributes = explode(',', $this->param);

        foreach ($attributes as $attribute) {
            if (!empty($this->data[$attribute])) {
                return $this->setError($this->messages[__FUNCTION__]);
            }
        }

        return $this->setResponse(true);
    }

    protected function same()
    {
        if (!($this->data() == $this->data[$this->param])) {
            return $this->setError($this->messages[__FUNCTION__]);
        }

        return $this->setResponse(true);
    }

    protected function string()
    {
        if (!is_string($this->data())) {
            return $this->setError($this->messages[__FUNCTION__]);
        }

        return $this->setResponse(true);
    }

    protected function timezone()
    {
        if (!in_array($this->data(), DateTimeZone::listIdentifiers())) {
            return $this->setError($this->messages[__FUNCTION__]);
        }

        return $this->setResponse(true);
    }

    protected function url()
    {
        if (!filter_var($this->data(), FILTER_VALIDATE_URL)) {
            return $this->setError($this->messages[__FUNCTION__]);
        }

        return $this->setResponse(true);
    }
}
