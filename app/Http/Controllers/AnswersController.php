<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use Illuminate\Http\Request;

class AnswersController extends Controller
{
    public function store(Question $question, Request $request)
    {
//        $request->validate([
//            'body' => 'required',
//        ]);

        $question->answers()->create($request->validate([
            'body' => 'required',
        ]) + ['user_id' => \Auth::id()]);

        return back()->with('success', 'Your answer has been submitted successfully.');
    }

    public function edit(Answer $answer)
    {
        //
    }

    public function update(Request $request, Answer $answer)
    {
        //
    }

    public function destroy(Answer $answer)
    {
        //
    }
}
