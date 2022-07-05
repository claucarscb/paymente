<?php

namespace App\Http\Controllers;

use App\Models\Chave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chaves=Chave::get();
        return response()->json($chaves);
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
            'tipo'=>'required',
            'chave'=>'required',
            'conta_id'=>'required'
        ]);
        if($validacao->fails()){
            return response()->json($validacao->errors());
        }

        $chave=Chave::create($dados);
        return response()->json($chave);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $dados=$request->all();
        $chaveupdate=Chave::find($id)->update($dados);
        return response()->json($chaveupdate);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $apagarCahave=Chave::where('id',$id)->delete();
        return response()->json($apagarCahave);
    }
}
