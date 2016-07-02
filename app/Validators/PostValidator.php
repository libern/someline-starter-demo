<?php

namespace Someline\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class PostValidator extends LaravelValidator {

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'title' => 'required|string',
            'body' => 'required|string|min:10',
            'is_recommended' => 'boolean',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'title' => 'string',
            'body' => 'string|min:10',
            'is_recommended' => 'boolean',
        ],
   ];

}