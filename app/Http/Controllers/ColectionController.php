<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Product;
use Illuminate\Http\Request;

class ColectionController extends Controller
{
    public function index(){
        return Collection::with('products')->get();
    }

    public function destroy($id){
        $productCount = Product::where('collection',$id)->count();
        if ($productCount > 0) {
            return 0;
        }
        return Collection::destroy($id);
    }

    public function store(Request $request){
        return Collection::create($request->all());
    }

    public function editCollection(Request $request,$id){
        return Collection::find($id)->update($request->all());
    }

    public function getByText($text){
        return Collection::where('name','LIKE','%'.$text.'%')->take(10)->get();
    }
}
