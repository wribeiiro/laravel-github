<?php

namespace App\Validations;

use App\Validations\AbstractValidation;

class LikeStoreValidation extends AbstractValidation
{
    public static function formValidate(array $data): mixed
    {
        return self::validate($data, [
            'post_id' => 'required|int'
        ]);
    }
}
