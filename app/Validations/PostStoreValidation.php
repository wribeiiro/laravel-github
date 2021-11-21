<?php

namespace App\Validations;

use App\Validations\AbstractValidation;

class PostStoreValidation extends AbstractValidation
{
    public static function formValidate(array $data): mixed
    {
        return self::validate($data, [
            'content' => 'required'
        ]);
    }
}
