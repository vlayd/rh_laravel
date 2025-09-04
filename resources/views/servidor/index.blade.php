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
                <div class="row">
                    <div class="col-12"></div>
                    <div class="col-12"></div>
                    <div class="col-12"></div>
                    <div class="col-12">
                        <div class="row align-items-center">
                            <div class="col-12 col-xl-6 fs-4 fw-bold text-center">Todos os Servidores</div>
                            <div class="col-12 col-xl-6 text-center mt-2 px-0">
                                <div class="col-12 col-xl-6 px-0 mx-0">
                                    <div href="javascript:;" id="btn_ativo" class="mb-0 btn btn-success w-45 mx-0 px-0"><i class="fas fa-user-check fa-lg fa-fw text-white"></i>&nbsp;&nbsp;&nbsp;ATIVOS</div>
                                    <div href="javascript:;" id="btn_inativo" class="mb-0 btn btn-danger w-45 mx-0 px-0"><i class="fas fa-user-times fa-lg fa-fw text-white"></i>&nbsp;&nbsp;&nbsp;INATIVOS</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row px-0 pt-3 text-center">
                                    <div class="col-12 col-lg-6 px-0">
                                        <a href="javascript:;" class="btn btn-primary colunas w-100 mx-0" onclick="config(1)"><i class="fas fa-user-cog fa-lg fa-fw text-white"></i>&nbsp;&nbsp;&nbsp;MODO CONFIGURAÇÃO</a>
                                        <a href="javascript:;" class="btn btn-primary d-none w-100 mx-0 config" onclick="config(0)"><i class="fas fa-users fa-lg fa-fw text-white"></i>&nbsp;&nbsp;&nbsp;MODO PERFIL</a>
                                    </div>
                                    <div class="col-12 col-lg-6 px-0 mx-0">
                                        <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#opcoesModal" class="btn btn-primary w-100 mx-0 px-0"><i class="fas fa-cog fa-lg fa-fw text-white"></i>&nbsp;&nbsp;&nbsp;MINHAS COLUNAS</a>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-12 col-xl-4 text-center text-xl-end align-items-start px-0">
                        <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addServidor" class="btn bg-gradient-primary btn-sm mb-0 w-100 w-lg-75">+&nbsp; Novo Servidor</a>
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
<script src="{{asset('assets/js/view/servidor.js')}}" type="text/javascript"></script>

@endsection
