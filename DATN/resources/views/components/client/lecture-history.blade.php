<div class="iq-card iq-card-block iq-card-stretch iq-card-height">
    <h5 class="p-3">
        Lịch sử bài giảng đã xem
    </h5>
    <div class="border-top p-3">
        <div class="row">
            <div class="col-12">
                @forelse($histories as $history)
                    <li class="li">
                        <a
                            href="{{ route('khoa-hoc.chitiet', ['course_id' => $history->lecture->course->id, 'lecture_id' => $history->lecture->id]) }}">
                            <h5 class="h5">{{ $history->lecture->name }}</h5>
                        </a>
                    </li>
                    <span class="span">{{ $history->last_accessed_at }}</span>
                @empty
                    <li class="li">Chưa có lịch sử xem nào...</li>
                @endforelse
            </div>
        </div>
    </div>

    <style>
        .li {
            list-style-type: none;
            position: relative;
            padding-left: 20px;
        }

        .li::before {
            content: "-";
            position: absolute;
            left: 0;
            color: #000;
            font-weight: bold;
        }

        .h5 {
            font-size: 18px;
            margin-bottom: 0;
        }

        .h5:hover {
            color: var(--iq-primary) !important;
            font-size: 18px;
            transition: .6s;
        }

        .span {
            margin-left: 72%;
            font-size: 12px;
        }
    </style>
</div>
