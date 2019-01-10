<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Class Question
 *
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $body
 * @property integer $views
 * @property integer $answers_count
 * @property integer $votes
 * @property null|integer $best_answer_id
 * @property integer $user_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property User $user
 */
class Question extends Model
{
    protected $fillable = [
        'title', 'slug', 'body'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug(mb_substr($this->title, 0, 40)
            . '-'
            . Carbon::now()->format('dmyHi')
        );
    }

    public function getUrlAttribute()
    {
        return route('questions.show', $this->slug);
    }

    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getStatusAttribute()
    {
        if ($this->answers_count > 0) {
            if ($this->best_answer_id) {
                return "answered-accepted";
            }
            return "answered";
        }

        return "unanswered";
    }

    public function getBodyHtmlAttribute()
    {
        return \Parsedown::instance()->text($this->body);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function acceptBestAnswer(Answer $answer)
    {
        $this->best_answer_id = $answer->id;

        $this->save();
    }
}
