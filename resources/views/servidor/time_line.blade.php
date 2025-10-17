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
                    <div class="d-lg-flex">
                        <h6>Linha do tempo de <strong class="text-danger"><?= $servidor->nome ?></strong></h6>
                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">
                                <a href="" class="btn bg-gradient-primary btn-sm mb-0">+&nbsp; Novo Histórico</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card body -->
                <div class="card-body px-3 pb-0">
                    <div class="timeline timeline-one-side" data-timeline-axis-style="dotted">
                        @foreach ($historicos as $historico)
                            @php
                                $iconHistorico = 'fa-check';
                                $colorHistorico = 'primary';
                                if (in_array('1', json_decode($historico->tipo))) {
                                    $iconHistorico = 'fa-flag';
                                    $colorHistorico = 'success';
                                }
                            @endphp
                            <div class="timeline-block mb-3">
                                <span class="timeline-step">
                                    <i class="fas fa-check text-primary text-gradient"></i>
                                </span>
                                <div class="timeline-content mw-100">
                                    <span class="badge badge-sm bg-gradient-secondary">ALTERAÇÃO</span>
                                    <span class="badge badge-sm bg-gradient-warning">Função Interina</span>
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
                                                class="accordion-collapse collapse"
                                                aria-labelledby="heading<?= $historico->idhistorico ?>"
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
                                                            <div class="text-dark py-1"><strong class="text-dark">Chefia:</strong> &nbsp; <?=$historico->chefia == '1' ?'Sim':'Não'?></div>
                                                            <div class="text-dark py-1"><strong class="text-dark">Setor:</strong> &nbsp; <?=$historico->setor?></div>
                                                            <div class="text-dark pt-1"><strong class="text-dark">Anexos:</strong></div>
                                                            <?php foreach(json_decode($historico->anexos) as $anexo):?>
                                                            <div class="text-danger ms-3 mt-1"><i class="fas fa-file-upload fa-lg"></i> <strong><a class="text-primary" href="" target="_blank"></a></strong></div>
                                                            <?php endforeach?>
                                                        </div>
                                                    </div>
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
                                                            <div class="text-dark py-1"><strong class="text-dark">Função:</strong> &nbsp; Teste de função</div>
                                                            <div class="text-dark py-1"><strong class="text-dark">Setor:</strong> &nbsp; O setor</div>
                                                            <div class="text-dark py-1"><strong class="text-dark">Chefia:</strong> &nbsp; Sim</div>
                                                            <div class="text-dark py-1"><strong class="text-dark">Período:</strong> &nbsp; 10/01/2025 à 01/01/2026</div>
                                                            <div class="text-dark py-1"><strong class="text-dark">Observação:</strong> &nbsp; Observaçoes</div>
                                                            <div class="text-dark pt-1"><strong class="text-dark">Anexos:</strong></div>
                                                            <div class="text-danger ms-3 mt-1"><i class="fas fa-file-upload fa-lg"></i> <strong><a class="text-primary" href="" target="_blank">Anexo</a></strong></div>
                                                        </div>
                                                    </div>
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
@endsection

@section('js')
@endsection
