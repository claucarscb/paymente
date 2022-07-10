<?php

namespace App\Http\Controllers;

use App\Models\Conta;
use App\Models\Transacoes;
use App\Service\TransacoesService;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransacoesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       //
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
        $dados=$request->all();

        $validacao=Validator::make($dados,[
            'pagador_id'=>'required',
            'receptor_id'=>'required',
            'valor'=>'required'
        ]);

        if($validacao->fails()){
            return response()->json($validacao->errors());
        }

        $transacao = new TransacoesService();
        $resultado = $transacao->create($dados);
        return response()->json($resultado);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transacao = new TransacoesService();
        $resultado = $transacao->show($id);
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
        //
    }

    public function transacoes($receptorId){
        $transacao = new TransacoesService();
        $resultado = $transacao->transacoes($receptorId);
        return response()->json($resultado);
    }

    public function pagamentoPix(Request $request){
        $dados = $request->all();
        $validacao = Validator::make($dados,[
           'chave'=>'required|string',
           'valor'=>'required|integer',
           'pagador_id'=>'required|integer'
        ]);

        if($validacao->fails()){
            return response()->json($validacao->errors());
        }

        $transacao = new TransacoesService();
        $resultado = $transacao->pagamentoPix($dados);
        return response()->json($resultado);
    }
}
