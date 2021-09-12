<?php

namespace Ryodevz\Validator\Support;

use DateTimeZone;

class Rule
{
    public static function array($attribute, $data, $message)
    {
        if (!is_array($data[$attribute])) {
            return self::format($message, ['attribute' => $attribute]);
        }
    }

    public static function active_url($attribute, $data, $message)
    {
        if (empty(@dns_get_record(parse_url($data[$attribute])['host']))) {
            return self::format($message, ['attribute' => $attribute]);
        }
    }

    public static function boolean($attribute, $data, $message)
    {
        if (!filter_var($data[$attribute], FILTER_VALIDATE_BOOL)) {
            return self::format($message, ['attribute' => $attribute]);
        }
    }

    public static function confirmed($attribute, $data, $message)
    {
        $confirmation = $data[$attribute . '_confirmation'] ?? '';
        if (!($data[$attribute] == $confirmation)) {
            return self::format($message, ['attribute' => $attribute]);
        }
    }

    public static function email($attribute, $data, $message)
    {
        if (!filter_var($data[$attribute], FILTER_VALIDATE_EMAIL)) {
            return self::format($message, ['attribute' => $attribute]);
        }
    }

    public static function in($attribute, $data, $values, $message)
    {
        $values = explode(',', $values);

        if (!in_array($data[$attribute], $values)) {
            return self::format($message, ['attribute' => $attribute, 'values' => $values]);
        }
    }

    public static function ip($attribute, $data, $message)
    {
        if (!filter_var($data[$attribute], FILTER_VALIDATE_IP)) {
            return self::format($message, ['attribute' => $attribute]);
        }
    }

    public static function ip4($attribute, $data, $message)
    {
        if (!filter_var($data[$attribute], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            return self::format($message, ['attribute' => $attribute]);
        }
    }

    public static function ip6($attribute, $data, $message)
    {
        if (!filter_var($data[$attribute], FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            return self::format($message, ['attribute' => $attribute]);
        }
    }

    public static function integer($attribute, $data, $message)
    {
        if (!filter_var($data[$attribute], FILTER_VALIDATE_INT)) {
            return self::format($message, ['attribute' => $attribute]);
        }
    }

    public static function max($attribute, $data, int $max, $message)
    {
        if (is_int($data[$attribute])) {
            if ($data[$attribute] > $max) {
                return self::format($message['integer'], ['attribute' => $attribute, 'max' => $max]);
            }
        } elseif (is_array($data[$attribute])) {
            if (count($data[$attribute]) > $max) {
                return self::format($message['array'], ['attribute' => $attribute, 'max' => $max]);
            }
        } else {
            if (strlen($data[$attribute]) > $max) {
                return self::format($message['string'], ['attribute' => $attribute, 'max' => $max]);
            }
        }
    }

    public static function min($attribute, $data, int $min, $message)
    {
        if (is_int($data[$attribute])) {
            if ($data[$attribute] < $min) {
                return self::format($message['integer'], ['attribute' => $attribute, 'min' => $min]);
            }
        } elseif (is_array($data[$attribute])) {
            if (count($data[$attribute]) < $min) {
                return self::format($message['array'], ['attribute' => $attribute, 'min' => $min]);
            }
        } else {
            if (strlen($data[$attribute]) < $min) {
                return self::format($message['string'], ['attribute' => $attribute, 'min' => $min]);
            }
        }
    }

    public static function nullable($attribute)
    {
        return ['nullable' => $attribute];
    }

    public static function not_in($attribute, $data, $values, $message)
    {
        $values = explode(',', $values);
        if (in_array($data[$attribute], $values)) {
            return self::format($message, ['attribute' => $attribute, 'values' => $values]);
        }
    }

    public static function required($attribute, $data, $message)
    {
        if (empty($data[$attribute])) {
            return self::format($message, ['attribute' => $attribute]);
        }
    }

    public static function required_with($attribute, $data, $values, $message)
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
            return self::format($message, ['attribute' => $attribute, 'values' => $values]);
        }
    }

    public static function required_without($attribute, $data, $values, $message)
    {
        $values = array_filter(explode(',', $values));

        foreach ($values as $value) {
            $value = trim($value);
            if (!empty($data[$value])) {
                $fields[] = $value;
            }
        }

        if (!empty($fields)) {
            return self::format($message, ['attribute' => $attribute, 'values' => $values]);
        }
    }

    public static function same($attribute, $data, $values, $message)
    {
        if (!($data === $values)) {
            return self::format($message, ['attribute' => $attribute, 'values' => $values]);
        }
    }

    public static function string($attribute, $data, $message)
    {
        if (!is_string($data[$attribute])) {
            return self::format($message, ['attribute' => $attribute]);
        }
    }

    public static function timezone($attribute, $data, $message)
    {
        if (!in_array($data[$attribute], DateTimeZone::listIdentifiers())) {
            return self::format($message, ['attribute' => $attribute]);
        }

        if (is_bool($data[$attribute])) {
            return self::format($message, ['attribute' => $attribute]);
        }
    }

    public static function url($attribute, $data, $message)
    {
        if (!filter_var($data[$attribute], FILTER_VALIDATE_URL)) {
            return self::format($message, ['attribute' => $attribute]);
        }
    }

    private static function format($message, $params = [])
    {
        $message = str_replace([':attribute', ':values', ':min', ':max'], [
            $params['attribute'] ?? null,
            (!empty($params['values']) && is_array($params['values']) ? implode(', ', $params['values']) : ''),
            $params['min'] ?? null,
            $params['max'] ?? null,
        ], $message);

        return $message;
    }
}
