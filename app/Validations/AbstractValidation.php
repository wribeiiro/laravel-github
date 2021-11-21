<?php

namespace App\Validations;

use Illuminate\Support\Facades\Validator;

abstract class AbstractValidation
{
    public static function validate(
        array $data,
        array $rules
    ): mixed {

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return implode('.', $validator->errors()->all());
        }

        return $validator->validated();
    }
}
