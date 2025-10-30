<div class="modal fade modal-lg" id="modalInterino" tabindex="-1" role="dialog" aria-labelledby="modalInterinoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form method="post" action="{{route('historico.saveinterino')}}">
        @csrf
        <div class="modal-header justify-content-between">
          <h5 class="modal-title" id="modalInterinoLabel">Adicionar Funcao Interina</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="modal-body">
          <div class="row justify-content-center">
            @include('layouts.inputs.input_text', ['label' => 'Função', 'campo' => 'funcao_interina', 'classe' => 'col-6'])
            @include('layouts.inputs.input_select_setores', ['campo' => 'setor_interino', 'label' => 'Setor', 'classe' => 'col-6'])
            @include('layouts.inputs.input_textarea', ['label' => 'Descrição', 'campo' => 'observacao_interino', 'rows' => '4'])
            @include('layouts.inputs.input_select', ['items' => $chefias, 'campo' => 'chefia_interino', 'firstDefault' => false, 'label' => 'Chefia', 'classe' => 'col-6'])
            @include('layouts.inputs.input_select_choices_tag_bd', ['classe' => 'col-6', 'numIdChoice' => 'i', 'items' => $anexos, 'campo' => 'anexos_interino'])
            @include('layouts.inputs.input_text', ['campo' => 'data_contratacao_interino', 'classe' => 'col-6', 'label' => 'Iniciou em', 'type' => 'date'])
            @include('layouts.inputs.input_text', ['campo' => 'data_rescisao_interino', 'classe' => 'col-6', 'label' => 'Finalizou em', 'type' => 'date'])
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cancelar</button>
          <input type="hidden" name="id_interino" value="">
          <input type="hidden" name="id_historico_interino" value="">
          <input type="hidden" name="id_usuario_interino" value="{{$servidor->id}}">
          <button type="submit" class="btn bg-gradient-primary">Salvar</button>
        </div>
      </form>
    </div>
  </div>
</div>