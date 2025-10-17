<div class="modal fade modal-lg" id="modalSave" tabindex="-1" role="dialog" aria-labelledby="modalSaveLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{route('anexo.salvar')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalSaveLabel">Salvando Anexo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-body">
                    <div class="row justify-content-center">
                        @include('layouts.inputs.input_text', [
                            'label' => 'Descrição',
                            'campo' => 'nome',
                            'campoId' => 'nomeModal',
                            'classe' => 'col-12 col-lg-6',
                        ])
                        @include('layouts.inputs.input_select', [
                            'label' => 'Tipo',
                            'campo' => 'tipo',
                            'campoId' => 'tipoModal',
                            'classe' => 'col-12 col-lg-6',
                            'items' => TIPOS_ANEXO
                        ])
                        @include('layouts.inputs.input_file', [
                            'label' => 'Anexo',
                            'campo' => 'anexo',
                            'campoId' => 'anexoModal',
                            'classe' => 'col-12 col-lg-6',
                        ])
                        @include('layouts.inputs.input_text', [
                            'label' => 'Ordem',
                            'type' => 'number',
                            'campo' => 'ordem',
                            'campoId' => 'ordemModal',
                            'classe' => 'col-12 col-lg-6',
                        ])
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn bg-gradient-primary" data-bs-dismiss="modal">Salvar</button>
                    <input type="hidden" name="id_anexo" value="">
                    <input type="hidden" name="id_user" value="{{Crypt::encrypt($idUser)}}">
                </div>
            </form>
        </div>
    </div>
</div>
