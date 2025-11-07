<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ColunaController extends Controller
{
    public function save(Request $request)
    {
        //Primeiro é removido o tokem csrf do form e depois é extraído os seus valores para salvar
        $colunas = array_values($this->removeCsrfArray($request->post()));
        DB::table('colunas_visiveis')->updateOrInsert(
            [
                'id_usuario' => session('user.id')
            ],
            [
                'id_usuario' => session('user.id'),
                'colunas' => json_encode($colunas),
            ]
       );
       return redirect()->back();
    }
}
