@php
    $page = ['servidor'];
    $js = 'servidor';
@endphp
@extends('layouts.main_layout')

@section('breadcrumb')
@endsection

@section('content')
    <div class="d-none" id="jsonAnexo0"><?=$anexosAtual?></div>
    <div class="d-none" id="dados0"><?=json_encode($atual) ?></div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- Card header -->
                <div class="card-header pb-0">
                    <div class="d-lg-flex">
                        <h6>Linha do tempo de <strong class="text-danger"><?= $servidor->nome ?></strong></h6>
                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">
                                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#modalHistorico" class="btn bg-gradient-primary btn-sm mb-0" onclick="editHistorico(0)">+&nbsp; Novo Histórico</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card body -->
                <div class="card-body px-3 pb-0">
                    <div class="timeline timeline-one-side" data-timeline-axis-style="dotted">                        
                        @foreach ($historicos as $historico)
                            @php
                                $jsonRetorno = [];
                                $iconHistorico = 'fa-check';
                                $colorHistorico = 'primary';
                                if (in_array('1', json_decode($historico->alteracao))) {
                                    $iconHistorico = 'fa-flag';
                                    $colorHistorico = 'success';
                                }
                            @endphp
                            <div class="timeline-block mb-3">
                                <div class="d-none" id="dados<?= $historico->idhistorico ?>"><?=json_encode($historico) ?></div>
                                <span class="timeline-step">
                                    <i class="fas <?=$iconHistorico?> text-<?=$colorHistorico?> text-gradient"></i>
                                </span>
                                <div class="timeline-content mw-100">
                                    @php $i = 0; @endphp
                                    @foreach (json_decode($historico->alteracao) as $alteracao)
                                    {{-- Verifica se tipo não é 1(início) pra não aparecer o badge alteração e $i=0 só repete uma vez --}}
                                    @if ($i == 0 && $alteracao != 1)
                                    <span class="badge badge-sm bg-gradient-secondary">ALTERAÇÃO</span>                                        
                                    @endif
                                    <span class="badge badge-sm bg-gradient-<?=$colorHistorico?>"><?=ALTERACAO_HISTORICO[$alteracao]?></span>
                                    @php $i++; @endphp
                                    @endforeach
                                    @if ($interinos && str_contains(json_encode($interinos), '"id_historico":'.$historico->idhistorico))
                                    <span class="badge badge-sm bg-gradient-warning">Função Interina</span>                                        
                                    @endif
                                    <div class="accordion" id="accordionRental<?= $historico->idhistorico ?>">
                                        <div class="accordion-item">
                                            <div class="accordion-header" id="heading<?= $historico->idhistorico ?>">
                                                <a class="font-weight-bold collapsed" type="button" data-bs-toggle="collapse" href="#collapse<?= $historico->idhistorico ?>" aria-expanded="false" aria-controls="collapse<?= $historico->idhistorico ?>">
                                                    <h6 class="text-secondary font-weight-bold text-sm mb-0">
                                                        <?= $historico->data_contratacao . ' - ' . $historico->data_rescisao ?>
                                                    </h6>
                                                </a>
                                            </div>
                                            <div id="collapse<?= $historico->idhistorico ?>"
                                                class="accordion-collapse collapse" aria-labelledby="heading<?= $historico->idhistorico ?>"
                                                data-bs-parent="#accordionRental<?= $historico->idhistorico ?>">
                                                <div class="accordion-body">
                                                    <div class="row">
                                                        <div class="col-md-8 d-flex align-items-center">
                                                            <h6 class="mb-2">Informações</h6>
                                                        </div>
                                                        <div class="col text-end">
                                                            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#modalHistorico" onclick="editHistorico(<?= $historico->idhistorico ?>)">
                                                                <i class="fas fa-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar Histórico"></i>
                                                            </a>
                                                            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#modalExcluirHistorico">
                                                                <i class="fas fa-trash-alt text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir Histórico"></i>
                                                            </a>
                                                            <a href="javascript:;" data-bs-toggle="modal"
                                                                data-bs-target="#modalInterino" onclick="editInterino(0, <?= $historico->userHistorico ?>, <?= $historico->idhistorico ?>)">
                                                                <i class="fas fa-plus text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Adicionar Função Interina"></i>
                                                            </a>
                                                        </div>
                                                        <div class="bg-gray-200 p-3 text-sm border-radius-lg">
                                                            <div class="text-dark py-1"><strong>Contrato:</strong> &nbsp; <?=$historico->nomeContrato?></div>
                                                            <div class="text-dark py-1"><strong>Cargo:</strong> &nbsp; <?=$historico->nomeCargo?></div>
                                                            <div class="text-dark py-1"><strong>Matrícula:</strong> &nbsp; <?=$historico->matricula?></div>
                                                            <div class="text-dark py-1"><strong class="text-dark">Função:</strong> &nbsp; <?=$historico->funcao?></div>
                                                            <div class="text-dark py-1"><strong class="text-dark">Gratificação:</strong> &nbsp; <?=$historico->gratificacao == '0' ?'Não':$historico->nomeGratificacao?></div>
                                                            <div class="text-dark py-1"><strong class="text-dark">Chefia:</strong> &nbsp; <?=$historico->chefia == '2' ?'Sim':'Não'?></div>
                                                            <div class="text-dark py-1"><strong class="text-dark">Setor:</strong> &nbsp; <?=$historico->nomeSetor?></div>
                                                            <div class="text-dark pt-1"><strong class="text-dark">Anexos:</strong></div>
                                                            @foreach ($anexos as $anexo)
                                                                @php
                                                                    if(!in_array($anexo->id, json_decode($historico->anexos))){
                                                                        $jsonRetorno[] = ['value' => $anexo->id, 'label'=> $anexo->nome];
                                                                        continue;
                                                                    } else {
                                                                        $jsonRetorno[] = ['value' => $anexo->id, 'label'=> $anexo->nome, 'selected' => true];
                                                                    }
                                                                @endphp
                                                                <div class="text-danger ms-3 mt-1"><i class="fas fa-file-upload fa-lg"></i> <strong><a class="text-primary" href="" target="_blank">{{$anexo->nome}}</a></strong></div>
                                                            @endforeach
                                                            <div class="d-none" id="jsonAnexo<?= $historico->idhistorico ?>"><?=json_encode($jsonRetorno)?></div>
                                                        </div>
                                                    </div>
                                                    
                                                    @if ($interinos && str_contains(json_encode($interinos), '"id_historico":'.$historico->idhistorico))
                                                    @foreach ($interinos as $interino)
                                                    @if ($historico->idhistorico != $interino->id_historico) @php continue; @endphp @endif
                                                    <div class="row mt-3 ms-3">
                                                        <div class="col-md-8 d-flex align-items-center">
                                                            <h6 class="mb-2">Função Interina</h6>
                                                        </div>
                                                        <div class="col text-end">
                                                            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#modalInterino">
                                                                <i class="fas fa-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar Histórico"></i>
                                                            </a>
                                                            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#modalExcluirHistorico">
                                                                <i class="fas fa-trash-alt text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir Histórico"></i>
                                                            </a>
                                                        </div>
                                                        <div class="p-3 text-sm border-radius-lg" style="background-color: #f6d4d4;">
                                                            <div class="text-dark py-1"><strong class="text-dark">Função:</strong> &nbsp; {{$interino->funcao}}</div>
                                                            <div class="text-dark py-1"><strong class="text-dark">Setor:</strong> &nbsp; {{$interino->nomeSetor}}</div>
                                                            <div class="text-dark py-1"><strong class="text-dark">Chefia:</strong> &nbsp; <?=$interino->chefia == '2' ?'Sim':'Não'?></div>
                                                            <div class="text-dark py-1"><strong class="text-dark">Período:</strong> &nbsp; 10/01/2025 à 01/01/2026</div>
                                                            <div class="text-dark py-1"><strong class="text-dark">Observação:</strong> &nbsp; Observaçoes</div>
                                                            <div class="text-dark pt-1"><strong class="text-dark">Anexos:</strong></div>
                                                            <div class="text-danger ms-3 mt-1"><i class="fas fa-file-upload fa-lg"></i> <strong><a class="text-primary" href="" target="_blank">Anexo</a></strong></div>
                                                        </div>
                                                    </div>                                                        
                                                    @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('historico.modals.modal_historico')
@endsection

@section('js')
<?=JS_PLUGIN_CHOICES?>
@endsection
