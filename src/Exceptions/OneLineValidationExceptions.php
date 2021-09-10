<?php

namespace AJMeireles\OLV\Exceptions;

use CodeIgniter\Exceptions\FrameworkException;

class OneLineValidationExceptions extends FrameworkException
{
    public static function forUndefinedRule(?string $rule = null)
    {
        return new static(lang('Validation.ruleNotFound', [$rule]));
    }
}