<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
/**
 * Class User
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property null|integer $email_verified_at
 * @property string $password
 * @property string $remember_token
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Question[] $questions
 * @property Answer[] $answers
 */
class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function getUrlAttribute()
    {
        return "#";
    }

    public function getAvatarAttribute()
    {
        $email = $this->email;
        $size = 32;
        return "https://www.gravatar.com/avatar/" . md5(strtolower(trim($email))) . "?s=" . $size;
    }

    public function favorites()
    {
        return $this->belongsToMany(Question::class, 'favorites')->withTimestamps();
    }
}
