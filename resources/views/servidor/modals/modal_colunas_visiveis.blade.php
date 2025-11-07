<div class="modal fade" id="opcoesModal" tabindex="-1" role="dialog" aria-labelledby="opcoesModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form action="<?=route('coluna.save')?>" method="post">
      @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="opcoesModalLabel">Colunas visíveis</h5>
          <button type="button" class="btn-close text-secondary fs-3 fw-bold" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <?php $i=2; foreach($colunas as $coluna):
            $corTaja = '';
            if($i%2==0) $corTaja = 'bg-gray-200';
            $checked = '';
            //Se o id do bd colunas está dentro do array colunas do bd colunas_visiveis
            if(in_array($coluna['id'], $colunasSelect)) $checked = 'checked'; ?>
                <div class="form-group d-flex align-items-center justify-content-between <?=$corTaja?> p-2 m-0">
                    <span class="text-sm"><?=$coluna['nome']?></span>
                    <div class="form-check form-switch ms-3">
                        <input class="form-check-input" type="checkbox" name="check<?=$coluna['id']?>" value="<?=$coluna['id']?>" <?=$checked?> >
                    </div>
                </div>
            <?php $i++; endforeach?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn bg-gradient-primary">Salvar colunas</button>
        </div>
      </form>
    </div>
  </div>
</div>
