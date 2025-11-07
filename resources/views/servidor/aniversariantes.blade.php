@php
    $page = ['servidor'];
    $js = 'servidor';
@endphp
@extends('layouts.main_layout')
@section('breadcrumb')
@endsection

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <!-- Início Card header - Título e botão -->
        <div class="card-header pb-0">
          <h5 class="mb-0">Lista de Aniversariantes</h5>
            @include('layouts.menus_bar.botoes_meses')
        </div>
        <!-- Fim Card header - Título e botão -->
        <!-- Início Card body - Tabela -->
        <div class="card-body px-0 pb-0">
            <div class="table-responsive">
                <table class="table align-items-center mb-0 border" id="servidores-list">
                    <tbody>
                      <?php foreach($aniversariantes as $aniversariante):
                        $classCurrenteMes = 'd-none';
                        $foto = empty($aniversariante->foto) ? PATH_SEM_FOTO : PATH_UPLOAD_USUARIO.$aniversariante->id.'/perfil/'.$aniversariante->foto;
                        if(substr($aniversariante->aniversario, -2) == date('m')) $classCurrenteMes = '';
                        ?>
                          <tr class="mes mes<?=substr($aniversariante->aniversario, -2) . ' ' . $classCurrenteMes?>">
                              <td class="text-sm">
                                  <div class="d-flex px-2">
                                      <div>
                                          <img src="<?=asset($foto)?>" class="avatar avatar-sm rounded-circle me-2">
                                      </div>
                                      <div class="my-auto">
                                          <h6 class="mb-0 text-xs"><?=$aniversariante->nome?></h6>
                                      </div>
                                  </div'>
                              </td>
                              <td class="text-sm text-center"><h6 class="mb-0 text-xs text-center"><?=$aniversariante->aniversario?></h6></td>
                              <td class="text-sm text-center"><h6 class="mb-0 text-xs text-center"><?=$aniversariante->idade?></h6></td>
                              <td class="text-sm text-center"><h6 class="mb-0 text-xs text-center"><?=$aniversariante->falta?></h6></td>
                          </tr>  
                      <?php endforeach?>
                    </tbody>
                </table>
            </div>
        </div>
      </div>
    </div>
</div>
@endsection

@section('js')
@endsection
