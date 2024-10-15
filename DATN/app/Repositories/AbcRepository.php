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
        $file = $data->file('thumbnail');
        $fileName = $file->getClientOriginalName();
        $directory = 'Books';

        $disk = Storage::disk('google');
        
        if (!$disk->exists($directory)) {
            $disk->makeDirectory($directory);
        }
    
        $filePath = $directory . '/' . $fileName;
        $disk->put($filePath, file_get_contents($file));
        
        $meta = $disk->getAdapter()->getMetadata($filePath)->extraMetadata()['id'];
    
        $abc = new Abc();
        $abc->thumbnail = $data->file('thumbnail');
        $abc->thumbnail = 'https://drive.google.com/file/d/' . $meta . '/preview';
        $abc->save();
    
        return redirect()->back();
    }
    
}
