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

    protected function listaArray(string $tabela)
    {
        try {
            $itens = DB::table($tabela)->get();
            return json_decode(json_encode($itens), true);
        } catch (\Throwable $th) {
            die($th->getMessage());
        }
    }

    protected function removeCsrfArray(array $array):array
    {
        unset($array['_token']);
        return $array;
    }

    protected function retornaAniversariantes($mes, $type = '')
    {
        $query = DB::table('usuarios')->select(['id', 'nome', 'foto', 'aniversario'])->whereMonth('aniversario', $mes)->whereNot("rh", 0);
        if($type == 'count') return $query->count();
        return $query->orderBy('aniversario', 'ASC')->get();
    }

    public function retornaPontoMes($mes, $ano = '', string $type = '')
    {
        if(empty($ano)) $ano = date('Y');
        $query = DB::table('ponto')->where(["mes" => $mes, "ano" => $ano, 'status' => 0]);
        if($type == 'count') return $query->count();
        return $query->orderBy('nome')->get();
    }

    public function formataData($data, $format = "d/m/Y")
    {
        $date=date_create($data);
        return date_format($date,$format);
    }

    public function diffDaysNow($date1)
    {        
        $date1 = date_create($date1);
        $textColor = '';
        $now = date_create("2000-".date("m-d"));
        $diff = date_diff($date1, $now);
        $count = '';
        if($diff->format("%R") == '-'){
            $textColor = 'text-primary';
            $count = $diff->format("Faltam %a dias");
            if($diff->format("%a") == 1) $count = $diff->format("Falta %a dias");
        } else {
            $count = $diff->format("Passaram %a dias");
            if($diff->format("%a") == 1) $count = $diff->format("Passou %a dias");
            $textColor = 'text-secondary';
            if($diff->format("%R%a") == '+0'){
                $count = '<i class="fas fa-birthday-cake"></i> É hoje, parabéns! <i class="fas fa-birthday-cake"></i>';
                $textColor = 'text-danger';
            }
        }
        return '<p class="text-xs font-weight-bold mb-0 text-center '.$textColor.'">'.$count.'</p>';         
    }

    public function diffYearsNow($date1)
    {
        $date1 = date_create($date1);
        $now = date_create(date("Y-m-d"));
        $diff = date_diff($date1, $now);
        return "{$diff->y} anos";
    }

    public function convertbjectToArray($object)
    {
        return json_decode(json_encode($object), true);
    }
}
