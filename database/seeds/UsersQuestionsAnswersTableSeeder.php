<?php

use App\Answer;
use App\Question;
use App\User;
use Illuminate\Database\Seeder;

class UsersQuestionsAnswersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('answers')->delete();
        DB::table('questions')->delete();
        DB::table('users')->delete();

        factory(User::class, 3)->create()
            ->each(function (User $user) {
                $user
                    ->questions()
                    ->saveMany(
                        factory(Question::class, rand(1, 5))->make()
                    )
                    ->each(function (Question $question) {
                        $question
                            ->answers()
                            ->saveMany(
                                factory(Answer::class, rand(1, 5))->make()
                            );
                    });
            });
    }
}
