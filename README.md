## Validator

[![Latest Version](https://img.shields.io/github/v/release/ryodevz/validator.svg?style=flat-square)](https://github.com/ryodevz/validator/releases)

Laravel-like validation and a few others.

## Installing validator

The recommended way to install validator is through [Composer](https://getcomposer.org/).

```bash
composer require ryodevz/validator
```

### Validator example usage

```php
use Ryodevz\Validator\Facades\Validator;

// Make validation
$validator = Validator::make([
    'name'  => $_POST['name'],
    'email' => $_POST['email'],
], [
    'name'  => 'required|min:3',
    'email' => 'required|email',
], [
    // Custom error message is optional
    'name' => [
        'required' => 'This is custom error message for rule required'
    ],
]);

// Validate
$validator->validate();

// Check if it passes validation
if(!$validator->is_fails()) {
    // code...
}

// All error messages with key
$validator->errors();

// All error messages without key
$validator->all();

// Error messages from some fields
$validator->errors(['name', 'email']);

// one error message
$validator->error('name');

// First error message
$validator->first();
```

### Custom error message from config file

Create one config file in `config/validator.php` and fill it with

```php
return [
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
```

### Rules

Some rules available :

| Rule             | Description                                                        | Example                  |
| ---------------- | ------------------------------------------------------------------ | ------------------------ |
| array            | Must be array                                                      |                          |
| active_url       | Must be valid URL                                                  |                          |
| boolean          | true or false                                                      |                          |
| confirmed        | Confirmation requires a new field, example 'password_confirmation' | confirmed                |
| email            | Must be valid email                                                |                          |
| in               |                                                                    | in:foo,bar               |
| ip               | Must be valid ip                                                   |                          |
| ip4              | Must be valid ip4                                                  |                          |
| ip6              | Must be valid ip6                                                  |                          |
| integer          | Must be integer                                                    |                          |
| max              | Maximum                                                            | max:191                  |
| min              | Minimum                                                            | min:3                    |
| nullable         | Empty allowed                                                      |                          |
| not_in           |                                                                    | not_in:foo,bar           |
| required         | Must be required                                                   |                          |
| required_with    | Must be required with foo, barr                                    | required_with:foo,bar    |
| required_without | Must be required without foo, barr                                 | required_without:foo,bar |
| same             | Value must be the same                                             | same:password_confirm    |
| string           | Must be string                                                     |                          |
| timezone         | Must be valid timezone                                             |                          |
| url              | Must be valid URL                                                  |                          |
