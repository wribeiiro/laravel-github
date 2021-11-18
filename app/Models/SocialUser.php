<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialUser extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'social_id',
        'social_type',
        'avatar',
        'nickname',
        'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
