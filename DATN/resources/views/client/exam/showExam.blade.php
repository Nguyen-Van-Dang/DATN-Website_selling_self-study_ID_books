@extends('layouts.client.client')

@section('title', 'Xem lại kết quả')

@section('content')
    <div class="row mb-3">
        <div class="col-lg-8">
            <div class="iq-card iq-card-block iq-card-stretch iq-card-height p-3">
                <div class="row overflow-scroll"
                    style="max-height: 80vh; overflow-y: auto; overflow-x: hidden; position: relative;">
                    @foreach ($questions as $index => $question)
                        <div class="question border-bottom mx-5 mb-1" style="width:100%" id="question_{{ $index }}">
                            <b>Câu {{ $index + 1 }}: {{ $question->question }}</b>
                            <div class="answers">
                                @foreach ($question->answers as $answerIndex => $answer)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" disabled
                                            @if ($question->user_answer_id == $answer->id) checked @endif
                                            id="answer_{{ $question->id }}_{{ $answerIndex }}">

                                        @if ($question->user_answer_id == $answer->id && $question->is_correct)
                                            <label style="color:rgb(0, 180, 0)" class="form-check-label correct-answer"
                                                for="answer_{{ $question->id }}_{{ $answerIndex }}">
                                                <b>{{ chr(65 + $answerIndex) }}</b>. {{ $answer->answer }}
                                            </label>
                                        @elseif($question->user_answer_id == $answer->id && !$question->is_correct)
                                            <label style="color:rgb(255, 0, 0)" class="form-check-label wrong-answer"
                                                for="answer_{{ $question->id }}_{{ $answerIndex }}">
                                                <b>{{ chr(65 + $answerIndex) }}</b>. {{ $answer->answer }}
                                            </label>
                                        @elseif($question->user_answer_id != $answer->id && $question->correct_answer_id == $answer->id)
                                            <label style="color:rgb(0, 180, 0); font-style: italic;"
                                                class="form-check-label correct-answer-unselected"
                                                for="answer_{{ $question->id }}_{{ $answerIndex }}">
                                                <b>{{ chr(65 + $answerIndex) }}</b>. {{ $answer->answer }} (Đáp án đúng)
                                            </label>
                                        @else
                                            <label class="form-check-label"
                                                for="answer_{{ $question->id }}_{{ $answerIndex }}">
                                                <b>{{ chr(65 + $answerIndex) }}</b>. {{ $answer->answer }}
                                            </label>
                                        @endif
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    @endforeach
                    <p class="text-center w-100 mt-3">Hết bài</p>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="iq-card iq-card-block iq-card-stretch p-3">
                <div class="d-flex">
                    <div class="icon iq-icon-box mr-3">
                        <a href="javascript:void();">
                            <img class="img-fluid avatar-60 rounded-circle"
                                src="{{ $examResult->exam->course->user->images()->where('image_name', 'thumbnail')->first()->image_url ?? asset('assets/images/book/user_thumbnail.png') }}"
                                alt="">
                        </a>
                    </div>
                    <div class="mt-1">
                        <a href="">
                            <h6>{{ $examResult->exam->name }}</h6>
                        </a>
                        <p class="mb-0 text-warning">{{ $examResult->exam->course->user->sex == 0 ? 'Thầy' : 'Cô' }}:
                            <span class="text-body">{{ $examResult->exam->course->user->name }}</span>
                        </p>
                        <p class="mb-0 text-warning">Khoá học:
                            <span class="text-body">{{ $examResult->exam->course->name }}</span>
                        </p>
                    </div>
                </div>
                <div class="border-top">
                    <div class="row">
                        <div class="col pt-3 text-center border-right">
                            <div class="status-box">
                                <h3 class="fw-bold" style="color:rgb(119, 125, 116)">
                                    {{ $examResult->correct_amount + $examResult->incorrect_amount }}
                                </h3>
                                <p>Tổng số</p>
                            </div>
                        </div>
                        <div class="col pt-3 text-center border-right">
                            <div class="status-box">
                                <h3 class="fw-bold" style="color:rgb(58, 173, 0)"> {{ $examResult->correct_amount }}</h3>
                                <p>Đúng</p>
                            </div>
                        </div>
                        <div class="col pt-3 text-center border-right">
                            <div class="status-box">
                                <h3 class="fw-bold" style="color:rgb(255, 0, 0)">{{ $examResult->incorrect_amount }}</h3>
                                <p>Sai</p>
                            </div>
                        </div>
                        <div class="col pt-3 text-center">
                            <div class="status-box">
                                <h3 class="fw-bold" style="color:rgb(40, 0, 218)">
                                    {{ $examResult->score }}/10
                                </h3>
                                <p>Điểm</p>
                            </div>
                        </div>
                    </div>
                    <div class="iq-progress-bar-linear d-inline-block w-100">
                        <div class="iq-progress-bar iq-bg-danger">
                            <span class="bg-danger" data-percent="{{ $examResult->score * 10 }}"></span>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($questions as $index => $question)
                            @php
                                $answerIndex = array_search(
                                    $question->user_answer_id,
                                    array_column($question->answers->toArray(), 'id'),
                                );
                                $answerLetter = chr(65 + ($answerIndex >= 0 && $answerIndex <= 3 ? $answerIndex : 0));
                            @endphp

                            <div class="col-3 text-center px-0 mb-2">
                                <button type="button"
                                    class="btn {{ $question->is_correct ? 'btn-success' : 'btn-danger' }} px-4 question-button"
                                    onclick="scrollToQuestion({{ $index }})">
                                    <b>{{ $index + 1 }}.</b> <b>{{ $answerLetter }}</b>
                                </button>
                            </div>
                        @endforeach


                    </div>
                    <div class="border-top pt-3">
                        <div class="d-flex flex-column">
                            <div>
                                <p><b>Ngày thực hiện: </b> {{ $examResult->created_at->format('H:i:s, d/m/Y') }}</p>
                            </div>
                            <div>
                                <p><b>Kết quả trước đó:</b></p>
                                @if ($previousResults->isEmpty())
                                    <p>Chưa ghi nhận.</p>
                                @else
                                    <ul class="list-unstyled">
                                        @foreach ($previousResults as $result)
                                            <li>
                                                <a href="{{ route('de-thi.showExam', ['result_id' => $result->id]) }}">
                                                    - {{ $result->created_at->format('H:i:s, d/m/Y') }}
                                                    @if ($result->score >= 5)
                                                        <span class="badge badge-primary rounded-pill d-inline">Đã
                                                            đạt</span>
                                                    @else
                                                        <span class="badge badge-danger rounded-pill d-inline">Chưa
                                                            đạt</span>
                                                    @endif
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <script>
            function scrollToQuestion(index) {
                const questionElement = document.getElementById(`question_${index}`);
                if (questionElement) {
                    questionElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'end',
                    });
                    questionElement.classList.add('highlight');
                    setTimeout(() => {
                        questionElement.classList.remove('highlight');
                    }, 1000);
                }
            }
        </script>

        <style>
            .question-button {
                width: 80%;
                text-align: center;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .correct-answer {
                color: rgb(0, 233, 8);
                font-weight: bold;
            }

            .wrong-answer {
                color: rgb(232, 0, 0);
                font-weight: bold;
            }

            .highlight {
                background-color: #c1fdc1;
                transition: background-color 0.5s ease-in-out;
            }
        </style>
    </div>

@endsection
