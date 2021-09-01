<?php

namespace Ryodevz\Validator\Support;

use DateTimeZone;

class Rule
{
    public static function array($attribute, $data)
    {
        if (!is_array($data[$attribute])) {
            return "The {$attribute} must be an array.";
        }
    }

    public static function active_url($attribute, $data)
    {
        if (empty(@dns_get_record(parse_url($data[$attribute])['host']))) {
            return "The {$attribute} is not a valid URL.";
        }
    }

    public static function boolean($attribute, $data)
    {
        if (!filter_var($data[$attribute], FILTER_VALIDATE_BOOL)) {
            return "The {$attribute} field must be true or false.";
        }
    }

    public static function confirmed($attribute, $data)
    {
        $confirmation = $data[$attribute . '_confirmation'] ?? '';
        if (!($data[$attribute] == $confirmation)) {
            return "The {$attribute} confirmation does not match.";
        }
    }

    public static function email($attribute, $data)
    {
        if (!filter_var($data[$attribute], FILTER_VALIDATE_EMAIL)) {
            return "The {$attribute} must be a valid email address.";
        }
    }

    public static function in($attribute, $data, $values)
    {
        $values = explode(',', $values);
        if (!in_array($data[$attribute], $values)) {
            return "The selected {$attribute} is invalid.";
        }
    }

    public static function ip($attribute, $data)
    {
        if (!filter_var($data[$attribute], FILTER_VALIDATE_IP)) {
            return "The {$attribute} must be a valid IP address.";
        }
    }

    public static function ip4($attribute, $data)
    {
        if (!filter_var($data[$attribute], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            return "The {$attribute} must be a valid IPv4 address.";
        }
    }

    public static function ip6($attribute, $data)
    {
        if (!filter_var($data[$attribute], FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            return "The {$attribute} must be a valid IPv6 address.";
        }
    }

    public static function integer($attribute, $data)
    {
        if (!filter_var($data[$attribute], FILTER_VALIDATE_INT)) {
            return "The {$attribute} must be an integer.";
        }
    }

    public static function max($attribute, $data, int $max)
    {
        if (is_int($data[$attribute])) {
            if ($data[$attribute] > $max) {
                return "The {$attribute} must not be greater than {$max}.";
            }
        } elseif (is_array($data[$attribute])) {
            if (count($data[$attribute]) > $max) {
                return "The {$attribute} must not have more than :max items.";
            }
        } else {
            if (strlen($data[$attribute]) > $max) {
                return "The {$attribute} must not be greater than {$max} characters.";
            }
        }
    }

    public static function min($attribute, $data, int $min)
    {
        if (is_int($data[$attribute])) {
            if ($data[$attribute] < $min) {
                return "The {$attribute} must be at least {$min}.";
            }
        } elseif (is_array($data[$attribute])) {
            if (count($data[$attribute]) < $min) {
                return "The {$attribute} must have at least {$min} items.";
            }
        } else {
            if (strlen($data[$attribute]) < $min) {
                return "The {$attribute} must be at least {$min} characters.";
            }
        }
    }

    public static function nullable($attribute)
    {
        return ['nullable' => $attribute];
    }

    public static function not_in($attribute, $data, $values)
    {
        $values = explode(',', $values);
        if (in_array($data[$attribute], $values)) {
            return "The selected {$attribute} is invalid.";
        }
    }

    public static function required($attribute, $data)
    {
        if (empty($data[$attribute])) {
            return "The {$attribute} field is required.";
        }
    }

    public static function required_with($attribute, $data, $values)
    {
        $values = array_filter(explode(',', $values));

        array_push($values, $attribute);

        foreach ($values as $value) {
            $value = trim($value);
            if (empty($data[$value])) {
                $fields[] = $value;
            }
        }

        if (!empty($fields)) {
            $values = implode(', ', $values);
            return "The {$attribute} field is required when {$values} is present.";
        }
    }

    public static function required_without($attribute, $data, $values)
    {
        $values = array_filter(explode(',', $values));

        foreach ($values as $value) {
            $value = trim($value);
            if (!empty($data[$value])) {
                $fields[] = $value;
            }
        }

        if (!empty($fields)) {
            $values = implode(', ', $values);
            return "The {$attribute} field is required when {$values} is not present.";
        }
    }

    public static function same($attribute, $data, $values)
    {
        if (!($data === $values)) {
            return "The {$attribute} and {$values} must match.";
        }
    }

    public static function string($attribute, $data)
    {
        if (!is_string($data[$attribute])) {
            return "The {$attribute} must be a string.";
        }
    }

    public static function timezone($attribute, $data)
    {
        if (!in_array($data[$attribute], DateTimeZone::listIdentifiers())) {
            return "The {$attribute} must be a valid timezone.";
        }
    }

    public static function url($attribute, $data)
    {
        if (!filter_var($data[$attribute], FILTER_VALIDATE_URL)) {
            return "The {$attribute} must be a valid URL.";
        }
    }
}
