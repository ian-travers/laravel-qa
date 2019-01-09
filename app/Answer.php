<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Question
 *
 * @property integer $id
 * @property integer $question_id
 * @property integer $user_id
 * @property string $body
 * @property integer $votes_count
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property User $user
 * @property Question $question
 */
class Answer extends Model
{
    protected $fillable = [
        'body', 'user_id',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getBodyHtmlAttribute()
    {
        return \Parsedown::instance()->text($this->body);
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (self $answer) {
            $answer->question->increment('answers_count');
        });
    }

    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }
}
