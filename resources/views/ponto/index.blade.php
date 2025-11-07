@php
    $page = ['ponto'];
    $js = 'ponto';
@endphp
@extends('layouts.main_layout')
@section('breadcrumb')
@endsection

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <!-- Início Card header - Título e botão -->
        <div class="card-header pb-0">
          <div class="d-lg-flex">
            <h5 class="mb-0">Lista de Folha de Ponto</h5>
            <div class="ms-auto my-auto mt-lg-0 mt-4">
              <a class="btn btn-primary" href="javascript:;" onclick="gerarFolha()" data-bs-toggle="tooltip" data-bs-placement="right" title="Gerar Folhas de Ponto"><i class="fas fa-file-import fa-lg me-1"></i> Gerar</a>
            </div>
          </div>
            <div>
            </div>
            @include('layouts.menus_bar.botoes_meses')
        </div>
        <!-- Fim Card header - Título e botão -->
        <!-- Início Card body - Tabela -->
        <div class="card-body px-0 pb-0" id="tabela">
        </div>
      </div>
    </div>
</div>

@include('ponto.modals.modal_save_anexo')
@endsection

@section('js')
@endsection