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
 * @property integer $answers
 * @property integer $votes
 * @property null|integer $best_answer_id
 * @property integer $user_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $user
 */
class Question extends Model
{
    protected $fillable = [
        'title', 'body'
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
}
