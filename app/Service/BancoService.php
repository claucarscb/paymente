<?php

namespace App\Service;

use App\Models\Banco;

class BancoService
{

    public function create($informacoes)
    {
        $dados = Banco::create($informacoes);
        return $dados;
    }

    public function show($id){
        $banco = Banco::find($id);
        return $banco;
    }

    public function index(){
        $bancos = Banco::get();
        return $bancos;
    }
}
