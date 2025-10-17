<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

    class AnexoController extends Controller
{
    private $tabela = 'anexos';
    public function index($id)
    {
        $idUser = $this->decriptId($id);
        $dados = [
            'servidor' => DB::table('usuarios')->find($idUser),
            'anexos' => DB::table($this->tabela)->where('id_usuario', $idUser)->get(),
            'path' => PATH_UPLOAD_USUARIO.$idUser.'/anexo/',
        ];
        
        return view('anexo.index', $dados);
    }

    public function salvar(Request $request)
    {
        $oldFile = '';
        $id = '';
        $idUser = $this->decriptId($request['id_user']);
        $dados = [
            'nome' => $request['nome'],
            'tipo' => $request['tipo'],
            'ordem' => $request['ordem'],
            'id_usuario' => $idUser,
        ];

        if(!empty($request['id_anexo'])) {
            $id = $request['id_anexo'];
            DB::table($this->tabela)->where('id', $id)->update($dados);
            $oldFile = DB::table($this->tabela)->where('id', $id)->first()->anexo??'';
        } else {
            $id = DB::table($this->tabela)->insertGetId($dados);
        }

        if($request->hasFile('anexo')){
            $nomeAnexo = $this->uploadFile($request->file('anexo'), PATH_UPLOAD_USUARIO.$idUser.'/anexo', true, $oldFile);
        }
        if(!empty($nomeAnexo)) DB::table($this->tabela)->where('id', $id)->update(['anexo' => $nomeAnexo]);
        
        return redirect()->back();
    }

    public function deletar(Request $request)
    {
        $id = $request['id'];
        try {
            if(!empty($id)){
                $anexo = DB::table($this->tabela)->find($id);
                $path = PATH_UPLOAD_ANEXO.'/'.$anexo->id_usuario.'/anexo';
                $this->deleteFile($path, $anexo->anexo);
                DB::table($this->tabela)->delete($id);
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            return 'erro ' . $th->getMessage();
        }
    }
}
