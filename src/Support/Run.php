<?php

namespace Ryodevz\Validator\Support;

class Run extends Handler
{
    protected $data = [];

    protected $rules = [];

    protected $messages = [];

    protected $path;

    public function __construct(array $data, array $rules)
    {
        $this->data = $data;
        $this->rules = $rules;

        $this->setConfig();
    }

    private function setConfig()
    {
        $this->setPath();

        $config = require $this->path;

        $this->messages = array_merge($this->messages, $config);
    }

    private function setPath()
    {
        if (file_exists('config/validator.php')) {
            return $this->path = 'config/validator.php';
        }

        return $this->path = __DIR__ . '/config/validator.php';
    }
}
