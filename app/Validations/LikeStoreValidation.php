<?php

namespace App\Validations;

use App\Validations\AbstractValidation;

class LikeStoreValidation extends AbstractValidation
{
    public static function formValidate(array $data)
    {
        return self::validate($data, [
            'post_id' => 'required|int'
        ]);
    }
}
