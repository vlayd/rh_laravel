<?php

use App\Http\Controllers\Controller;

$foto = empty($atual->foto) ? PATH_SEM_FOTO : PATH_UPLOAD_USUARIO . $atual->idUsuario . '/perfil/' . $atual->foto;
?>
@extends('layouts.main_layout')

@section('breadcrumb')
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-sm-5 my-lg-0">
                <div class="card-header text-center">
                    <div class="row">
                        <div class="col-12 text-center">
                            <img class="mb-2 w-100 p-2" src="{{ asset(PATH_APOIO_LOGOS) }}" alt="Logo">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-12 text-center">
                            <img class="mb-2 w-70 w-sm-50 w-md-35 w-lg-25 w-xxl-20 p-2" src="{{ asset($foto) }}" alt="Logo">
                        </div>
                    </div>
                    <div class="row mx-n4 mx-sm-n2 mx-md-3">
                        <div class="col-12 text-center bg-default py-2 border-radius-lg">
                            <div class="fs-5 text-white fw-bold">{{ $atual->nomeUsuario }}</div>
                        </div>
                    </div>
                    <div class="row mt-4 mx-sm-1 mx-md-4">
                        <div class="col-12">
                            <div class="card border-1 mx-n4">
                                <div class="card-header text-center fw-bold py-2 fs-6 bg-gray-300 border-top">
                                    Dados Pessoais
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-md-6 text-sm mb-3">
                                            <strong class="text-dark">Nascimento:</strong> &nbsp;
                                            {{ $atual->nascimento }}
                                        </div>
                                        <div class="col-12 col-md-6 text-sm mb-3">
                                            <strong class="text-dark">Idade:</strong> &nbsp; {{ $atual->idade }}
                                        </div>
                                        <div class="col-12 col-md-6 col-md-6 text-sm mb-3">
                                            <strong class="text-dark">CPF:</strong>&nbsp; {{ $atual->cpf }}
                                        </div>
                                        <div class="col-12 col-md-6 col-md-6 text-sm mb-3">
                                            <strong class="text-dark">RG:</strong> &nbsp; {{ $atual->rg }}"
                                        </div>
                                        <div class="col-12 col-md-6 text-sm mb-3">
                                            <strong class="text-dark">Telefone:</strong> &nbsp; {{ $atual->telefone }}
                                        </div>
                                        <div class="col-12 col-md-6 text-sm mb-3">
                                            <strong class="text-dark">Whatsapp:</strong> &nbsp; {{ $atual->telefone2 }}
                                        </div>
                                        <div class="col-12 col-md-6 text-sm mb-3">
                                            <strong class="text-dark">E-mail Pessoal:</strong> &nbsp; {{ $atual->email }}
                                        </div>
                                        <div class="col-12 col-md-6 text-sm mb-3">
                                            <strong class="text-dark">E-mail Gov:</strong> &nbsp; {{ $atual->email2 }}
                                        </div>
                                        <div class="col-12 text-sm mb-3">
                                            <strong class="text-dark">Endereço:</strong> &nbsp; {{ $atual->endereco }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4 mx-sm-1 mx-md-4">
                        <div class="col-12">
                            <div class="card border-1 mx-n4">
                                <div class="card-header text-center fw-bold py-2 fs-6 bg-gray-300 border-top">
                                    Dados Profissionais
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 mb-1">
                                            <h5 class="border-bottom">ENSINO REGULAR</h5>
                                        </div>
                                        <div class="col-12 text-sm mb-3">
                                            <strong class="text-dark">Escolaridade:</strong> &nbsp;
                                            {{ $atual->escolaridade }}
                                        </div>
                                        @if (count($anexos['faculdade']) > 0)
                                            <div class="col-12 fw-bold ps-2 border-bottom my-2">Faculdade</div>
                                            @foreach ($anexos['faculdade'] as $faculdade)
                                                <div class="col-10 text-sm mb-2"><i class="fas fa-chevron-right ms-2"></i>
                                                    {{ $faculdade->nome }}</div>
                                                @if ($faculdade->anexo != '')
                                                    <a href="{{ asset(PATH_UPLOAD_FILE_ANEXO . $faculdade->id_usuario . '/' . $faculdade->anexo) }}"
                                                        class="col-2 text-end mb-2" target="_blank">
                                                        <i class="fas fa-file-download fa-lg text-danger"></i>
                                                    </a>
                                                @else
                                                    <div class="col-2 text-end mb-2">
                                                        <i class="fas fa-file-download fa-lg"></i>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif

                                        @if (count($anexos['pos']) > 0)
                                            <div class="col-12 fw-bold ps-2 border-bottom my-2">Especialização</div>
                                            @foreach ($anexos['pos'] as $pos)
                                                <div class="col-10 text-sm mb-2"><i class="fas fa-chevron-right ms-2"></i>
                                                    {{ $pos->nome }}</div>
                                                @if ($pos->anexo != '')
                                                    <a href="{{ asset(PATH_UPLOAD_FILE_ANEXO . $pos->id_usuario . '/' . $pos->anexo) }}"
                                                        class="col-2 text-end mb-2" target="_blank">
                                                        <i class="fas fa-file-download fa-lg text-danger"></i>
                                                    </a>
                                                @else
                                                    <div class="col-2 text-end mb-2">
                                                        <i class="fas fa-file-download fa-lg"></i>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif

                                        @if (count($anexos['mestrado']) > 0)
                                            <div class="col-12 fw-bold ps-2 border-bottom my-2">Mestrado</div>
                                            @foreach ($anexos['mestrado'] as $mestrado)
                                                <div class="col-10 text-sm mb-2"><i class="fas fa-chevron-right ms-2"></i>
                                                    {{ $mestrado->nome }}</div>
                                                @if ($mestrado->anexo != '')
                                                    <a href="{{ asset(PATH_UPLOAD_FILE_ANEXO . $mestrado->id_usuario . '/' . $mestrado->anexo) }}"
                                                        class="col-2 text-end mb-2" target="_blank">
                                                        <i class="fas fa-file-download fa-lg text-danger"></i>
                                                    </a>
                                                @else
                                                    <div class="col-2 text-end mb-2">
                                                        <i class="fas fa-file-download fa-lg"></i>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif

                                        @if (count($anexos['doutorado']) > 0)
                                            <div class="col-12 fw-bold ps-2 border-bottom my-2">Doutorado</div>
                                            @foreach ($anexos['doutorado'] as $doutorado)
                                                <div class="col-10 text-sm mb-2"><i class="fas fa-chevron-right ms-2"></i>
                                                    {{ $doutorado->nome }}</div>
                                                @if ($doutorado->anexo != '')
                                                    <a href="{{ asset(PATH_UPLOAD_FILE_ANEXO . $doutorado->id_usuario . '/' . $doutorado->anexo) }}"
                                                        class="col-2 text-end mb-2" target="_blank">
                                                        <i class="fas fa-file-download fa-lg text-danger"></i>
                                                    </a>
                                                @else
                                                    <div class="col-2 text-end mb-2">
                                                        <i class="fas fa-file-download fa-lg"></i>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4 mx-sm-1 mx-md-4">
                        <div class="col-12">
                            <div class="card border-1 mx-n4">
                                <div class="card-header text-center fw-bold py-2 fs-6 bg-gray-300 border-top">
                                    Informações do Contrato
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-md-6 text-sm mb-3">
                                            <strong class="text-dark">Tipo:</strong> &nbsp; {{ $atual->nomeContrato }}
                                        </div>
                                        <div class="col-12 col-md-6 text-sm mb-3">
                                            <strong class="text-dark">Gratificação:</strong> &nbsp;
                                            {{ $atual->nomeGratificacao }}
                                        </div>
                                        <div class="col-12 col-md-6 text-sm mb-3">
                                            <strong class="text-dark">Matrícula:</strong> &nbsp; {{ $atual->matricula }}
                                        </div>
                                        <div class="col-12 col-md-6 text-sm mb-3">
                                            <strong class="text-dark">Cargo:</strong> &nbsp; {{ $atual->nomeCargo }}
                                        </div>
                                        <div class="col-12 text-sm mb-3">
                                            <strong class="text-dark">Secretaria de Origem:</strong> &nbsp;
                                            {{ $atual->secretaria_origem }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4 mx-sm-1 mx-md-4">
                        <div class="col-12">
                            <div class="card border-1 mx-n4">
                                <div class="card-header text-center fw-bold py-2 fs-6 bg-gray-300 border-top">
                                    Em Exercício Atualmente
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-md-6 text-sm mb-3">
                                            <strong class="text-dark">Função:</strong> &nbsp; {{ $atual->funcao }}
                                        </div>
                                        <div class="col-12 col-md-6 text-sm mb-3">
                                            <strong class="text-dark">Chefia:</strong> &nbsp;
                                            {{ $atual->chefia == 0 ? 'Não' : 'Sim' }}
                                        </div>
                                        <div class="col-12 col-lg-6 text-sm mb-3">
                                            <strong class="text-dark">Setor:</strong> &nbsp; {{ $atual->nomeSetor }}
                                        </div>
                                        <div class="col-12 col-lg-6 text-sm mb-3">
                                            <strong class="text-dark">Anexos:</strong>
                                            @if ($atual->anexos != null)
                                                @foreach ($atual->anexos as $anexoAtual)
                                                    <div class="text-danger ms-3 mb-2">
                                                        <i class="fas fa-file-upload fa-lg"></i>
                                                        <strong><a class="text-primary" href="{{ asset(PATH_UPLOAD_FILE_ANEXO . $atual->idUsuario . '/' . $anexoAtual->anexo) }}" target="_blank">{{ $anexoAtual->nome }}</a></strong>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4 mx-sm-1 mx-md-4">
                        <div class="col-12">
                            <div class="card border-1 mx-n4">
                                <div class="card-header text-center fw-bold py-2 fs-6 bg-gray-300 border-top">
                                    Linha do tempo
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="card bg-gray-100">
                                            <div class="card-body p-3">
                                                <div class="timeline timeline-one-side mx-n4"
                                                    data-timeline-axis-style="dotted">
                                                    @foreach ($historicos as $historico)
                                                        @php
                                                            $iconHistorico = 'fa-check text-primary';
                                                        @endphp
                                                        
                                                        @if (in_array('1', json_decode($historico->alteracao)))
                                                            @php
                                                                $iconHistorico = 'fa-flag text-success';
                                                            @endphp
                                                        @endif
                                                        @php
                                                            $dataRescisao = $historico->data_rescisao ?? date('Y-m-d');
                                                        @endphp
                                                        <div class="timeline-block">
                                                            <span class="timeline-step bg-gray-100">
                                                                <i class="fas {{ $iconHistorico }} text-gradient"></i>
                                                            </span>
                                                            <div class="timeline-content">
                                                                <h6 class="text-dark text-sm font-weight-bold mb-0">
                                                                    {{ $historico->nomeSetor }}</h6>
                                                                <p
                                                                    class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                                    {{ date('d/m/Y', strtotime($historico->data_contratacao)) }}
                                                                    a {{ date('d/m/Y', strtotime($dataRescisao)) }}</p>
                                                                <h6 class="mt-2 mb-0">Informações:</h6>
                                                                <div
                                                                    class="text-sm text-dark py-2 ps-3 bg-gray-200 border-radius-lg mb-3">
                                                                    <div class="my-2"><strong>Contrato:</strong> &nbsp;
                                                                        {{ $historico->nomeContrato }}</div>
                                                                    <div class="my-2"><strong>Cargo:</strong> &nbsp;
                                                                        {{ $historico->nomeCargo }}</div>
                                                                    <div class="my-2"><strong>Matrícula:</strong> &nbsp;
                                                                        {{ $historico->matricula }}</div>
                                                                    <div class="my-2"><strong>Função:</strong> &nbsp;
                                                                        {{ $historico->funcao }}</div>
                                                                    <div class="my-2"><strong>Gratificação:</strong>
                                                                        &nbsp; {{ $historico->nomeGratificacao }}</div>
                                                                    <div class="my-2"><strong>Chefia:</strong> &nbsp;
                                                                        {{ $atual->chefia == 0 ? 'Não' : 'Sim' }}</div>
                                                                    <div class="my-2"><strong>Anexos:</strong></div>
                                                                    @foreach (json_decode($historico->anexos) as $anexo)
                                                                        <div class="text-danger ms-3 mb-1">
                                                                            <i class="fas fa-file-download fa-lg"></i>
                                                                            <strong>
                                                                                <a href="{{ asset(PATH_UPLOAD_FILE_ANEXO . $historico->userHistorico . '/' . Controller::getAnexo($anexo)->anexo) }}"
                                                                                    class="text-primary" target="_blank">
                                                                                    {{ Controller::getAnexo($anexo)->nome }}
                                                                                </a>
                                                                            </strong>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                                @if ($interinas)
                                                                    @foreach ($interinas as $interina)
                                                                        <h6 class="mt-2 ms-3 mb-0">Função Interina:</h6>
                                                                        <div class="text-sm ms-3 text-dark py-2 ps-3 border-radius-lg mb-3" style="background-color: #f6d4d4;">
                                                                            <div class="my-2"><strong>Período:</strong>
                                                                                &nbsp;
                                                                                {{ date('d/m/Y', strtotime($interina->data_contratacao)) }}
                                                                                a
                                                                                {{ date('d/m/Y', strtotime($interina->data_rescisao)) }}
                                                                            </div>
                                                                            <div class="my-2"><strong>Função:</strong>
                                                                                &nbsp; {{ $interina->funcao }}</div>
                                                                            <div class="my-2"><strong>Setor:</strong>
                                                                                &nbsp; {{ $interina->nomeSetor }}
                                                                            </div>
                                                                            <div class="my-2"><strong>Chefia:</strong>
                                                                                &nbsp;
                                                                                {{ $interina->chefia == 0 ? 'Não' : 'Sim' }}
                                                                            </div>
                                                                            <div class="my-2">
                                                                                <strong>Observação:</strong> &nbsp;
                                                                                {{ $interina->observacao }}</div>
                                                                            <div class="my-2"><strong>Anexos:</strong>
                                                                            </div>

                                                                            @foreach (json_decode($interina->anexos) as $anexo)
                                                                                <div class="text-danger ms-3 mb-1">
                                                                                    <i
                                                                                        class="fas fa-file-download fa-lg"></i>
                                                                                    <strong><a
                                                                                            href="{{ asset(PATH_UPLOAD_FILE_ANEXO . $idUser . '/' . Controller::getAnexo($anexo)->anexo) }}"
                                                                                            class="text-primary"
                                                                                            target="_blank">{{ Controller::getAnexo($anexo)->nome }}</a></strong>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    @endforeach
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        var item = 'Servidor';
        var subItem = 'Informacoes';
    </script>
@endsection
