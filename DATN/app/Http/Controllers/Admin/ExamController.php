<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exports\ExamQuestionsExport;
use Maatwebsite\Excel\Facades\Excel;

class ExamController extends Controller
{
    public function index()
    {
        if (Auth::id() == 1) {
            $exams = Exam::all();
        } else {
            $exams = Exam::whereIn('course_id', function ($query) {
                $query->select('id')
                    ->from('courses')
                    ->where('user_id', Auth::id());
            })->get();
        }
        return view('admin.exam.index', compact('exams'));
    }

    public function create()
    {
        return view('admin.exam.create');
    }
    public function edit($examId)
    {
        if (Auth::id() == 2) {
            $examCheck = Exam::where('id', $examId)
                ->whereIn('course_id', function ($query) {
                    $query->select('id')
                        ->from('courses')
                        ->where('user_id', Auth::id());
                })
                ->exists();

            if (!$examCheck) {
                return redirect()->back()->with('error', 'Không có quyền truy cập.');
            }
        }

        return view('admin.exam.edit', compact('examId'));
    }


    public function download($id)
    {
        $exam = Exam::findOrFail($id);
        $fileName = 'Exam_Questions_' . $exam->name . '.xlsx';
        return Excel::download(new ExamQuestionsExport($id), $fileName);
    }

    public function destroy($id)
    {
        $exam = Exam::findOrFail($id);

        $exam->delete();

        return redirect()->back()->with('success', 'Xóa bài thi thành công.');
    }
}
