<div class="table-responsive" class="">
    <table class="table table-flush table-striped table-hover" id="data-list-usuarios">
        <thead class="thead-light">
            <tr>
                <th class="text-center">Nome</th>
                <?php foreach ($colunas as $coluna) :
                    $visible = "d-none";
                    if (in_array($coluna['id'], $colunasSelect)) $visible = 'colunas'; ?>
                    <th class="text-center <?= $visible ?>"><?= $coluna['nome'] ?></th>
                <?php endforeach ?>
                <th class="text-center d-none config">STATUS</th>
                <th class="text-center d-none config">AÇÃO</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lista as $item) :
                $status = 1;
                $visibilleStatus = '';
                $foto = empty($item['foto']) ? PATH_SEM_FOTO : PATH_UPLOAD_USUARIO.$item['idUser'].'/perfil/'.$item['foto'];
                if($item['rh'] == 0){
                    $visibilleStatus = 'd-none';
                    $status = 0;
                }
                ?>
                <tr class="<?= $visibilleStatus ?> status<?= $status ?>">
                    <td class="text-sm">
                        <a href="#" id="item<?= $item['idUser'] ?>" onclick="prepareCopy(this.id)" data-bs-toggle="modal" data-bs-target="#copiaModal">
                            <div class="d-flex px-2">
                                <div>
                                    <img src="{{asset($foto)}}" class="avatar avatar-sm rounded-circle me-2">
                                </div>
                                <div class="my-auto">
                                    <h6 class="mb-0 text-xs"><?= $item['nomeUser'] ?></h6>
                                </div>
                            </div>
                        </a>
                    </td>
                    <?php foreach ($colunas as $coluna) :
                        $visible = 'd-none';
                        //Se o id do bd colunas está dentro do array colunas do bd colunas_visiveis
                        if (in_array($coluna['id'], $colunasSelect)) $visible = 'colunas';
                    ?>
                        <td class="mb-0 text-xs text-center <?= $visible ?>">
                            <h6 class="mb-0 text-xs" id="item<?= $item['idUser'] . $coluna['item'] ?>"><?= $item[$coluna['item']] ?></h6>
                        </td>
                    <?php endforeach; ?>
                    <td class="text-center d-none config">
                        <span id="div_user<?= $item['idUser'] ?>">
                            <?php if ($item['rh'] != 0) : ?>
                                <a onclick="alteraStatus('<?= $item['idUser'] ?>', '0', '<?= $item['nomeUser'] ?>')" href="#" data-bs-toggle="modal" data-bs-target="#modalAlteraAcao">
                                    <i class="fas fa-user-check fa-lg text-success"></i>
                                </a>
                            <?php else : ?>
                                <a onclick="alteraStatus('<?= $item['idUser'] ?>', '1', '<?= $item['nomeUser'] ?>')" href="#" data-bs-toggle="modal" data-bs-target="#modalAlteraAcao">
                                    <i class="fas fa-user-times fa-lg text-danger"></i>
                                </a>
                            <?php endif ?>
                    </td>
                    <td class="text-center d-none config">
                        <a href="{{route('servidor.detail', ['id' => Crypt::encrypt($item['idUser']), 'pdf' => 0])}}" target="_blank" class="btn btn-primary p-2 mb-0">
                            <i class="fas fa-eye text-white fa-fw"></i>
                        </a>
                        <a class="btn btn-warning p-2 mb-0" href="{{route('servidor.edit', Crypt::encrypt($item['idUser']))}}">
                            <i class="fas fa-user-edit text-white fa-fw"></i>
                        </a>
                        <span id="div_senha<?= $item['idUser'] ?>">
                            <?php if ($item['senha'] == md5($item['cpf'])) : ?>
                                <span class="btn btn-secondary p-2 mb-0 disabled">
                                    <i class="fas fa-key text-white fa-fw" title="Senha original"></i>
                                </span>
                            <?php else : ?>
                                <a onclick="resetaSenha('<?= $item['idUser'] ?>', '0', '<?= $item['nomeUser'] ?>')" class="btn btn-success p-2 mb-0" data-bs-toggle="modal" data-bs-target="#modalAlteraAcao">
                                    <i class="fas fa-key text-white fa-fw" title="Senha personalizada"></i>
                                </a>
                            <?php endif ?>
                        </span>
                        <a href="{{route('servidor.detail', ['id' => Crypt::encrypt($item['idUser']), 'pdf' => 1])}}" target="_blank" class="btn btn-danger p-2 mb-0">
                            <i class="fas fa-file-pdf text-white fa-fw"></i>
                        </a>
                        <a class="btn btn-dark p-2 mb-0" href="{{route('historico.detail', Crypt::encrypt($item['idUser']))}}">
                            <i class="fas fa-history text-white fa-fw"></i>
                        </a>
                        <a href="{{route('anexo', Crypt::encrypt($item['idUser']))}}" class="btn btn-info p-2 mb-0 position-relative">
                            <i class="fas fa-paperclip text-white fa-fw"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
@include('servidor.modals.modal_colunas_visiveis')

<?=CDN_JS_DATATABLES?>