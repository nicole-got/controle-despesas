<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class ExpenseValidator extends LaravelValidator
{
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'user_id' => "required",
            'description'=> "required",
            'date'=>"required",
            'image'=> "required",
            'value'=> "required"
        ],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}
