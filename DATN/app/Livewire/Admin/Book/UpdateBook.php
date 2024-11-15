<?php

namespace App\Livewire\Admin\Book;

use App\Jobs\UpdateFileJob;
use App\Models\Book;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Services\GoogleDriveService;
use App\Jobs\UploadFileJob;

class UpdateBook extends Component
{
    use WithFileUploads;
    // livewire component
    public $teachers, $categories;
    public $bookName, $bookUpdate, $selectedCategories = [], $bookAuthor, $bookId, $bookFile, $bookImage, $imageGallery = [], $bookPrice, $bookDiscount, $bookDescription, $bookPage, $bookQuantity, $newImageGallery = [], $newImage;

    public function mount($book, $teachers, $categories,)
    {

        $this->teachers = $teachers;
        $this->categories = $categories;
        $this->bookId = $book->id;
        $this->bookName = $book->name;
        $this->selectedCategories = $book->categories->pluck('id')->toArray();
        $this->bookAuthor = $book->user_id;
        $this->bookPrice = $book->price;
        $this->bookDiscount = $book->discount;
        $this->bookDescription = $book->description;
        $this->bookPage = $book->page_number;
        $this->bookQuantity = $book->quantity;

        $this->getOldFile($book);
        $this->getOldImage($book);
    }

    public function submit()
    {
        // dd($this->imageGallery);
        if (filter_var($this->bookFile, FILTER_VALIDATE_URL)) {
            $this->bookFile = null;
        }
        if (filter_var($this->bookImage, FILTER_VALIDATE_URL)) {
            $this->bookImage = null;
        }
        $this->validate();

        // Tìm kiếm sách
        $book = Book::findOrFail($this->bookId);
        $book->update([
            'name' => $this->bookName,
            'user_id' => $this->bookAuthor,
            'price' => $this->bookPrice,
            'discount' => $this->bookDiscount,
            'description' => $this->bookDescription,
            'page_number' => $this->bookPage,
            'quantity' => $this->bookQuantity
        ]);

        // Cập nhật các danh mục cho sách
        $book->categories()->sync($this->selectedCategories);

        // Cập nhật file PDF
        if ($this->bookFile instanceof \Illuminate\Http\UploadedFile) {
            $oldFile = $book->images()->where('image_name', 'pdf')->first();
            $folderId = '1K39vh4EQrCA9OdhP3fAJjznJmtQFkYhe'; // Thư mục lưu trữ file PDF
            $filePath = $this->bookFile->store('temp');

            if (isset($oldFile->image_url)) {
                UpdateFileJob::dispatch($book, $oldFile->image_url, $filePath, $folderId, 'pdf');
            } else {
                UploadFileJob::dispatch($book, $folderId, $filePath, 'pdf');
            }
        };

        //Cập nhật ảnh thumbnail
        if ($this->bookImage instanceof \Illuminate\Http\UploadedFile) {
            $oldFile = $book->images()->where('image_name', 'thumbnail')->first();
            $folderId = '1jIobzkPoHsvWQcg8vS07_Vhq_YwFn1Ce'; // Thư mục lưu trữ ảnh
            $filePath = $this->bookImage->store('temp');

            if (isset($oldFile->image_url)) {
                UpdateFileJob::dispatch($book, $oldFile->image_url, $filePath, $folderId, 'thumbnail');
            } else {
                UploadFileJob::dispatch($book, $folderId, $filePath, 'thumbnail');
            }
        }

        //Cập nhật ảnh gallery
        $folderId = '1GJqVmrH7YKaf1D0vIxkFLpXvh4DE8Jv9';
        $oldGallery = $book->images()->where('image_name', 'gallery')->get();
        for ($i = 0; $i < 4; $i++) {

            $image = $this->imageGallery[$i];

            // Kiểm tra nếu ảnh là URL
            if (is_string($image) && filter_var($image, FILTER_VALIDATE_URL)) {
                continue;
            }

            if ($image instanceof \Illuminate\Http\UploadedFile) {
                $filePath = $image->store('temp');

                // Kiểm tra xem có ảnh cũ tại vị trí này trong database không
                if (isset($oldGallery[$i])) {
                    UpdateFileJob::dispatch($book, $oldGallery[$i]->image_url, $filePath, $folderId, 'gallery');
                } else {
                    // Nếu chưa có ảnh tại vị trí này trong database, tạo mới
                    UploadFileJob::dispatch($book, $folderId, $filePath, 'gallery');
                }
            }
        }


        return redirect()->route('admin.sach.index')->with('success', 'Thêm mới sách thành công');
    }

    public function getOldFile($book)
    {
        $file = $book->images()->where('image_name', 'pdf')->first();
        if ($file) {
            $this->bookFile = $file->image_url;
        }
    }
    public function getOldImage($book)
    {
        $thumbnail = $book->images()->where('image_name', 'thumbnail')->first();
        if ($thumbnail) {
            $this->bookImage = $thumbnail->image_url;
        }

        $gallery = $book->images()->where('image_name', 'gallery')->get();
        foreach ($gallery as $image) {
            $this->imageGallery[] = $image->image_url;
        }
        $this->imageGallery = array_merge($this->imageGallery, [null, null, null, null]);
        $this->imageGallery = array_slice($this->imageGallery, 0, 4);
    }
    public function render()
    {

        return view('livewire.admin.book.update-book');
    }

    protected $rules = [
        'bookName' => 'required|max:50', // Không được để trống, tối đa 50 ký tự
        'bookDescription' => 'required', // Không được để trống
        'bookAuthor' => 'required', // Không được để trống
        'bookFile' => 'nullable|mimes:pdf,xlsx,xls', // Cho phép trống và nếu có file thì phải là PDF hoặc Excel
        'bookPrice' => 'required|numeric|min:1000', // Giá sách phải từ 1000 trở lên
        'bookDiscount' => 'nullable|numeric|min:0|max:99', // Phần trăm giảm giá phải từ 0 đến 99
        'selectedCategories' => 'required|array|min:1|max:5', // Chọn tối thiểu 1 danh mục và tối đa 5 danh mục
        'bookImage' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Ảnh bìa bắt buộc và phải là ảnh
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
        'bookImage.image' => 'Ảnh bìa phải là một tệp ảnh.',
        'bookImage.mimes' => 'Ảnh bìa chỉ được phép có định dạng jpeg, png, jpg.',
        'bookImage.max' => 'Ảnh bìa không được vượt quá 2MB.',
        'imageGallery.array' => 'Danh sách ảnh phải là một mảng.',
        'imageGallery.min' => 'Vui lòng chọn ít nhất một ảnh phụ.',
        'imageGallery.max' => 'Tối đa chỉ được chọn 4 ảnh phụ.',
        'bookPage.required' => 'Vui lòng nhập số trang.',
        'bookPage.min' => 'Số trang phải lớn hơn hoặc bằng 1.',
        'bookQuantity.required' => 'Vui lòng nhập số lượng.',
        'bookQuantity.min' => 'Số lượng phải lớn hơn hoặc bằng 100.',
        'bookQuantity.max' => 'Số lượng không được vượt quá 2000.',
        'bookQuantity.numeric' => 'Số lượng phải là một số.',
    ];
}
