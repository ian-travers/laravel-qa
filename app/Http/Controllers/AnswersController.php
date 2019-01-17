<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use Illuminate\Http\Request;

class AnswersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    public function index(Question $question)
    {
        return $question->answers()->with('user')->simplePaginate(3);
    }

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

    public function edit(Question $question, Answer $answer)
    {
        $this->authorize('update', $answer);

        return view('answers.edit', compact('question', 'answer'));
    }

    public function update(Request $request, Question $question, Answer $answer)
    {
        $this->authorize('update', $answer);

        $answer->update($request->validate([
            'body' => 'required',
        ]));

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Your answer has been updated.',
                'body_html' => $answer->body_html,
            ]);
        }


        return redirect()->route('questions.show', $question->slug)->with('success', 'Your answer has been updated.');
    }

    public function destroy(Question $question, Answer $answer)
    {
        $this->authorize('delete', $answer);

        $answer->delete();

        if (request()->expectsJson()) {
            return response()->json([
                'message' => 'Your answer has been removed.',
            ]);
        }

        return back()->with('success', 'Your answer has been removed.');
    }
}
