<?php

namespace App\Http\Controllers;

use App\Services\Operations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

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

    public function detail($id, $pdf = 0)
    {
        $id = Operations::decriptId($id);
        if($id == null) return redirect()->route('/');
        //LEFT deve ter, pois evita o nulo (servidor)
        $atual = DB::table('historicos')
        ->select(SELECT_SERVIDOR_DETAIL)
        ->join('usuarios', 'historicos.id_usuario', '=', 'usuarios.id', 'LEFT')
        ->join('contratos', 'historicos.contrato', '=', 'contratos.id', 'LEFT')
        ->join('escolaridades', 'usuarios.escolaridade', '=', 'escolaridades.id', 'LEFT')
        ->join('cargos', 'historicos.cargo', '=', 'cargos.id', 'LEFT')
        ->join('gratificacoes', 'historicos.gratificacao', '=', 'gratificacoes.id', 'LEFT')
        ->join('setores', 'historicos.setor', '=', 'setores.id', 'LEFT')
        ->where(['historicos.id_usuario' => $id, 'historicos.atual' => '1'])
        ->first();

        //Funcão Interina
        $interinas = DB::table('funcao_interina')
        ->select(SELECT_FUNCAO_INTERINA)
        ->join('setores', 'funcao_interina.setor', '=', 'setores.id', 'LEFT')
        ->where(['funcao_interina.id_usuario' => $id])
        ->get();;

        //Históricos
        $historicos = DB::table('historicos')
        ->select(SELECT_SERVIDOR_HISTORICOS)
        ->join('contratos', 'historicos.contrato', '=', 'contratos.id', 'LEFT')
        ->join('cargos', 'historicos.cargo', '=', 'cargos.id', 'LEFT')
        ->join('gratificacoes', 'historicos.gratificacao', '=', 'gratificacoes.id', 'LEFT')
        ->join('setores', 'historicos.setor', '=', 'setores.id', 'LEFT')
        // ->join('anexos', 'historicos.anexos', '=', 'anexos.id', 'LEFT')
        ->where(['historicos.id_usuario' => $id, 'historicos.atual' => '0'])
        ->get();

        $atual->idade = Operations::diffYearsNow($atual->nascimento);
        $atual->nascimento = Operations::formataData($atual->nascimento);
        $atual->cpf = Operations::formataCPF($atual->cpf);
        $atual->rg = "$atual->rg_numero $atual->rg_orgao_emissor/$atual->rg_uf";
        
        $atual->endereco = "{$atual->endereco_rua}, nº {$atual->endereco_numero}, {$atual->endereco_bairro}, {$atual->endereco_complemento}, {$atual->endereco_cidade}-Acre";
        $atual->escolaridade = ESCOLARIDADE[$atual->escolaridade];
        $anexos = null;
        if($atual->anexos != null){
            foreach(json_decode($atual->anexos) as $anexo){
                $anexos[] = $this->getAnexo($anexo);
            }
        }
        $atual->anexos = $anexos;
        $dados = [
            'idUser' => $id,
            'atual' => $atual,
            'historicos' => $historicos,
            'interinas' => $interinas,
            'anexos' => [
                'faculdade' => $this->anexoPorUser($id, 5, 'lista'),
                'pos' => $this->anexoPorUser($id, 6, 'lista'),
                'mestrado' => $this->anexoPorUser($id, 7, 'lista'),
                'doutorado' => $this->anexoPorUser($id, 8, 'lista'),
            ],
        ];
        if($pdf == 1) return view('servidor.pdf.detail_pdf', $dados);
        return view('servidor.detail', $dados);
    }

    public function pesquisaCpf(Request $request)
    {
        $dados = ['cpf' => $request['cpf']];
        return DB::table('usuarios')->where($dados)->count();
    }

    public function salvaCpf(Request $request)
    {
        $cpf = str_replace(['.', '-'], '', $request['cpf']);
        $dados = [
            'cpf' => $cpf,
            'senha' => md5($cpf),
        ];
        $salva = DB::table('usuarios')->insertGetId($dados);
        if($salva){
            return redirect()->route('servidor.edit', [Crypt::encrypt($salva)]);
        }
    }

    public function edit($id)
    {
        $id = $this->decriptId($id);

        $dados = [
            'idUser' => $id,
            'servidor' => DB::table('usuarios')->find($id),
            'escolaridades' => DB::table('escolaridades')->get(),
        ];
        // dd($servidor);

        return view('servidor.form_save', $dados);

    }    

    public function update(Request $request)
    {
        $id = Operations::decriptId($request['user_id']);
        $query = DB::table('usuarios')->where('id', $id);
        $usuario = $query->first();
        $old = empty($usuario->foto) ? $usuario->foto : '';
        // dd($request->post());
        $dados = [
            'nome' => $request['nome'],
            'sexo' => $request['sexo'],
            'rg_numero' => $request['rg_numero'],
            'rg_orgao_emissor' => $request['rg_orgao_emissor'],
            'rg_uf' => $request['rg_uf'],
            'nascimento' => $request['nascimento'],
            'aniversario' => empty($request['nascimento']) ? $request['nascimento'] : '2000'.substr($request['nascimento'], 4),
            'escolaridade' => $request['escolaridade'],
            'secretaria_origem' => $request['secretariaOrigem'],
            'nome_o_classe' => $request['escolaridade'] > 5 ?$request['ordemClassNome']:'',
            'numero_o_classe' => $request['escolaridade'] > 5 ?$request['ordemClassNumero']:'',
            'telefone' => $request['telefone1'],
            'telefone2' => $request['telefone2'],
            'email' => $request['email1'],
            'email2' => $request['email2'],
            'endereco_rua' => $request['endereco_rua'],
            'endereco_numero' => $request['endereco_numero'],
            'endereco_bairro' => $request['endereco_bairro'],
            'endereco_complemento' => $request['endereco_complemento'],
            'endereco_cidade' => $request['endereco_cidade'],
        ];

        if($request->hasFile('foto')){
            $dados['foto'] = $this->uploadFile($request->file('foto'), PATH_UPLOAD_USUARIO.$id.'/perfil', $old);
        }

        $query->update($dados);
        return redirect()->route('servidor');
    }

    private function listaArrayUsuariosIndex()
    {
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

    public function listaArray(string $tabela)
    {
        try {
            $itens = DB::table($tabela)->get();
            return json_decode(json_encode($itens), true);
        } catch (\Throwable $th) {
            die($th->getMessage());
        }
    }
    
}
