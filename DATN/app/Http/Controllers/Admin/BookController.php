<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookCategories;
use App\Models\User;
use App\Repositories\BookRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    private BookRepository $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function getAllBook()
    {
        return $this->bookRepository->getAllBook();
    }

    public function getAllBookClient()
    {
        return $this->bookRepository->getAllBookClient();
    }
    public function getBookDetailClient($id)
    {
        return $this->bookRepository->getBookDetailClient($id);
    }
    public function index()
    {
        return view('admin.book.listBook');
    }
    public function create()
    {
        // controller
        if (Auth::user()->id == 1) {
            $teachers = User::where('role_id', 2)->get();
        }
        $categories = BookCategories::where('status', 0)->get();

        return view('admin.book.addBook', compact('teachers', 'categories'));
    }
    public function edit($id)
    {
        try {
            $book = Book::findOrFail($id);
            $categories = BookCategories::where('status', 0)->get();
            if (Auth::user()->id == 1) {
                $teachers = User::where('role_id', 2)->get();
            }
            return view('admin.book.editBook', compact('book', 'teachers', 'categories'));
        } catch (\Exception $e) {
            return redirect()->route('admin.sach.index')->with('error', 'Không thể tìm thấy sách.');
        }
    }

    public function destroy($id)
    {
        try {
            $book = Book::findOrFail($id);
            $book->delete();
            return redirect()->route('admin.sach.index')->with('success', 'Xóa sách thành công!');
        } catch (\Exception $e) {
            return redirect()->route('admin.sach.index')->with('error', 'Xóa sách thất bại!');
        }
    }
}
