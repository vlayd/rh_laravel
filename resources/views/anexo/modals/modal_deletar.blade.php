 <div class="modal fade" id="deletarModal" tabindex="-1" role="dialog" aria-labelledby="deletarModalTitulo"
     aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
             <div class="modal-header bg-danger">
                 <h5 class="modal-title text-white" id="deletarModalTitulo">Deletando Anexo...</h5>
                 <span role="button" data-bs-dismiss="modal" aria-label="Close">
                     <i class="fa-solid fa-xmark text-white"></i>
                 </span>
             </div>
             <div class="modal-body">
                 <p>Deseja mesmo deletar <span class="font-weight-bold" id="deletar_nome"></span></p>
             </div>
             <div class="modal-footer">
                 <form action="{{ route('anexo.deletar') }}" method="post">
                    @csrf
                     <button type="submit" data-id="" class="btn bg-gradient-danger btn_delete" data-bs-dismiss="modal">Excluir</button>
                     <button type="button" class="btn btn-link ml-auto text-danger" data-bs-dismiss="modal">Fechar</button>
                     <input type="hidden" name="id" value="">
                 </form>
             </div>
         </div>
     </div>
 </div>
