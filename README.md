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
