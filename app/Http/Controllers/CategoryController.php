<?php

namespace App\Http\Controllers;

use App\Http\Requests\CateRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        return Category::all();
    }

    public function store(CateRequest $request){
        $validated = $request->validated();
        $validated['slug'] = changeTitle($validated['name']);
        if ($validated['eng_name']) {
            $eng_slug = \Str::slug($validated['eng_name'],'-');
            $validated['eng_slug'] = $eng_slug;
        }
        return Category::create($validated);
    }

    public function editCate(CateRequest $request,$id){
        $validated = $request->validated();
        $validated['slug'] = changeTitle($validated['name']);
        if ($validated['eng_name']) {
            $eng_slug = \Str::slug($validated['eng_name'],'-');
            $validated['eng_slug'] = $eng_slug;
        }
        return Category::find($id)->update($validated);
    }

    public function destroy($id){
        return Category::destroy($id);
    }

    public function getListSlug(){
        return Category::pluck('slug');
    }

    public function getListEngSlug(){
        return Category::where('eng_slug','<>',null)->pluck('eng_slug');
    }

    public function getBySlug($slug){
        return Category::where('slug', $slug)->first();
    }
}
