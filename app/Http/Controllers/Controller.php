<?php

namespace App\Http\Controllers;

use App\Services\Operations;
use Illuminate\Support\Facades\DB;

abstract class Controller
{
    public function __construct()
    {
        define('CURRENT_USER', DB::table('usuarios')->where('id', session('user.id'))->first());
    }

    public static function getAnexo ($idAnexo)
    {
        return DB::table('anexos')->where(['id' => $idAnexo])->first();
    }

    public function anexoPorUser (int $idUser, int $idTipo, string $retorno)
    {
        $query = DB::table('anexos')
        ->where([
            ['id_usuario', $idUser],
            ['status', 1],
            ['tipo', $idTipo],
        ]);
        if($retorno == 'count') return $query->count();
        elseif($retorno == 'lista') return $query->orderBy('ordem')->get();
    }

    protected function uploadFile($inputFile, $path, bool $nomeOriginal, $oldFile = '')
    {
        if($nomeOriginal) $fileName = $inputFile->getClientOriginalName();
        else $fileName = time() . '.' . $inputFile->extension();
        
        $inputFile->move(public_path($path), $fileName);
        if (!empty($oldFile)) $this->deleteFile($path, $oldFile);

        return $fileName;
    }

    protected function deleteFile($path, $nome)
    {
        try {
            if (file_exists($path . '/' . $nome)) {
                unlink($path . '/' . $nome);
                return true;
            }
        } catch (\Throwable $e) {
            return false;
        }
    }

    protected function decriptId($id)
    {
        $id = Operations::decriptId($id);
        if ($id == null || $id == '') return redirect()->route('index');
        else return $id;
    }

    protected function jsonAnexo($jsonAll, array $jsonSelect=[])
    {
        $jsonRetorno = [];
        foreach($jsonAll as $item){
            if($jsonSelect != [] && in_array($item->id, $jsonSelect)) $jsonRetorno[] = ['value' => $item->id, 'label'=> $item->nome, 'selected' => true];
            else $jsonRetorno[] = ['value' => $item->id, 'label'=> $item->nome];
        }
        return json_encode($jsonRetorno);
    }

    public static function setFuncaoInterina($idHistorico)
    {
        return DB::table('usuarios')->where('id', session('user.id'))
        ->select(SELECT_FUNCAO_INTERINA)
        ->join('setores', JOIN_FUNCAOINTERINA_SETOR)
        ->where(['id_historico' => $idHistorico])->get();
    }
}
