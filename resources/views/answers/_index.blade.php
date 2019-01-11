<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h2>{{ $answersCount . " " . str_plural('Answer', $question->answers_count) }}</h2>
                </div>
                <hr>
                @include('layouts._messages')

                @foreach($answers as $answer)
                    <?php /* @var App\Answer $answer */ ?>
                    <div class="media">
                        @include('shared._vote', [
                            'model' => $answer,
                        ])
                        <div class="media-body">
                            {!! $answer->body_html !!}
                            <div class="row">
                                <div class="col-4">
                                    <div class="ml-auto">

                                            @can('update', $answer)
                                                <a href="{{ route('questions.answers.edit', [$question->id, $answer->id]) }}"
                                                   class="btn btn-sm btn-outline-info">Edit</a>
                                            @endcan

                                            @can('delete', $answer)
                                            <form class="form-delete" method="post"
                                                  action="{{ route('questions.answers.destroy', [$question->id, $answer->id]) }}">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                                        onclick="return confirm('Are you sure?')">Delete
                                                </button>
                                            </form>
                                            @endcan
                                    </div>
                                </div>
                                <div class="col-4"></div>
                                <div class="col-4 float-right">
                                    @include('shared._author', [
                                        'model' => $answer,
                                        'label' => 'Answered',
                                    ])
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>
</div>

