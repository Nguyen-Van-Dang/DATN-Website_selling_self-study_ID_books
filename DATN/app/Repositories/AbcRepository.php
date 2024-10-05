<?php

namespace App\repositories;

use App\Models\Abc;
use Illuminate\Support\Facades\Storage;
class AbcRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function getAll()
    {
        $allAbc = Abc::getAll();
        return view('admin.abc.abc', ['allAbc' => $allAbc]);
    }
    public function createAbc()
    {
        $abc = Abc::getAll();
        return view('admin.abc.addAbc', ['abc' => $abc]);
    }
    public function handleImage($data)
    {
        if ($data->hasFile('thumbnail')) {
            $file = $data->file('thumbnail');
            $path = $file->store('public/thumbnails');
            $filePath = str_replace('public/', '', $path);
        } else {
            $filePath = null;
        }
        $abc = new Abc();
        $abc->thumbnail = $filePath;
        $abc->save();
        $path = $file->store('public/thumbnail');
        // dd($data);
        $allAbc = Abc::getAll();
        return view('admin/abc/addAbc', ['allAbc' => $allAbc]);
    }

    // public function handleImage($data)
    // {
    //     // Kiểm tra xem tệp có được tải lên hay không
    //     $file = $data->file('url');
    
    //     $fileName = $file->getClientOriginalName();
    //     $directory = 'Book';
    //     $disk = Storage::disk('google');
        
    //     if (!$disk->exists($directory)) {
    //         $disk->makeDirectory($directory);
    //     }
        
    //     $filePath = $directory . '/' . $fileName;
    //     $disk->put($filePath, file_get_contents($file));
    //     $meta = $disk->getAdapter()->getMetadata($filePath)->extraMetadata()['id'];
    
    //     $abc = new Abc();
    //     // $abc->name = $data->name;
    //     $abc->url = 'https://drive.google.com/file/d/' . $meta . '/preview';
    //     $abc->thumbnail = $filePath;
    //     $abc->save();
        
    //     return redirect()->back()->with('success', 'abc created successfully');
    // }
    
}
