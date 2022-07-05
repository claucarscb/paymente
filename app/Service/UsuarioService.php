<?php

namespace App\Service;

use App\Models\Usuario;

class UsuarioService{

    public function update($infos,$id){
        $dados=Usuario::find($id);
        if($dados){
            $updateDados=$dados->update($infos);
            return $updateDados;
        }

        return "usuario nao encontrado";

    }
}
