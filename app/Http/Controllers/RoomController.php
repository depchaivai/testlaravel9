<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Services\FileUploadService;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        return Room::all();
    }

    public function store(Request $request, FileUploadService $fileUpload)
    {
        $validated = $request->validate(
            [
                'name' => ['required'],
            ]
        );
        $file = $fileUpload->uploadFile($request->file('image'));
        if ($file) {
            $validated['image'] = "storage/$file";
        }
        $validated['slug'] = changeTitle($validated['name']);
        return Room::create($validated);
    }

    public function updateRoom(Request $request, $id, FileUploadService $fileUpload)
    {
        $validated = $request->validate(
            [
                'name' => ['required'],
            ]
        );
        $file = $fileUpload->uploadFile($request->file('image'));
        if ($file) {
            $validated['image'] = "storage/$file";
        }
        $validated['slug'] = changeTitle($validated['name']);
        return Room::find($id)->update($validated);
    }

    public function destroy($id)
    {
        return Room::destroy($id);
    }

    public function getListSlug(){
        return Room::pluck('slug');
    }

    public function getBySlug($slug){
        return Room::where('slug',$slug)->first();
    }
}
