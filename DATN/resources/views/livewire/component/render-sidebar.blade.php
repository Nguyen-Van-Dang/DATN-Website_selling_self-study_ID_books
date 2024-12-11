<nav class="iq-sidebar-menu">
    <ul id="iq-sidebar-toggle" class="iq-menu">
        <li>
            <a href="#ui-element" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false">
                <span class="ripple rippleEffect"></span>
                <img class="sidebar-icon me-2" src="{{ asset('assets/images/book/icon/book_icon.png') }}" alt="">
                <span class="px-2">Sách yêu thích</span>
                <i class="ri-arrow-right-s-line iq-arrow-right"></i>
            </a>
            <ul id="ui-element" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                @if ($books && count($books) > 0)
                    @foreach ($books as $book)
                        <li class="elements">
                            <a href="{{ route('bookDetail', $book->id) }}" class="iq-waves-effect collapsed py-1"
                                title="{{ $book->name }}">
                                <div class="d-flex align-items-center">
                                    <img class="BookImage"
                                        src="{{ $book->images()->where('image_name', 'thumbnail')->first()->image_url ?? asset('assets/images/book/book_placeholder.png') }}">
                                    <span class="px-2">{{ Str::limit($book->name, 20, '...') }}</span>
                                </div>
                            </a>
                        </li>
                    @endforeach
                @else
                    <li class="elements">
                        <a href="#" class="iq-waves-effect collapsed  py-1">
                            <div class="d-flex align-items-center">
                                <img class="BookImage" src="{{ asset('assets/images/book/book_placeholder.png') }}">
                                <span class="px-2">Không có</span>
                            </div>
                        </a>
                    </li>
                @endif
            </ul>
        </li>
        <hr class="custom">
        <li>
            <a href="#ui-elements" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false">
                <span class="ripple rippleEffect"></span>
                <img class="sidebar-icon me-2" src="{{ asset('assets/images/book/icon/play_icon.png') }}"
                    alt="">
                <span class="px-2">Khoá học của bạn</span>
                <i class="ri-arrow-right-s-line iq-arrow-right"></i>
            </a>
            <ul id="ui-elements" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                @if ($courses && count($courses) > 0)
                    @foreach ($courses as $course)
                        <li class="elements">
                            <a href="{{ route('khoa-hoc.show', $course->id) }}" class="iq-waves-effect collapsed py-1"
                                title="{{ $course->name }}">
                                <div class="d-flex align-items-center">
                                    <img class="CourseImage"
                                        src="{{ $course->images()->where('image_name', 'thumbnail')->first()->image_url ?? asset('assets/images/book/course_thumbnail.png') }}">
                                    <span class="px-2">{{ Str::limit($course->name, 20, '...') }}</span>
                                </div>
                            </a>
                        </li>
                    @endforeach
                @else
                    <li class="elements">
                        <a href="#" class="iq-waves-effect collapsed  py-1">
                            <div class="d-flex align-items-center">
                                <img class="CourseImage" src="{{ asset('assets/images/book/course_thumbnail.png') }}">
                                <span class="px-2">Không có</span>
                            </div>
                        </a>
                    </li>
                @endif
            </ul>
        </li>
        <hr class="custom">
        <li>
            <a href="#ui-elements2" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false">
                <span class="ripple rippleEffect"></span>
                <img class="sidebar-icon me-2" src="{{ asset('assets/images/book/icon/library_icon.png') }}"
                    alt="">
                <span class="px-2">Nhóm chat của bạn</span>
                <i class="ri-arrow-right-s-line iq-arrow-right"></i>
            </a>
            <ul id="ui-elements2" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                @if ($chatGroups && count($chatGroups) > 0)
                    @foreach ($chatGroups as $chatGroup)
                        <li class="elements">
                            <a href="{{ route('chat.show', ['id' => $chatGroup->id]) }}"
                                class="iq-waves-effect collapsed py-1">
                                <div class="d-flex align-items-center">
                                    <img class="CourseImage"
                                        src="{{ $chatGroup->images()->where('image_name', 'thumbnail')->first()->image_url ?? asset('assets/images/book/course_thumbnail.png') }}">
                                    <span class="px-2">{{ Str::limit($chatGroup->name, 20, '...') }}</span>
                                </div>
                            </a>
                        </li>
                    @endforeach
                @else
                    <li class="elements">
                        <a href="#" class="iq-waves-effect collapsed  py-1">
                            <div class="d-flex align-items-center">
                                <img class="CourseImage" src="{{ asset('assets/images/book/default_groupchat.png') }}">
                                <span class="px-2">Không có</span>
                            </div>
                        </a>
                    </li>
                @endif
            </ul>
        </li>
        <hr class="custom">
        <h6 class="px-4 mt-3 mb-0">Giáo viên</h6>
        <div class="overflow-scroll" style="max-height: 35vh; overflow-y: auto; overflow-x: hidden;">
            @foreach ($teachers as $teacher)
                <li>
                    <a href="{{ route('userDetail', $teacher->id) }}" class="iq-waves-effect py-1"
                        aria-expanded="false">
                        <span class="ripple rippleEffect"></span>
                        <img class="sidebar-icon me-2" style="border-radius: 50%"
                            src="{{ $teacher->images()->where('image_name', 'thumbnail')->first()->image_url ?? asset('assets/images/book/user_thumbnail.png') }}">
                        <span class="px-2">{{ $teacher->name }}</span>
                    </a>
                </li>
            @endforeach
            @if ($teachers->count() < $allTeacher->count())
                <ul>
                    <li class="text-center">
                        <a href="{{ route('userDetail', $teacher->id) }}" wire:click.prevent="loadMore"
                            id="show-more-btn" class="iq-waves-class=px-2">
                            <small>
                                <i class="bi bi-arrow-down-circle"></i>
                                <span>Xem thêm</span>
                            </small>

                        </a>
                    </li>
                </ul>
            @endif
        </div>


    </ul>
</nav>
