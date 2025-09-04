
@php
    $page = ['home'];
    $js = 'home';
@endphp
@extends('layouts.main_layout')

@section('breadcrumb')
@endsection

@section('content')
<div class="card shadow-lg mx-4 mt-7">
    <div class="card-body p-3">
        <!-- row gx-4 -->
        <div class="row gx-4">
            <div class="col-auto">
                <div class="avatar avatar-xl position-relative">
                    <i class="fas fa-laptop text-black-50 fa-3x"></i>
                </div>
            </div>

            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1">
                        Eventos
                    </h5>
                </div>
            </div>

            <div class="nav-wrapper position-relative ms-auto w-50">
                <ul class="nav nav-pills nav-fill p-1" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link mb-0 px-0 py-1 tabMes active" data-bs-toggle="tab" href="javascript:;" role="tab" id="tabMesAtual" aria-selected="true" data-mes="{{MES[MES_ATUAL]}}">
                            Mês atual
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-0 px-0 py-1 tabMes" data-bs-toggle="tab" href="javascript:;" role="tab" id="tabMesSeguinte" aria-selected="false" data-mes="{{MES[MES_PROXIMO]}}">
                            Mês seguinte
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-0 px-0 py-1 tabMes" data-bs-toggle="tab" href="javascript:;" role="tab" id="tabMesAnterior" aria-selected="false" data-mes="{{MES[MES_ANTERIOR]}}">
                            Mês anterior
                        </a>
                    </li>
                </ul>
            </div>
            <!-- row gx-4 -->

            <!-- Início Botões -->
            <div class="row mt-4">
                @foreach ($dadosRetangulo as $dado)
                    @include('layouts.rectangles.rectangle_home', [
                    'color' => $dado['color'],
                    'title' => $dado['title'],
                    'valueAtual' => $dado['valueAtual'],
                    'valueAnterior' => $dado['valueAnterior'],
                    'valueProximo' => $dado['valueProximo'],
                    'idCollapse' => $dado['idCollapse']??''
                ])
                @endforeach
                
            </div>
            <!-- Fim Botões -->
            <!-- ìnício tabela -->
            <div class="card mt-4 collapse" id="collapseAniversariantes">
                @foreach ($aniversarios as $aniversario)
                    @include('home.tabelas.tabela_anversariantes', ['lista' => $aniversario['lista'], 'mes' => $aniversario['mes'], 'classe' => $aniversario['classe']])
                @endforeach
            </div>
      <!-- Fim tabela -->
        </div>
    </div>
</div>
<script>var item = 'Dashboard'; var subItem = 'Home'</script>
@endsection
