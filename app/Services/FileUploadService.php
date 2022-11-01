<?php
namespace App\Services;

use Illuminate\Support\Facades\Storage;

class FileUploadService
{
    public function uploadFile($file, $accept = [], $dir="material",$disk = 'public'){
        if (!$file) {
            return false;
        }
        if (!empty($accept)) {
            $ext = $file->getClientOriginalExtension();
            if (!in_array($ext, $accept)) {
                return false;
            }
        }
        return Storage::disk('cloudinary')->put('product',$file);
        // return Storage::disk($disk)->put($dir,$file);
    }
}
