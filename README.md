# One Line Validation, For CodeIgniter 4

## What Is?
**One Line Validation (OLV)** is a package made for CodeIgniter 4 to provide a fast and single line validation experience ideal for CDN and/or API services consuming the Validation System from CodeIgniter 4.

## When Use It?
You should use it when you want to perform validations (with CodeIngiter 4's Validation Service) without writing too many lines of code to instanciate the Validation Service, rules and run the validation, see the examples below.

## Examples
```php
use AJMeireles\OLV\OneLineValidation;

// passing rules directly as array

$validator = (new OneLineValidation)->rules([
    'username' => [
        'label' => 'Username', 
        'rules' => 'alpha|min_length[20]'
    ],
])->run(['username' => 'Anthony']);
```

```php
use AJMeireles\OLV\OneLineValidation;

// passing rules as a variable from app\Config\Validation.php

$validator = (new OneLineValidation)->rules('register')->run([
    'username' => 'Anthony'
]);

// in this case, the $register public variable need exist in app\Config\Validation.php:

public $register = [
    'username' => [
        'label' => 'Username', 
        'rules' => 'alpha|exact_length[4]'
    ]
];
```

## Tips:

### Returning All Errors
- You can pass ```true``` for the second parameter of the ```run()``` method so that all errors will be returned, instead of stopping validation on each error.

### Validate the Request
- **If you don't define the first argument of the ```run()``` method as an array of data to be validated**, the system will use the request to perform the validation.


## Contribution
- Please feel invited to send a PR if you notice that there is an improvement to be added or a correction to be made.