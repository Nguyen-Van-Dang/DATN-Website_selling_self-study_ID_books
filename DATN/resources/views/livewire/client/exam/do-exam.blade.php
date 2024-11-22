<div class="row mb-3">
    <div class="col-lg-8">
        <div class="iq-card iq-card-block iq-card-stretch iq-card-height p-3">
            <div class="row overflow-scroll"
                style="max-height: 80vh; overflow-y: auto; overflow-x: hidden; position: relative;">
                @foreach ($questions as $index => $question)
                    <div class="question border-bottom mx-5 mb-1" style="width:100%" id="question_{{ $index }}">
                        <b>Câu {{ $index + 1 }}: {{ $question['question'] }} </b>
                        <div class="answers">
                            @foreach ($question['answers'] as $answerIndex => $answer)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="answer_{{ $index }}"
                                        id="answer_{{ $index }}_{{ $answerIndex }}"
                                        wire:model.live="answers.{{ $index }}" value="{{ $answer['id'] }}">
                                    <label class="form-check-label"
                                        for="answer_{{ $index }}_{{ $answerIndex }}">
                                        <b>{{ chr(65 + $answerIndex) }}</b>. {{ $answer['answer'] }}
                                    </label>
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
                            src="{{ $exam->course->user->images()->where('image_name', 'thumbnail')->first()->image_url ?? asset('assets/images/book/user_thumbnail.png') }}"
                            alt="">
                    </a>
                </div>
                <div class="mt-1">
                    <a href="">
                        <h6>{{ $exam->name }}</h6>
                    </a>
                    <p class="mb-0 text-warning">{{ $exam->course->user->sex == 0 ? 'Thầy' : 'Cô' }}:
                        <span class="text-body">{{ $exam->course->user->name }}</span>
                    </p>
                    <p class="mb-0 text-warning">Khoá học:
                        <span class="text-body">{{ $exam->course->name }}</span>
                    </p>
                </div>
            </div>
            <div class="border-top">
                <div class="row">
                    <div class="col pt-3 text-center border-right">
                        <div class="status-box">
                            <h3 class="fw-bold" style="color:rgb(119, 125, 116)">
                                {{ $totalAnswer }}</h3>
                            <p>Tổng số</p>
                        </div>
                    </div>
                    <div class="col pt-3 text-center border-right">
                        <div class="status-box">
                            <h3 class="fw-bold" style="color:rgb(58, 173, 0)"> {{ $answeredCount }}</h3>
                            <p>Đã làm</p>
                        </div>
                    </div>
                    <div class="col pt-3 text-center border-right">
                        <div class="status-box">
                            <h3 class="fw-bold" style="color:rgb(218, 196, 0)">{{ $totalAnswer - $answeredCount }}</h3>
                            <p>Chưa làm</p>
                        </div>
                    </div>
                    <div class="col pt-3 text-center">
                        <div class="status-box">
                            <h3 class="fw-bold" style="color:rgb(40, 0, 218)">
                                {{ $this->calculateProgress() }} %
                            </h3>
                            <p>Tiến độ</p>
                        </div>
                    </div>
                </div>
                <div class="iq-progress-bar-linear d-inline-block w-100">
                    <div class="iq-progress-bar iq-bg-danger">
                        <span class="bg-danger" data-percent="{{ $this->calculateProgress() }}"
                            style="transition: width 2s; width: {{ $this->calculateProgress() }}%;"></span>
                    </div>
                </div>


                <div class="row">
                    @foreach ($questions as $index => $question)
                        <div class="col-3 text-center px-0 mb-2">
                            @if (isset($answers[$index]))
                                <button type="button" class="btn btn-outline-primary px-4 question-button"
                                    wire:click="scrollToQuestion({{ $index }})">
                                    {{ $index + 1 }}. <b>
                                        {{ chr(65 + array_search($answers[$index], array_column($question['answers'], 'id'))) }}</b>

                                </button>
                            @else
                                <button type="button" class="btn btn-outline-secondary px-4 question-button"
                                    wire:click="scrollToQuestion({{ $index }})">
                                    {{ $index + 1 }}.
                                </button>
                            @endif
                        </div>
                    @endforeach
                </div>
                <div class="border-top pt-3">
                    @if (!$canSubmit)
                        <button style="width:100%" type="button" class="btn btn-secondary btn-lg" disabled>
                            Nộp bài
                        </button>
                    @else
                        <button style="width:100%" type="button" class="btn btn-primary btn-lg" data-toggle="modal"
                            data-target="#exampleModalCenter">
                            Nộp bài
                        </button>
                    @endif
                </div>
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                Bạn có chắc chắn hoàn tất nộp bài ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" wire:click="submitExam">Nộp
                                    thôi!</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Khoan đã</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('scroll-to-question', event => {
            const questionId = event.__livewire.params[0].questionId;
            console.log('Received questionId:', questionId);
            const element = document.getElementById('question_' + questionId);
            if (element) {
                element.scrollIntoView({
                    behavior: 'smooth',
                    block: 'end'
                });
             
            }
        });

        document.addEventListener('DOMContentLoaded', () => {
            Livewire.hook('message.processed', () => {
                const progressBar = document.querySelector(".iq-progress-bar .bg-danger");

                if (progressBar) {
                    const progressValue = progressBar.getAttribute("data-percent");
                    if (progressValue) {
                        progressBar.style.width = progressValue + "%";
                        console.log(`Progress bar updated to ${progressValue}%`);
                    }
                }
            });
        });
    </script>
    <style>
        .question-button {
            width: 80%;
            text-align: center;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        
    </style>
</div>
