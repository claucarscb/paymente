<?php

namespace App\Http\Controllers;

use App\Models\Conta;
use App\Service\ContaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $conta = new ContaService();
       $resultado = $conta->index();
        return response()->json($resultado);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $infos=$request->all();

        $validacao=Validator::make($infos,[
            'numero'=>'required|integer',
            'banco_id'=>'required',
            'usuario_id'=>'required',
            'saldo'=>'required'
        ]);

        if($validacao->fails()){
            return response()->json($validacao->errors());
        }

       $conta = new ContaService();
       $dados = $conta->store($infos);
        return response()->json($dados);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $conta = new ContaService();
        $resultado = $conta->show($id);
        return response()->json($resultado);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $conta = new ContaService();
        $apagar = $conta->delete($id);
        return response()->json($apagar);
    }
}
