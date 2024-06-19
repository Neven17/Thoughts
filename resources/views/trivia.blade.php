@extends('layout.layout')

@section('title', 'Trivia')

@section('content')
    <div class="row">
        <div class="col-3">
            @include('shared.left-sidebar')
        </div>
        <div class="col-6">
            <div class="container mt-4 text-center">
                <h1 class="text-center">Trivia Questions</h1>
                <h4>Maximum: 50 questions</h4>
                <p>Submit to get new questions each time</p>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <form action="{{ route('trivia.fetch') }}" method="POST" class="form-inline justify-content-center">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="number" class="form-control form-control-lg" id="amount" name="amount"
                                    placeholder="Enter number of questions" required min="1" max="50"
                                    style="font-size: 15px">
                                <button class="btn btn-primary btn" type="submit">Get Trivia Questions</button>
                            </div>
                        </form>
                    </div>
                </div>

                @if (isset($questions))
                    <div id="trivia-questions">
                        @foreach ($questions as $question)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">{!! $question['question'] !!}</h5>
                                    <p class="card-text"><strong>Category:</strong> {{ $question['category'] }}</p>
                                    <p class="card-text"><strong>Difficulty:</strong> {{ $question['difficulty'] }}</p>
                                    <p class="card-text">
                                        <strong>Correct Answer:</strong>
                                        <span class="blurred-answer"
                                            onclick="revealAnswer(this)">{{ $question['correct_answer'] }}</span>
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @elseif(isset($error))
                    <div class="mt-4 alert alert-danger">
                        {{ $error }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        .blurred-answer {
            filter: blur(5px);
            cursor: pointer;
        }
    </style>

    <script>
        function revealAnswer(element) {
            element.style.filter = 'none';
        }
    </script>
@endsection
