<div class="modal fade" id="addServidor" tabindex="-1" role="dialog" aria-labelledby="addServidorLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addServidorLabel">Cadastrar CPF</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{route('servidor.salvacpf')}}" method="post" id="form_cpf">
            @csrf
            <div class="row">
                <div class="form-group col-12" id="divCpf">
                    <label for="divCpf" class="form-label">CPF</label>
                    <input type="text" name="cpf" class="form-control cpf" id="cpf" oninput="validadeCpf(this.value)">
                </div>
            </div>
          </form>
          <div class="text-danger fw-bold text-sm text-center" id="msgErro"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" id="btnSalvarCpf" form="form_cpf" class="btn bg-gradient-success" disabled>Cadastrar</button>
        </div>
      </form>
    </div>
  </div>
</div>
