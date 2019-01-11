<?php

namespace App\Http\Controllers;

use App\Http\Requests\AskQuestionRequest;
use App\Question;

class QuestionsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' =>['index', 'show']]);
    }

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

        return redirect()->route('questions.index')->with('success', 'Your question has been submitted.');
    }

    public function show(Question $question)
    {
        $question->increment('views');

        return view('questions.show', compact('question'));
    }

    public function edit(Question $question)
    {
        $this->authorize('update', $question)->message('Access denied for edit that question.');

        return view('questions.edit', compact('question'));
    }

    public function update(AskQuestionRequest $request, Question $question)
    {
        $this->authorize('update', $question)->message('Access denied for update that question.');

        $question->update($request->only([
            'title',
            'body',
        ]));

        return redirect()->route('questions.index')->with('success', 'Your question has been updated.');
    }

    public function destroy(Question $question)
    {
        $this->authorize('delete', $question)->message('Access denied for delete that question.');

        $question->delete();

        return redirect()->route('questions.index')->with('success', 'Your question has been deleted.');
    }
}
