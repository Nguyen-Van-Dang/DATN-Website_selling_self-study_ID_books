<?php

namespace App\Livewire\Client;

use Livewire\Component;
use App\Models\User;
use App\Models\Book;
use App\Models\Course;
use App\Models\OrderDetail;

class HomePage extends Component
{
    public $teachers, $topBuyBook, $popularCourses, $favBook, $Book, $saleBook;
    public $filter_time = 'Ngày';


    public function mount()
    {
        $this->getContent();
    }

    public function getContent()
    {
        $this->teachers = User::where('role_id', 2)
            ->where('active', 0)
            ->where(function ($query) {
                $query->whereHas('books')
                    ->orWhereHas('courses');
            })
            ->with(['courses', 'books'])
            ->get();
        $this->popularCourses = Course::orderBy('views', 'desc')->where('status', 0)->take(6)->get();
        $this->favBook = Book::withCount('favorites')->orderByDesc('favorites_count')->where('status', 0)->limit(6)->get();
        $this->Book = Book::orderBy('created_at', 'desc')->limit(4)->get();
        $this->saleBook = Book::where('discount', '>', 0)->where('status', 0)->orderBy('discount', 'desc')->take(10)->get();
        foreach ($this->teachers as $teacher) {
            $teacher->total_courses = $teacher->courses ? $teacher->courses->count() : 0;
            $teacher->total_books = $teacher->books ? $teacher->books->count() : 0;
        }
        $this->getBestSeller();
    }
    public function setFilterTime($time)
    {
        $this->filter_time = $time;
        $this->getBestSeller();
    }
    public function getBestSeller()
    {
        $query = Book::withSum('orderDetails as total_quantity', 'quantity')
            ->where('status', 0); // Chỉ lấy sách có status = 0

        $timeRangeStart = now();
        switch ($this->filter_time) {
            case 'Ngày':
                $timeRangeStart = now()->subDay();
                break;

            case 'Tuần':
                $timeRangeStart = now()->subDays(7);
                break;

            case 'Tháng':
                $timeRangeStart = now()->subDays(30);
                break;
        }
        $filteredBook = $query->whereHas('orderDetails', function ($q) use ($timeRangeStart) {
            $q->whereBetween('created_at', [$timeRangeStart, now()]);
        })->orderBy('total_quantity', 'desc')->first();
        if (!$filteredBook) {
            $filteredBook = $query->orderBy('total_quantity', 'desc')->first();
        }
        $this->topBuyBook = $filteredBook;
    }


    public function render()
    {
        return view('livewire.client.home-page');
    }
}
