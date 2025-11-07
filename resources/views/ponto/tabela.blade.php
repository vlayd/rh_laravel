<div class="table-responsive">
    <table class="table align-items-center mb-0 border" id="data-list-usuarios">
        <thead class="thead-light">
            <tr>
                <th class="text-center">Nome</th>
                <th class="text-center">Entregue</th>
                <th class="text-center">Imprimir</th>
                <th class="text-center">Aprovado</th>
                <th class="text-center">Upload</th>
                <th class="text-center">Anexo</th>
            </tr>
        </thead>
        <tbody>
            <?php $i=1; foreach($lista as $item):
                $classCurrenteMes = 'd-none';
                if($item['mes'] == date('m')) $classCurrenteMes = '';
                $mes = '';
                if(isset($item['mes'])) $mes = $item['mes'];
                $nomeAnexo = '';
                if($item['anexo'] != 0) $nomeAnexo = BaseController::getAnexo($item['anexo'])['anexo'];
                ?>
                <tr class="mes mes<?=$item['mes'] . ' ' . $classCurrenteMes?>">
                    <td class="text-sm">
                        <div class="d-flex px-2">
                            <div>
                                <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/logos/small-logos/logo-spotify.svg" class="avatar avatar-sm rounded-circle me-2">
                            </div>
                            <div class="my-auto">
                                <h6 class="mb-0 text-xs"><?=$item['nome'].$i?></h6>
                            </div>
                        </div>
                    </td>
                    <td class="text-sm text-center">
                        <?php if($item['status'] == 1):?>
                            <a href="javascript:;" onclick="updateStatus(<?=$item['id']?>, 0, <?=$item['mes']?>)">
                                <i class="fas fa-thumbs-up fa-2x text-success text-center"></i>
                            </a>
                        <?php else:?>
                            <a href="javascript:;" onclick="updateStatus(<?=$item['id']?>, 1, <?=$item['mes']?>)">
                                <i class="fas fa-thumbs-down fa-2x text-danger text-center" id="status<?=$item['id']?>"></i>
                            </a>
                        <?php endif?>
                    </td>
                    <td class="text-sm text-center">
                        <a id="edit" class="btn btn-danger my-0" href="{{route('ponto.pdf', Crypt::encrypt($item['id']))}}" target="_blank">
                            <i class="fas fa-file-pdf fa-lg text-white fa-fw"></i>
                        </a>
                    </td>
                    <td class="text-sm text-center">
                        <?php if($item['status'] == 1):?>
                            <a href="javascript:;" onclick="updateStatusAnexo(<?=$item['id']?>, 0, <?=$item['mes']?>)">
                                <i id="icon" class="fas fa-check-circle text-success fa-2x fa-fw"></i>
                            </a>
                        <?php else:?>
                            <a href="javascript:;" onclick="updateStatusAnexo(<?=$item['id']?>, 1, <?=$item['mes']?>)">
                                <i id="icon" class="fas fa-check-circle text-secondary fa-2x fa-fw"></i>
                            </a>
                        <?php endif?>
                    </td>
                    <td class="text-sm text-center">
                        <?php if($item['status'] == 1):?>
                        <div class="btn btn-secondary my-0 disabled">
                            <i class="fas fa-file-upload fa-lg text-white fa-fw"></i>
                        </div>
                        <?php else:?>
                        <a class="btn btn-primary my-0 prepare-upload" data-id="{{Crypt::encrypt($item['id'])}}" data-bs-toggle="modal" data-bs-target="#modalSave">
                            <i class="fas fa-file-upload fa-lg text-white fa-fw"></i>
                        </a>
                        <?php endif?>
                    </td>
                    <td class="text-sm text-center">
                        <?php if($item['anexo'] == 0):?>
                            <div class="btn btn-secondary my-0 disabled">
                                <i class="fas fa-paperclip fa-lg text-white fa-fw"></i>
                            </div>
                        <?php else:?>
                            <a class="btn btn-warning my-0" target="_blank" href="<?=base_url(PATH_UPLOAD_FILE_ANEXO.$item['id_user'].BAR.$nomeAnexo)?>">
                                <i class="fas fa-paperclip fa-lg text-white fa-fw"></i>
                            </a>
                        <?php endif?>
                    </td>
                </tr>
            <?php $i++; endforeach?>
        </tbody>
    </table>
</div>
<?=CDN_JS_DATATABLES?>