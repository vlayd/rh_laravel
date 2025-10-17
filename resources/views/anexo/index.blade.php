@php
    $page = ['servidor'];
    $js = 'anexo';
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
                    <div class="d-lg-flex">
                        <div>
                            <h5 class="mb-0">
                                Central de anexos de <strong class="text-danger">{{ $servidor->nome }}</strong>
                            </h5>
                            <p class="text-sm mb-0">
                                @include('layouts.inputs.input_select', [
                                    'label' => 'Tipo',
                                    'campo' => 'select_anexo',
                                    'items' => TIPOS_ANEXO_BASIC,
                                ])
                            </p>
                        </div>
                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">
                                <a href="#" class="btn bg-gradient-primary btn-sm mb-0 btn_prepare_save" data-bs-toggle="modal" data-bs-target="#modalSave" data-id="0">
                                    +&nbsp; Novo anexo
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body px-0 pb-0">
                    <div class="table-responsive">
                        <table class="table table-flush" id="servidores-list">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center">Descrição</th>
                                    <th class="text-center">Tipo</th>
                                    <th class="text-center">Ordem</th>
                                    <th class="text-center">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($anexos as $anexo)
                                    <tr>
                                        <td class="d-none" id="tipo<?=$anexo->id?>"><?=$anexo->tipo?></td>
                                        <td class="text-sm text-center"><h6 class="mb-0 text-xs" id="nome<?=$anexo->id?>"><?=$anexo->nome?></h6></td>
                                        <td class="text-sm text-center"><h6 class="mb-0 text-xs" id=""><?=TIPOS_ANEXO[$anexo->tipo]?></h6></td>
                                        <td class="text-sm text-center"><h6 class="mb-0 text-xs" id="ordem<?=$anexo->id?>"><?=$anexo->ordem?></h6></td>
                                        <td class="text-center">
                                            @if (!empty($anexo->anexo))
                                            <a id="download" href="{{asset($path.$anexo->anexo)}}" target="_blank" class="btn btn-primary p-2 mb-0" download="{{$anexo->anexo}}">
                                                <i class="fas fa-download fa-lg text-white fa-fw"></i>
                                            </a> 
                                            @else
                                             <span class="btn btn-secondary mb-0 disabled"><i class="fas fa-download fa-lg p-2 text-white fa-fw"></i></span>   
                                            @endif
                                            <a id="edit" class="btn btn-warning p-2 my-0 btn_prepare_save" data-bs-toggle="modal" data-bs-target="#modalSave" data-id="{{$anexo->id}}">
                                                <i class="fas fa-edit fa-lg text-white fa-fw"></i>
                                            </a>
                                            <a id="delete" class="btn btn-danger p-2 mb-0 btn_prepare_delete" data-bs-toggle="modal" data-bs-target="#deletarModal" data-id="{{$anexo->id}}">
                                                <i class="fas fa-trash-alt fa-lg text-white fa-fw"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@include('anexo.modals.modal_save', ['idUser' => $servidor->id ])
@include('anexo.modals.modal_deletar')
@endsection

@section('js')
@endsection
