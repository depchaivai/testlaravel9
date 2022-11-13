<?php

namespace App\Http\Controllers;

use App\Models\Info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InfoController extends Controller
{
    public function index(){
        return Info::all();
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'info' => 'required',
            'type' => 'required'
        ]);
        $validated = $validator->validate();
        return Info::create($validated);
    }

    public function editInfo(Request $request,$id){
        $validator = Validator::make($request->all(),[
            'info' => 'required',
            'type' => 'required'
        ]);
        $validated = $validator->validate();
        return Info::find($id)->update($validated);
    }

    public function destroy($id){
        return Info::destroy($id);
    }

}
