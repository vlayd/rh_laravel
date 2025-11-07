<div class="row mt-3">
    <?php foreach(MES as $ind=>$mes):
        $corMesCorrente = ['secondary', 'badge-danger'];
        if(date('m') == $ind) $corMesCorrente = ['success', 'bg-danger'];?>
    <a class="btn bg-<?= $corMesCorrente[0] ?> mb-0 col-3 col-sm-2 mt-2 btnMes btnMes<?= $ind ?>" href="javascript:;" onclick="showAniversario('<?= $ind ?>')">
        <span class="text-dark text-xs d-none d-md-block d-lg-inline-block mx-0"><?= ucfirst($mes) ?></span>
        <span class="text-dark text-xs d-block d-sm-inline-block d-md-none"><?= ucfirst(substr($mes, 0, 3)) ?></span>
        <span class="badge badge-md badge-circle <?= $corMesCorrente[1] ?> badgeAniversario badgeAniversario<?= $ind ?> mx-0"><?= $itens[$ind]['count'] ?></span>
    </a>
    <?php endforeach?>
    <a class="btn bg-secondary mb-0 col-12 mt-2 btnMes btnMes0" href="javascript:;" onclick="showAniversario('0')">
        <span class="text-dark text-xs mx-0">Todos</span>
        <span class="badge badge-md badge-circle badge-danger badgeAniversario badgeAniversario0 mx-0"><?= count($aniversariantes) ?></span>
    </a>
</div>
