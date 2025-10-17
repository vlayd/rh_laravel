@php
    $page = ['servidor'];
    $js = 'servidor';
@endphp
@extends('layouts.main_layout')

@section('breadcrumb')
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <!-- Card header -->
            <div class="card-header pb-0">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="col-12 fs-4 fw-bold text-center">Todos os Servidores</div>
                    </div>
                    <div class="col-12 btn-group mt-3">
                        <a href="javascript:;" class="btn btn-warning colunas mb-0 col-12" onclick="config(1)"><i class="fas fa-user-cog fa-lg fa-fw text-white"></i>&nbsp;&nbsp;&nbsp;MODO CONFIGURAÇÃO</a>
                        <a href="javascript:;" class="btn btn-warning d-none config mb-0 col-12" onclick="config(0)"><i class="fas fa-users fa-lg fa-fw text-white"></i>&nbsp;&nbsp;&nbsp;MODO PERFIL</a>
                        <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#opcoesModal" class="btn btn-primary mb-0 col-12"><i class="fas fa-cog fa-lg fa-fw text-white"></i>&nbsp;&nbsp;&nbsp;MINHAS COLUNAS</a>
                        <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addServidor" class="btn bg-gradient-info mb-0 col-12"><i class="fa-solid fa-user-plus fa-lg fa-fw text-white"></i>&nbsp;&nbsp;&nbsp;NOVO SERVIDOR</a>
                    </div>
                    <div class="col-12 text-center btn-group">
                        <div href="javascript:;" id="btn_ativo" class="btn btn-success"><i class="fas fa-user-check fa-lg fa-fw text-white"></i>&nbsp;&nbsp;&nbsp;ATIVOS</div>
                        <div href="javascript:;" id="btn_inativo" class="btn btn-danger"><i class="fas fa-user-times fa-lg fa-fw text-white"></i>&nbsp;&nbsp;&nbsp;INATIVOS</div>
                    </div>                            
                </div>                
            </div>
            <div class="card-body px-0 pb-0" id="tabela_servidor">
            </div>
        </div>
    </div>
</div>

@include('servidor.modals.modal_altera_acao')
@include('servidor.modals.modal_add_servidor')
@endsection

@section('js')
<?=CDN_JS_MASK?>
@endsection
