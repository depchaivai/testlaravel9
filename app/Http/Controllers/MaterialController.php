<?php

namespace App\Http\Controllers;

use App\Http\Requests\MRequest;
use App\Models\Material;
use App\Services\CloudinarySerVice;
use App\Services\FileUploadService;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return Material::with('type')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MRequest $request, CloudinarySerVice $fileUpload)
    {
        $file = $fileUpload->uploadFile($request->file('image'));  
        $validated = $request->validated();
        $validated['slug'] = changeTitle($validated['name']);
        $validated['eng_name'] = changeTitle($validated['name']);
        if ($file) {
            $validated['image'] = $file;
        }
        return Material::create($validated);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editMaterial(MRequest $request, $id, CloudinarySerVice $fileUpload)
    {
        $file = $fileUpload->uploadFile($request->file('image'));  
        $validated = $request->validated();
        $validated['slug'] = changeTitle($validated['name']);
        $validated['eng_name'] = changeTitle($validated['name']);
        if ($file) {
            $validated['image'] = $file;
        }
        return Material::find($id)->update($validated);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Material::destroy($id);
    }
}
