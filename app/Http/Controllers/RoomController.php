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
        $name = $request->file('image')->getClientOriginalName();
        $filename = pathinfo($name, PATHINFO_FILENAME);
        $result = $request->file('image')->storeOnCloudinaryAs('product',$filename)->getSecurePath();
        if ($result) {
            $validated['image'] = $result;
        }
        if ($request->eng_name){
            $validated['eng_name'] = $request->eng_name;
            $validated['eng_slug'] = \Str::slug($request->eng_name,'-');
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
        if ($request->file('image')) {
            $name = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($name, PATHINFO_FILENAME);
            $result = $request->file('image')->storeOnCloudinaryAs('product', $filename)->getSecurePath();
            if ($result) {
                $validated['image'] = $result;
            }
        }
        if ($request->eng_name){
            $validated['eng_name'] = $request->eng_name;
            $validated['eng_slug'] = \Str::slug($request->eng_name,'-');
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
