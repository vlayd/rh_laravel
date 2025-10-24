<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistoricoController extends Controller
{
   public function detail($id)
    {
        // die('A quill não está pegando o valor da observação');
        $id = $this->decriptId($id);
        $setores = DB::table('setores')->get();
        $servidor = DB::table('usuarios')->find($id);
        $contratos = DB::table('contratos')->get();
        $cargos = DB::table('cargos')->get();
        $gratificacoes = DB::table('gratificacoes')->get();
        $anexos = DB::table('anexos')->where(['tipo' => 10, 'id_usuario' => $id])->get(['id', 'nome']);
        $anexosInicialInterino = $this->jsonAnexo($anexos);
        $dados = [
            'servidor' => $servidor,
            'contratos' => $contratos,
            'cargos' => $cargos,
            'gratificacoes' => $gratificacoes,
            'setores' => $setores,
            'anexos' => $anexos,
            'anexosInicialInterino' => $anexosInicialInterino,
            'chefias' => ['1'=> 'NÃO', '2' => 'SIM'],
        ];
        if($this->getTabela($id, 'count') > 0){
            $historicos = $this->getTabela($id);
            die('chegou');
            $atual = DB::table('historicos')->where(['atual'=> 1, 'id_usuario' => $id])->first();
            $interinos = DB::table('funcao_interina')->select(SELECT_FUNCAO_INTERINA)
                    ->join(JOIN_FUNCAOINTERINA_SETOR[0], JOIN_FUNCAOINTERINA_SETOR[1], '=', JOIN_FUNCAOINTERINA_SETOR[2], 'left')
                    ->where('id_usuario', $id)->get();
            $anexosAtual = $this->jsonAnexo($anexos, json_decode($atual->anexos));
            $dados['historicos'] = $historicos;
            $dados['interinos'] = $interinos;
            $dados['anexosAtual'] = $this->jsonAnexo($anexos, json_decode($atual->anexos));
            $dados['atual'] = $atual;
        } else {
            //Se não tiver histórico registrado, 
            $dados['anexosAtual'] = $this->jsonAnexo($anexos);

        }
        
        
        
        return view('historico.index', $dados);
    }

    public function save(Request $request)
    {
        $dados = [
            'alteracao' => json_encode($request['alteracao']??'["1"]'),
            'id_usuario' => $request['id_usuario'],
            'contrato' => $request['contrato'],
            'cargo' => $request['cargo'],
            'matricula' => $request['matricula'],
            'funcao' => $request['funcao'],
            'gratificacao' => $request['gratificacao'],
            'chefia' => $request['chefia'],
            'setor' => $request['setor'],
            'data_contratacao' => $request['data_contratacao'],
            'data_rescisao' => $request['data_rescisao'],
            'anexos' => json_encode($request['anexos']),
        ];
        if(isset($request['atual'])) {
            $dados['atual'] = $request['atual'];
            DB::table('historicos')->where(['id_usuario' => $request['id_usuario'], 'atual' => 1])->update(['atual' => 0]);
        }

        if(empty($request['id_historico'])){
            DB::table('historicos')->insert($dados);
        } else {
            DB::table('historicos')->where(['id' => $request['id_historico']])->update($dados);
        }
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        DB::table('historicos')->where('id', $request['id_historico'])->delete();
        $this->deleteInterino($request);
        return redirect()->back();
    }

    public function deleteInterino(Request $request)
    {
        try {
            if (isset($request['id_historico'])){
                DB::table('funcao_interina')->where('id_historico', $request['id_historico'])->delete();
            } else {
                DB::table('funcao_interina')->where('id_interino', $request['id_interino'])->delete();
            } 
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
        return redirect()->back();
    }

    public function saveInterino(Request $request)
    {
        $dados = [
            'funcao' => $request['funcao_interina'],
            'setor' => $request['setor_interino'],
            'observacao' => $request['observacao_interino'],
            'chefia' => $request['chefia_interino'],
            'anexos' => json_encode($request['anexos_interino']),
            'data_contratacao' => $request['data_contratacao_interino'],
            'data_rescisao' => $request['data_rescisao_interino'],
            'id_usuario' => $request['id_usuario_interino'],
            'id_historico' => $request['id_historico_interino'],
        ];
        if(empty($request['id_interino'])) {
            DB::table('funcao_interina')->insert($dados);
        } else {
            DB::table('funcao_interina')->where(['id' => $request['id_interino']])->update($dados);
        }
        return redirect()->back();
    }

    private function getTabela($id, $tipo = '')
    {
        $query = DB::table('historicos')
            ->select(SELECT_TIME_LINE)
            ->join(JOIN_HISTORICO_CONTRATO[0], JOIN_HISTORICO_CONTRATO[1], '=', JOIN_HISTORICO_CONTRATO[2], 'left')
            ->join(JOIN_HISTORICO_CARGO[0], JOIN_HISTORICO_CARGO[1], '=', JOIN_HISTORICO_CARGO[2], 'left')
            ->join(JOIN_HISTORICO_GRATIFICACAO[0], JOIN_HISTORICO_GRATIFICACAO[1], '=', JOIN_HISTORICO_GRATIFICACAO[2], 'left')
            ->join(JOIN_HISTORICO_SETOR[0], JOIN_HISTORICO_SETOR[1], '=', JOIN_HISTORICO_SETOR[2], 'left')
            ->join(JOIN_HISTORICO_ANEXO[0], JOIN_HISTORICO_ANEXO[1], '=', JOIN_HISTORICO_ANEXO[2], 'left')
            ->where(['historicos.id_usuario' => $id])->orderBy('historicos.data_contratacao', 'DESC');
        
        if($tipo == 'count') return $query->count();
        return $query->get();
    }
}
