<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $repo = null;

    public function getAll(){
        return $this->repo->getAll();
    }

    public function create(Request $request){
        return $this->repo->create($request->all());
    }
    
    public function update(Request $request, $id){
        return $this->repo->update($id,$request->all());
    }

    public function delete($id){
        return $this->repo->delete($id);
    }
}
