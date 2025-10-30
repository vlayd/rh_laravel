<div class="modal fade modal-lg" id="modalHistorico" tabindex="-1" role="dialog" aria-labelledby="modalHistoricoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form method="post" action="{{route('historico.save')}}">
        @csrf
        <div class="modal-header justify-content-between">
          <h5 class="modal-title" id="modalHistoricoLabel">Adicionar Histórico</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          @include('layouts.inputs.input_checkbox', ['campo' => 'atual', 'classe' => '', 'label' => 'Situação atual', 'valor' => '1'])
        </div>
        <div class="modal-body" id="modal-body">
          <div class="row justify-content-center">
            <div class="col-6">
              @include('layouts.inputs.input_checkbox', ['campo' => 'alteracao', 'idCheck' => 'chkContrato', 'classe' => 'mb-0', 'colchete' => '[]', 'label' => 'Contrato', 'valor' => '2'])
              @include('layouts.inputs.input_select_bd', ['items' => $contratos, 'campo' => 'contrato'])
            </div>
            <div class="col-6">
              @include('layouts.inputs.input_checkbox', ['campo' => 'alteracao', 'idCheck' => 'chkCargo', 'classe' => 'mb-0', 'colchete' => '[]', 'label' => 'Cargo', 'valor' => '3'])
              @include('layouts.inputs.input_select_bd', ['items' => $cargos, 'campo' => 'cargo'])
            </div>
            <div class="col-6">
              @include('layouts.inputs.input_checkbox', ['campo' => 'alteracao', 'idCheck' => 'chkMatricula', 'classe' => 'mb-0', 'colchete' => '[]', 'label' => 'Matricula', 'valor' => '4'])
              @include('layouts.inputs.input_text', ['campo' => 'matricula'])
            </div>
            <div class="col-6">
              @include('layouts.inputs.input_checkbox', ['campo' => 'alteracao', 'idCheck' => 'chkFuncao', 'classe' => 'mb-0', 'colchete' => '[]', 'label' => 'Função', 'valor' => '5'])
              @include('layouts.inputs.input_text', ['campo' => 'funcao'])
            </div>
            <div class="col-6">
              @include('layouts.inputs.input_checkbox', ['campo' => 'alteracao', 'idCheck' => 'chkGratificacao', 'classe' => 'mb-0', 'colchete' => '[]', 'label' => 'FG/CEC', 'valor' => '6'])
              @include('layouts.inputs.input_select_bd', ['items' => $gratificacoes, 'campo' => 'gratificacao'])
            </div>
            <div class="col-6">
              @include('layouts.inputs.input_checkbox', ['campo' => 'alteracao', 'idCheck' => 'chkSetor', 'classe' => 'mb-0', 'colchete' => '[]', 'label' => 'Setor', 'valor' => '7'])
              @include('layouts.inputs.input_select_setores')
            </div>
            <div class="col-3">
              @include('layouts.inputs.input_checkbox', ['campo' => 'alteracao', 'idCheck' => 'chkChefia', 'classe' => 'mb-0', 'colchete' => '[]', 'label' => 'Chefia', 'valor' => '8'])
              @include('layouts.inputs.input_select', ['items' => $chefias, 'campo' => 'chefia', 'firstDefault' => false])
            </div>
            @include('layouts.inputs.input_select_choices_tag_bd', ['classe' => 'col-9', 'numIdChoice' => 'h', 'items' => $anexos])
            @include('layouts.inputs.input_text', ['campo' => 'data_contratacao', 'classe' => 'col-6', 'label' => 'Iniciou em', 'type' => 'date'])
            @include('layouts.inputs.input_text', ['campo' => 'data_rescisao', 'classe' => 'col-6', 'label' => 'Finalizou em', 'type' => 'date'])
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn bg-gradient-primary">Salvar</button>
          <input type="hidden" name="id_historico" value="">
          <input type="hidden" name="id_usuario" value="{{$servidor->id}}">
        </div>
      </form>
    </div>
  </div>
</div>