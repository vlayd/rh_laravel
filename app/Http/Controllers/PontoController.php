<?php

namespace App\Http\Controllers;

use App\Services\Operations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PontoController extends Controller
{
   public function index()
    {
        $itens = [];
        $servidores = DB::table('usuarios')->select(['id', 'nome', 'foto'])->whereNot('rh', 0)->get();
        foreach (MES as $key => $value) {
             $itens[$key] = [
                'count' => $this->retornaAniversariantes($key, 'count'),
                'lista' => $this->retornaAniversariantes($key)
            ];
        }
        $dados = [
            'aniversariantes' => $servidores,
            'itens' => $itens
        ];
        return view('ponto.index', $dados);
    }

    public function listar()
    {
        $lista = DB::table('usuarios')
            ->orderBy('nome')
            ->join('ponto', 'usuarios.id', '=', 'ponto.id_usuario')
            ->get();
        $lista = $this->convertbjectToArray($lista);
        
        $dados = 
        [
            'lista' => $lista,
        ];
        return view('ponto.tabela', $dados);
    }

    public function save(Request $request)
    {
        $dados = [];
        $id = Operations::decriptId($request['id_ponto']);
        $query = DB::table('ponto')->where('id', $id);
        $ponto = $query->first();
        $old = empty($ponto->anexo) ? $ponto->anexo : '';

        if($request->hasFile('anexo')){
            $dados['anexo'] = $this->uploadFile($request->file('anexo'), PATH_UPLOAD_USUARIO.$id.'/anexo', $old);
        }

        $query->update($dados);
        return redirect()->back();
    }

}
