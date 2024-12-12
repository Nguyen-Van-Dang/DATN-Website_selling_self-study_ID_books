<?php

namespace App\Livewire\Admin\Book;

use App\Models\Book;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Services\GoogleDriveService;
use App\Jobs\UploadFileJob;
use Illuminate\Support\Facades\Auth;

class CreateBook extends Component
{
    use WithFileUploads;
    // livewire component
    public $teachers, $categories;
    public $bookName, $selectedCategories = [], $bookAuthor, $bookFile, $bookImage, $imageGallery = [], $bookPrice, $bookDiscount, $bookDescription, $bookPage, $bookQuantity;

    public function mount($teachers, $categories)
    {
        $this->teachers = $teachers;
        $this->categories = $categories;
        
        if(Auth::user()->role_id === 2){
            $this->bookAuthor = Auth::user()->id;
        }
    }

    public function submit()
    {

        $this->validate();

        // Tạo mới sách
        $book = new Book;
        $book->name = $this->bookName;
        $book->price = $this->bookPrice;
        $book->discount = $this->bookDiscount;
        $book->page_number = $this->bookPage;
        $book->description = $this->bookDescription;
        $book->quantity = $this->bookQuantity;
        $book->user_id = $this->bookAuthor;
        $book->status = Auth::user()->role_id == 1 ? 0 : 1;
        $book->save();

        // Gán các danh mục cho sách
        $book->categories()->attach($this->selectedCategories);

        // Lưu file PDF
        $folderId = '1K39vh4EQrCA9OdhP3fAJjznJmtQFkYhe';
        $filePath = $this->bookFile->store('temp');
        UploadFileJob::dispatch($book, $folderId, $filePath, 'pdf');

        // Lưu ảnh thumbnail
        $folderId = '1jIobzkPoHsvWQcg8vS07_Vhq_YwFn1Ce';
        $filePath = $this->bookImage->store('temp');
        UploadFileJob::dispatch($book, $folderId, $filePath, 'thumbnail');
        // Lưu ảnh gallery
        foreach ($this->imageGallery as $image) {
            $folderId = '1GJqVmrH7YKaf1D0vIxkFLpXvh4DE8Jv9';
            $fileGalleryPath = $image->store('temp');
            UploadFileJob::dispatch($book, $folderId, $fileGalleryPath, 'gallery');
        }

        return redirect()->route('admin.sach.index')->with('success', 'Thêm mới sách thành công');
    }
    public function render()
    {

        return view('livewire.admin.book.create-book');
    }

    protected $rules = [
        'bookName' => 'required|max:50', // Không được để trống, tối đa 50 ký tự
        'bookDescription' => 'required', // Không được để trống
        'bookAuthor' => 'required', // Không được để trống
        'bookFile' => 'required|mimes:pdf,xlsx,xls', // Dạng file là Excel hoặc PDF
        'bookPrice' => 'required|numeric|min:1000', // Giá sách phải từ 1000 trở lên
        'bookDiscount' => 'nullable|numeric|min:0|max:99', // Phần trăm giảm giá phải từ 0 đến 99
        'selectedCategories' => 'required|array|min:1|max:5', // Chọn tối thiểu 1 danh mục và tối đa 5 danh mục
        'bookImage' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Ảnh bìa bắt buộc và phải là ảnh
        'imageGallery' => 'nullable|array|min:1|max:4', // Ảnh phụ, tối thiểu 1, tối đa 4 ảnh
        // 'imageGallery.*' => 'image|mimes:jpeg,png,jpg|max:2048', // Ảnh phụ phải là ảnh và có định dạng jpeg, png, jpg
        'bookPage' => 'required|numeric|min:1', // số trang tối thiểu là 1
        'bookQuantity' => 'required|numeric|min:100|max:2000', // số lượng tối thiểu 100 và tối đa 2000
    ];

    protected $messages = [
        'bookName.required' => 'Vui lòng nhập tên sách.',
        'bookName.max' => 'Tên sách không được quá 50 ký tự.',
        'bookDescription.required' => 'Vui lòng ghi đầy đủ mô tả cuốn sách',
        'bookAuthor.required' => 'Vui lòng chọn tác giả.',
        'bookFile.mimes' => 'File sách phải có định dạng PDF hoặc Excel.',
        'bookFile.required' => 'Vui lòng tải lên sách PDF hoặc Excel.',
        'bookPrice.required' => 'Vui lòng nhập giá sách.',
        'bookPrice.numeric' => 'Giá sách phải là một số.',
        'bookPrice.min' => 'Giá sách phải từ 1000 trở lên.',
        'bookDiscount.numeric' => 'Giảm giá phải là một số.',
        'bookDiscount.min' => 'Giảm giá không thể nhỏ hơn 0.',
        'bookDiscount.max' => 'Giảm giá không thể vượt quá 99%.',
        'selectedCategories.required' => 'Vui lòng chọn ít nhất một danh mục.',
        'selectedCategories.array' => 'Danh mục sách phải là một mảng.',
        'selectedCategories.min' => 'Vui lòng chọn tối thiểu 1 danh mục.',
        'selectedCategories.max' => 'Tối đa chỉ được chọn 5 danh mục.',
        'bookImage.required' => 'Vui lòng chọn ảnh bìa.',
        'bookImage.image' => 'Ảnh bìa phải là một tệp ảnh.',
        'bookImage.mimes' => 'Ảnh bìa chỉ được phép có định dạng jpeg, png, jpg.',
        'bookImage.max' => 'Ảnh bìa không được vượt quá 2MB.',
        'imageGallery.array' => 'Danh sách ảnh phải là một mảng.',
        'imageGallery.min' => 'Vui lòng chọn ít nhất một ảnh phụ.',
        'imageGallery.max' => 'Tối đa chỉ được chọn 4 ảnh phụ.',
        // 'imageGallery.*.image' => 'Ảnh phụ phải là một tệp ảnh.',
        // 'imageGallery.*.mimes' => 'Ảnh phụ chỉ được phép có định dạng jpeg, png, jpg.',
        // 'imageGallery.*.max' => 'Ảnh phụ không được vượt quá 2MB.',
        'bookPage.required' => 'Vui lòng nhập số trang.',
        'bookPage.min' => 'Số trang phải lớn hơn hoặc bằng 1.',
        'bookQuantity.required' => 'Vui lòng nhập số lượng.',
        'bookQuantity.min' => 'Số lượng phải lớn hơn hoặc bằng 100.',
        'bookQuantity.max' => 'Số lượng không được vượt quá 2000.',
        'bookQuantity.numeric' => 'Số lượng phải là một số.',
    ];
}
