<?php

namespace App\View\Components\client;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Http\Controllers\Client\LectureHistoryController;


class LectureHistory extends Component
{
    public $histories;

    public function __construct()
    {
        $this->histories = LectureHistoryController::getHistories();
    }

    public function render()
    {
        return view('components.client.lecture-history');
    }
}
