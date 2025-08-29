<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
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
                    'valueAtual' => '20',
                    'valueAnterior' => '20',
                    'valueProximo' => '20',
                ],
                [
                    'color' => 'primary',
                    'title' => 'Aniversariantes',
                    'valueAtual' => '20',
                    'valueAnterior' => '20',
                    'valueProximo' => '20',
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
            'mesAtual' => [
                'total' => $this->retornaAniversariantes( date('m'), 'count'),
                'lista' => $this->retornaAniversariantes( date('m')),
            ],
            'mesSeguinte' => [
                'total' => $this->retornaAniversariantes( date('m') + 1, 'count'),
                'lista' => $this->retornaAniversariantes( date('m')),
            ],
            'mesAnterior' => [
                'total' => $this->retornaAniversariantes( date('m') - 1, 'count'),
                'lista' => $this->retornaAniversariantes( date('m')),
            ],
        ];

        return view('home/index', $dados);
    }

    private function retornaAniversariantes(int $mes, string $type = ''){
        $query = DB::table('usuarios')->whereMonth('aniversario', $mes)->whereNot("rh", 0);
        if($type == 'count') return $query->count();
        return $query->orderBy('aniversario', 'ASC')->get();
    }
}
