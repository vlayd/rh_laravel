<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServidorController extends Controller
{
   public function index()
    {
        return view('servidor.index');
    }

    public function listar()
    {
        $lista = $this->listaArrayUsuariosIndex();
        $colunas = $this->listaArray('colunas');
        $colunasVisiveis = DB::table('colunas_visiveis')->where('id_usuario', session('user.id'))->first();
        if($colunasVisiveis != null) $colunasSelect = json_decode($colunasVisiveis->colunas);
        else $colunasSelect = [];
        $dados =
        [
            'lista' => $lista,
            'colunas' => $this->listaArray('colunas'),
            'colunasSelect' => $colunasSelect,
        ];
        return view('servidor.tabela', $dados);
    }

    private function listaArrayUsuariosIndex(){
        try {
            $itens = DB::table('usuarios')
                    ->select(SELECT_LISTA_USUARIO_INDEX)
                    ->join('contratos', 'usuarios.contrato', '=', 'contratos.id', 'left')
                    ->join('setores', 'usuarios.setor', '=', 'setores.id', 'left')
                    ->get();
            return json_decode(json_encode($itens), true);
        } catch (\Throwable $th) {
            die($th->getMessage());
        }
    }

    public function listaArray(string $tabela){
        try {
            $itens = DB::table($tabela)->get();
            return json_decode(json_encode($itens), true);
        } catch (\Throwable $th) {
            die($th->getMessage());
        }
    }
}
