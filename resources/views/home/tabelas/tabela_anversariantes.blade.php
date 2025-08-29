<div class="table-responsive <?=$class??''?>" id="<?=$id?>">
    <table class="table align-items-center mb-0 border table-striped">
    <thead>
        <tr>
            <th class="text-uppercase text-black h6 font-weight-bolder text-center" colspan="3">ANIVERSARIANTES DO MÊS DE <?=$mes?></th>
        </tr>
    </thead>
    <tbody id="tbodyMesAtual">
        <?php foreach($lista as $item):?>
        <tr>
            <td>
                <div class="d-flex px-2">
                    <div>
                        <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/logos/small-logos/logo-spotify.svg" class="avatar avatar-sm rounded-circle me-2">
                    </div>
                    <div class="my-auto">
                        <h6 class="mb-0 text-xs"><?=$item->nome?></h6>
                    </div>
                </div>
            </td>
            <td>
                <p class="text-xs font-weight-bold mb-0 text-center"><?=date_format(date_create($item->aniversario),"d/m")?></p>
            </td>
            <td>
            {{Operations::diffYearsNow($item->aniversario)}}
            </td>
        </tr>
        <?php endforeach?>
    </tbody>
    </table>
</div>
