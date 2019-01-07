<?php

namespace App\Http\Controllers;

use App\Http\Requests\AskQuestionRequest;
use App\Question;

class QuestionsController extends Controller
{
    public function index()
    {
        $questions = Question::with('user')->latest()->paginate(5);

        return view('questions.index', compact('questions'));
    }

    public function create()
    {
        $question = New Question();

        return view('questions.create', compact('question'));
    }

    public function store(AskQuestionRequest $request)
    {
        $request->user()->questions()->create($request->only([
            'title',
            'slug',
            'body',
        ]));

        return redirect()->route('questions.index')->with('success', 'Your question has been submitted');
    }

    public function show(Question $question)
    {
        //
    }

    public function edit(Question $question)
    {
        return view('questions.edit', compact('question'));
    }

    public function update(AskQuestionRequest $request, Question $question)
    {
        $question->update($request->only([
            'title',
            'body',
        ]));

        return redirect()->route('questions.index')->with('success', 'Your question has been updated');
    }

    public function destroy(Question $question)
    {
        //
    }
}
