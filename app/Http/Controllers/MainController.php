<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Services\Operations;
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
                    'valueAtual' => $this->retornaAniversariantes( date('m'), 'count'),
                    'valueAnterior' => $this->retornaAniversariantes( date('m') - 1, 'count'),
                    'valueProximo' => $this->retornaAniversariantes( date('m') + 1, 'count'),
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
                    'mes' => MES_[date('n')],
                    'lista' => $this->retornaAniversariantes(date('m')),

                ]
            ]
        ];
        return view('home/index', $dados);
    }

    private function retornaAniversariantes(int $mes, string $type = ''){
        $query = DB::table('usuarios')->whereMonth('aniversario', $mes)->whereNot("rh", 0);
        if($type == 'count') return $query->count();
        return $query->orderBy('aniversario', 'ASC')->get();
    }
}
