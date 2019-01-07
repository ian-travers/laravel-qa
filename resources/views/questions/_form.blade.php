<?php
/**
 * @var \App\Question $question
 */
?>

@csrf

<div class="form-group">
    <label for="question-title">Question Title</label>
    <input type="text" name="title" value="{{ old('title', $question->title) }}" id="question-title"
           class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}">

    @if($errors->has('title'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('title') }}</strong>
        </div>
    @endif

</div>

<div class="form-group">
    <input type="hidden" name="slug" value="{{ old('slug') }}" id="question-slug"
           class="form-control" placeholder="Auto generation" readonly>

    @if($errors->has('slug'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('slug') }}</strong>
        </div>
    @endif

</div>

<div class="form-group">
    <label for="question-body">Explain your question</label>
    <textarea name="body" id="question-body" rows="10"
              class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}">{{ old('body', $question->body) }}</textarea>

    @if($errors->has('body'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('body') }}</strong>
        </div>
    @endif

</div>
<div class="form-group">
    <button type="submit" class="btn btn-lg btn-outline-primary">{{ $buttonText }}</button>
</div>

