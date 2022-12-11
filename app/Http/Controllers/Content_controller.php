<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Services\CloudinarySerVice;
use Illuminate\Http\Request;

class Content_controller extends Controller
{

    public function index()
    {
        return Content::all();
    }

    public function store(Request $request, CloudinarySerVice $fileUpload)
    {
        $validated = $request->validate(
            [
                'title' => ['required'],
                'description' => ['required'],
                'content' => ['required'],
                'kind' => ['required'],
            ]
        );
        if ($request->exist_image) {
            $validated['image'] = $request->exist_image;
        }
        if (!$request->exist_image) {
            $file = $fileUpload->uploadFile($request->file('image'));
            if (!$file) {
                return ['success' => false, 'message'=>'vui lòng chọn ảnh'];
            }
            $validated['image'] = $file;
        }
        $validated['slug'] = \Str::slug($validated['title'],'-');
        return Content::create($validated);
    }

    public function editContent(Request $request, $id, CloudinarySerVice $fileUpload)
    {
        $validated = $request->validate(
            [
                'title' => ['required'],
                'description' => ['required'],
                'content' => ['required'],
                'kind' => ['required'],
            ]
        );
        if ($request->exist_image) {
            $validated['image'] = $request->exist_image;
        }
        if (!$request->exist_image) {
            $file = $fileUpload->uploadFile($request->file('image'));
            if ($file) {
                $validated['image'] = $file;
            }
        }
        $validated['slug'] = \Str::slug($validated['title'],'-');
        return Content::find($id)->update($validated);
    }

    public function destroy($id){
        return Content::destroy($id);
    }
}
