<?php

namespace App\Service;

use App\Models\Chave;
use App\Models\Conta;
use App\Models\Transacoes;

class TransacoesService
{

    public function create($dados)
    {
        $pagador = Conta::where('usuario_id', $dados['pagador_id'])->first();

        if (!$pagador) {
            return 'Pagador nao exixte';
        }

        if ($dados['valor'] > $pagador['saldo']) {
            return 'Saldo insuficiente';
        }

        $receptor = Conta::where('usuario_id', $dados['receptor_id'])->first();

        if (!$receptor) {
            return 'receptor nao exixte';
        }

        $saldoReceptor = $receptor['saldo'] + $dados['valor'];
        $receptor->update(['saldo' => $saldoReceptor]);

        $saldoPagador = $pagador['saldo'] - $dados['valor'];
        $pagador->update(['saldo' => $saldoPagador]);

        $transacao = Transacoes::create($dados);
        return $transacao;
    }

    public function show($id)
    {
        $transacao = Transacoes::find($id);
        return $transacao;
    }

    public function transacoes($receptorId)
    {
        $transacoes = Transacoes::where('receptor_id', $receptorId)->get();
        return $transacoes;
    }

    public function pagamentoPix($dados)
    {
        $contaPix = Chave::where('chave', $dados['chave'])->first();

        if ($contaPix) {
            $contaReceptor = Conta::where('id', $contaPix['conta_id'])->first();

            $contaPagador = Conta::where('usuario_id', $dados['pagador_id'])->first();
            if ($contaPagador) {

                if ($dados['valor'] > $contaPagador['saldo']) {
                    return 'saldo insuficiente';
                }
                $valor = $contaReceptor['saldo']  + $dados['valor'];
                $contaReceptor->update(['saldo' => $valor]);

                $debito = $contaPagador['saldo'] - $dados['valor'];
                $contaPagador->update(['saldo' => $debito]);

                $transacao = Transacoes::create([
                    'pagador_id' => $contaPagador['usuario_id'],
                    'receptor_id' => $contaReceptor['usuario_id'],
                    'valor' => $dados['valor']
                ]);
                return $transacao;
            }
            return 'erro na transacao';
        }
    }
}
