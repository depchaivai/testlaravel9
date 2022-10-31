<?php

namespace App\Http\Controllers;
use App\Models\Room;
use Cloudinary\Api\Upload\UploadApi;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        return Room::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => ['required'],
            ]
        );
        
        $file = (new UploadApi())->upload($request->file('image'));
        if ($file) {
            $validated['image'] = $file;
        }
        $validated['slug'] = changeTitle($validated['name']);
        return Room::create($validated);
    }

    public function updateRoom(Request $request, $id)
    {
        $validated = $request->validate(
            [
                'name' => ['required'],
            ]
        );
        $file = (new UploadApi())->upload($request->file('image'));
        if ($file) {
            $validated['image'] = $file;
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
