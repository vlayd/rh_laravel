<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Services\Operations;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function index()
    {
        if(!session('user')){
            return view('login/index');
        }
        $dados = [
            'dadosRetangulo' => [
                [
                    'color' => 'dark',
                    'title' => 'Humanização',
                    'valueAtual' => '21',
                    'valueAnterior' => '22',
                    'valueProximo' => '23',
                ],
                [
                    'color' => 'primary',
                    'title' => 'Aniversariantes',
                    'valueAtual' => $this->retornaAniversariantes( MES_ATUAL, 'count'),
                    'valueAnterior' => $this->retornaAniversariantes( MES_ANTERIOR, 'count'),
                    'valueProximo' => $this->retornaAniversariantes( MES_PROXIMO, 'count'),
                    'idCollapse' => 'Aniversariantes'
                ],
                [
                    'color' => 'warning',
                    'title' => 'Férias',
                    'valueAtual' => '20',
                    'valueAnterior' => '20',
                    'valueProximo' => '20',
                ],
                [
                    'color' => 'success',
                    'title' => 'Licença',
                    'valueAtual' => '20',
                    'valueAnterior' => '20',
                    'valueProximo' => '20',
                ],
            ],
            'aniversarios' => [
                [
                    'mes' => MES[MES_ATUAL],
                    'lista' => $this->retornaAniversariantes(MES_ATUAL),
                    'classe' => '',
                ],
                [
                    'mes' => MES[MES_PROXIMO],
                    'lista' => $this->retornaAniversariantes(MES_PROXIMO),
                    'classe' => 'd-none',
                ],
                [
                    'mes' => MES[MES_ANTERIOR],
                    'lista' => $this->retornaAniversariantes(MES_ANTERIOR),
                    'classe' => 'd-none',
                ],
            ]
        ];
        return view('home/index', $dados);
    }

    private function retornaAniversariantes($mes, $type = ''){
        $query = DB::table('usuarios')->select(['id', 'nome', 'foto', 'aniversario'])->whereMonth('aniversario', $mes)->whereNot("rh", 0);
        if($type == 'count') return $query->count();
        return $query->orderBy('aniversario', 'ASC')->get();
    }

    private function retornaAniversariantes3Meses(){
        $mesAnterior = date('m', strtotime('-1 month'));
        $mesProximo = date('m', strtotime('+1 month'));
        return DB::table('usuarios')
                    ->select(['nome', 'foto', 'aniversario'])
                    ->whereMonth('aniversario', '>=', $mesAnterior)
                    ->whereMonth('aniversario', '<=', $mesProximo)
                    ->whereNot("rh", 0)
                    ->orderBy('aniversario', 'ASC')->get();
    }
}
