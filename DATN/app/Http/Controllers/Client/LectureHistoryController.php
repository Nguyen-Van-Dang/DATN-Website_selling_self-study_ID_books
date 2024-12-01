<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\LectureHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
class LectureHistoryController extends Controller
{
    // Cập nhật hoặc thêm lịch sử mới
    public static function updateHistory($lectureId)
    {
        $userId = Auth::id();   
        if ($userId) {
            LectureHistory::updateOrCreate(
                ['user_id' => $userId, 'lecture_id' => $lectureId],
                ['last_accessed_at' => now()]
            );
        } else {

        }
    }
    
    // Lấy danh sách lịch sử
    public static function getHistories()
    {
        return LectureHistory::with('lecture')
            ->where('user_id', Auth::id())
            ->orderBy('last_accessed_at', 'desc')
            ->get();
    }
}
