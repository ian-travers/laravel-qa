<?php

use App\Question;
use App\User;
use Illuminate\Database\Seeder;

/**
 * Class UsersTableSeeder
 *
 * Create fake user with fake questions
 *
 */
class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        factory(User::class, 3)->create()->each(function (User $user) {
            $user->questions()->saveMany(
                factory(Question::class, rand(1, 5))->make()
            );
        });
    }
}