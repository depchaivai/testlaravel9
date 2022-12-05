<?php

namespace App\Http\Controllers;

use App\Models\Images;
use App\Services\CloudinarySerVice;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index(){
        return Images::orderBy('updated_at', 'DESC')->get();
    }

    public function store(Request $request, CloudinarySerVice $fileUpload){
        $file = $fileUpload->uploadFile($request->file('image'));
        if ($file) {
            $newImage = new Images;
            $newImage->src = $file;
            if ($request->name) {
                $newImage->name = $request->name;
            }
            $newImage->save();
        }
        return ['success' => false];
    }
    
    public function destroy($id){
        return Images::destroy($id);
    }
}
