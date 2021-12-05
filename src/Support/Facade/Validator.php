<?php

namespace Ryodevz\Validator\Support\Facade;

use Ryodevz\Validator\Support\Run;

class Validator
{
    public static function make(array $data, array $rules)
    {
        return new Run($data, $rules);
    }
}
