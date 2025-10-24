<div class="modal fade" id="modalDeletaHistorico" tabindex="-1" role="dialog" aria-labelledby="modalDeletaHistoricoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white" id="modalDeletaHistoricoLabel">Excluindo histórico...</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-dark">X</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Deseja mesmo excluir esse histórico?</p>
            </div>
            <div class="modal-footer">
                <form action="{{route('historico.delete')}}" method="post">
                    @csrf
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn bg-gradient-danger" data-bs-dismiss="modal">Sim</button>
                    <input type="hidden" name="id_historico">
                </form>
            </div>
        </div>
    </div>
</div>
