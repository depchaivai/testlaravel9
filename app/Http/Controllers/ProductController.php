<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCate;
use App\Models\ProductImage;
use App\Models\Room;
use App\Services\CloudinarySerVice;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return Product::with(['images','cates'])->get();
    }

    public function store(ProductRequest $request, CloudinarySerVice $fileUpload)
    {
        $file = $fileUpload->uploadFile($request->file('image'));
        $validated = $request->safe()->merge($request->all())->toArray();
        $validated['slug'] = changeTitle($validated['name']);
        if ($file) {
            $validated['image'] = $file;
        }
        if ($validated['eng_name']) {
            $validated['eng_slug'] = \Str::slug($validated['eng_name'],'-');
        }
        $item = Product::create($validated);
        if ($item) {
            $allowType = ['jpg', 'jpeg', 'png', 'gif', 'webb' . 'svg'];
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $f) {
                    $fs = $fileUpload->uploadFile($f);
                    if ($fs) {
                        ProductImage::create([
                            "product" => $item->id,
                            "image" => $fs
                        ]);
                    }
                }
            }
            if ($request['cates']) {
                foreach ($request['cates'] as $anotherCate) {
                    ProductCate::create([
                        'product_id' => $item->id,
                        'cate_id' => $anotherCate
                    ]);
                }
            }
        }
        return $item;
    }

    public function editProduct(ProductRequest $request, $id, CloudinarySerVice $fileUpload)
    {
        $file = $fileUpload->uploadFile($request->file('image'));
        $validated = $request->validated();
        $validated['slug'] = changeTitle($validated['name']);
        if ($file) {
            $validated['image'] = $file;
        }
        $item = Product::find($id);
        if ($request['tags']) {
            $validated['tags'] = $request['tags'];
            if ($item->tags) {
                $validated['tags'] = $validated['tags'].','.$item->tags;
            }
        }
        if ($request->eng_name) {
            $validated['eng_name'] = $request->eng_name;
            $validated['eng_slug'] = \Str::slug($request->eng_name,'-');
        }
        if ($request->description) {
            $validated['description'] = $request->description;
        }
        if ($request->eng_description) {
            $validated['eng_description'] = $request->eng_description;
        }
        if ($request->long_description) {
            $validated['long_description'] = $request->long_description;
        }
        if ($request->long_eng_description) {
            $validated['long_eng_description'] = $request->long_eng_description;
        }
        if ($request->weight) {
            $validated['weight'] = $request->weight;
        }
        if ($request->long) {
            $validated['long'] = $request->long;
        }
        if ($request->long) {
            $validated['deep'] = $request->deep;
        }
        if ($request->width) {
            $validated['width'] = $request->width;
        }
        $updated = $item->update($validated);
        if ($updated) {
            $allowType = ['jpg', 'jpeg', 'png', 'gif', 'webb' . 'svg'];
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $f) {
                    $fs = $fileUpload->uploadFile($f);
                    if ($fs) {
                        ProductImage::create([
                            "product" => $item->id,
                            "image" => $fs
                        ]);
                    }
                }
            }
            if ($request->cates) {
                foreach ($request->cates as $anotherCate) {
                    ProductCate::create([
                        'product_id' => $item->id,
                        'cate_id' => $anotherCate
                    ]);
                }
            }
        }
        return $item;
    }

    public function destroy($id)
    {
        return Product::destroy($id);
    }

    public function deleteProductImage($id)
    {
        return ProductImage::destroy($id);
    }

    public function getListSlug()
    {
        return Product::pluck('slug');
    }

    public function getListEngSlug(){
        return Product::where('eng_slug','<>',null)->pluck('eng_slug');
    }

    public function getBySlug($slug)
    {
        return Product::where('slug', $slug)->with(['images','cates'])->first();
    }

    public function getByCate($cate)
    {   
        $category = Category::where('slug', $cate)->first();
        return Product::whereHas('cates',function($q)use($category){
            $q->where('cate_id',$category->id);
        })->orWhere('category', $category->id)->with('images')->get();
    }

    public function getByRoom($room)
    {   
        $rm = Room::where('slug', $room)->first();
        return Product::where('room', $rm->id)->with('images')->get();
    }

    public function getNewList()
    {
        return Product::orderBy('created_at', 'desc')->take(8)->get();
    }

    public function makeDecided($id)
    {
        $product = Product::find($id);
        $product->decide = !$product->decide;
        return $product->save();
    }

    public function getDecideList()
    {
        return Product::where('decide',true)->take(8)->get();
    }

    public function getSamiraList($id)
    {
        $item = Product::find($id);
        return Product::where('collection',$item->collection)->orWhere('category',$item->category)->orWhere('room',$item->room)->with('images')->take(10)->get();
    }

    public function destroyProductCate($id)
    {
        return ProductCate::destroy($id);
    }

    public function destroyTag(Request $request,$id){
        $tag = $request->tag;
        if ($tag) {
            $product = Product::find($id);
            $tagArr = explode(',',$product->tags);
            foreach ($tagArr as $key => $tagitem) {
                if ($tagitem == $tag) {
                    unset($tagArr[$key]);
                    break;
                }
            }
            $tagArr = array_values($tagArr);
            $newTagString = implode(',',$tagArr);
            $product->update(['tags' => $newTagString]);
        }
        else{
            return 0;
        }
        return 1;
    }

}
