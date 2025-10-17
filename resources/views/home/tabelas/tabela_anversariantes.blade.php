<?php use App\Services\Operations; ?>
<div class="table-responsive mes mes<?=$mes.' '.$classe??''?>">
    <table class="table align-items-center mb-0 border table-striped">
        <thead>
            <tr>
                <th class="text-uppercase text-black h6 font-weight-bolder text-center" colspan="3">ANIVERSARIANTES DO MÊS DE <?=$mes?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($lista as $aniversariante):?>
            <tr class="aniversarios">
                <td>
                    <div class="d-flex px-2 py-1">
                        <div>
                            <img src="<?=asset(PATH_UPLOAD_USUARIO.$aniversariante->id.'/perfil/'.$aniversariante->foto)?>" class="avatar rounded-circle me-2">
                        </div>
                        <div class="my-auto">
                            <h6 class="mb-0 text-xs"><?=$aniversariante->nome?></h6>
                        </div>
                    </div>
                </td>
                <td>
                    <p class="text-xs font-weight-bold mb-0 text-center"><?=date_format(date_create($aniversariante->aniversario),"d/m")?></p>
                </td>
                <td>
                    <?=Operations::diffDaysNow($aniversariante->aniversario)?>
                </td>
            </tr>
            <?php endforeach?>
        </tbody>
    </table>
</div>
