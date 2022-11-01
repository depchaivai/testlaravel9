<?php
namespace App\Services;

class CloudinarySerVice
{
    public function uploadFile($file, $dir="product"){
        if (!$file) {
            return false;
        }
        $name = $file->getClientOriginalName();
        $filename = pathinfo($name, PATHINFO_FILENAME);
        return $file->storeOnCloudinaryAs($dir,$filename)->getSecurePath();
    }
}
