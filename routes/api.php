<?php

use App\Http\Controllers\BancoController;
use App\Http\Controllers\ChaveController;
use App\Http\Controllers\ContaController;
use App\Http\Controllers\TransacoesController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/banco',[BancoController::class,'store']);

Route::get('/banco',[BancoController::class,'index']);

Route::get('/banco/{id}',[BancoController::class,'show']);


Route::post('/usuario',[UsuarioController::class,'store']);

Route::get('/usuario',[UsuarioController::class,'index']);

Route::get('/usuario/{id}',[UsuarioController::class,'show']);

Route::post('/usuario/{id}',[UsuarioController::class,'update']);

Route::delete('/usuario/{id}',[UsuarioController::class,'destroy']);


Route::post('/conta',[ContaController::class,'store']);

Route::get('/conta',[ContaController ::class,'index']);

Route::get('/conta/{id}',[ContaController::class,'show']);

Route::delete('/conta/{id}',[ContaController::class,'destroy']);


Route::post('/transacao',[TransacoesController::class,'store']);

Route::get('/transacao/{id}',[TransacoesController::class,'show']);

Route::get('/transacoes/receptor/{receptorId}',[TransacoesController::class,'transacoes']);

Route::post('/pix',[TransacoesController::class,'pagamentoPix']);


Route::post('/chave',[ChaveController::class,'store']);

Route::get('/chave',[ChaveController::class,'index']);

Route::post('chave/{id}',[ChaveController::class,'update']);

Route::delete('chave/{id}',[ChaveController::class,'destroy']);
