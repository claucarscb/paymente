<?php

namespace App\Service;

use App\Models\Conta;

class ContaService{

    public function store($infos){
        $contas=Conta::create($infos);
        return $contas;
    }

    public function index(){
        $contas=Conta::get();
        return $contas;
    }

    public function show($id){
        $conta=Conta::find($id);
        return $conta;
    }

    public function delete($id){
        $conta=Conta::where('id',$id)->delete();
        return $conta;
    }
}
