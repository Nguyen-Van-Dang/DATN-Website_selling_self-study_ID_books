<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BookCategories;

class BookCategoryController extends Controller
{
    public function __construct() {}
    public function index()
    {
        return view('admin.categoryBook.listCategoryBook');
    }
    public function create()
    {
        return view('admin.categoryBook.addCategoryBook');
    }
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:25|unique:book_categories,name',
        ], [
            'category_name.required' => 'Tên danh mục không được để trống.',
            'category_name.max' => 'Tên danh mục không được vượt quá 25 ký tự.',
            'category_name.unique' => 'Danh mục đã tồn tại.',
        ]);

        $saveCategory = new BookCategories;
        $saveCategory->name = $request->input('category_name');
        $saveCategory->description = $request->input('category_description');
        $saveCategory->status = Auth::user()->role_id == 1 ? 0 : 1;
        $saveCategory->save();
        if (Auth::user()->role_id == 2) {
            return redirect()->route('admin.danh-muc-sach.index')->with('success', 'Chờ quản trị duyệt');
        };
        return redirect()->route('admin.danh-muc-sach.index')->with('success', 'Danh mục sách đã được thêm thành công.');
    }
    public function edit($id)
    {
        $findCategory = BookCategories::findOrFail($id);
        return view('admin.categoryBook.updateCategoryBook', compact('findCategory'));
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'category_name' => 'required|max:255|unique:book_categories,name',
            'category_description' => 'nullable|max:500',
        ]);

        $saveCategory = BookCategories::findOrFail($id);
        $saveCategory->name = $request->input('category_name');

        $saveCategory->description = $request->input('category_description');

        $saveCategory->status = Auth::user()->role_id == 1 ? 0 : 1;
        $saveCategory->save();
        if (Auth::user()->role_id == 2) {
            return redirect()->back()->with('success', 'Chờ quản trị duyệt');
        };
        return redirect()->back()->with('success', 'Danh mục đã được cập nhật');
    }
    public function destroy($id)
    {
        $bookCategory = BookCategories::findOrFail($id);
        $bookCategory->delete();

        return redirect()->back()->with('success', 'Xoá danh mục thành công');
    }
}
