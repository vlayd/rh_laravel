@php
    $page = ['servidor'];
    $js = 'servidor';
    $foto = empty($servidor->foto) ? PATH_SEM_FOTO : PATH_UPLOAD_USUARIO.$servidor->id.'/perfil/'.$servidor->foto;
@endphp
@extends('layouts.main_layout')
@section('breadcrumb')
@endsection

@section('content')
<div class="row mb-5">
    <div class="col-12">
        <div class="multisteps-form mb-5">
            <!--progress bar-->
            <div class="row">
                <div class="col-12 col-lg-8 mx-auto my-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="multisteps-form__progress">
                                <button class="multisteps-form__progress-btn js-active" type="button" title="User Info">
                                    <span>Pessoal</span>
                                </button>
                                <button class="multisteps-form__progress-btn" type="button" title="Address">Profissional</button>
                                <button class="multisteps-form__progress-btn" type="button" title="Socials">Contato</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--form panels-->
            <div class="row">
                <div class="col-12 col-lg-8 m-auto">
                    <form class="multisteps-form__form mb-8" method="post" action="{{route('servidor.update')}}" enctype="multipart/form-data">
                        @csrf
                        <!-- Dados pessoais form panel-->
                        <div class="card multisteps-form__panel p-3 border-radius-xl bg-white js-active" data-animation="FadeIn">
                            <div class="d-flex">
                                <h4 class="font-weight-bolder">Dados Pessoais</h4>
                                <div class="ms-auto my-auto mt-lg-0 mt-4">
                                    <div class="ms-auto my-auto">
                                        <a href="" class="btn bg-gradient-primary btn-sm mb-0" target="_blank">+&nbsp; Incluir Anexo</a>
                                    </div>
                                </div>
                            </div>
                            <div class="multisteps-form__content">
                                <div class="row mt-3 justify-content-center">
                                    @include('layouts.image.image_preview_user', ['foto' => $foto])
                                </div>
                                {{-- Sexo --}}
                                <div class="row mt-3 justify-content-center">
                                    <div class="form-group col-12 col-sm-auto">
                                        <div class="form-check my-auto">
                                            <input type="radio" name="sexo" class="form-check-input" id="sexo" value="1" {{$servidor->sexo==1?'checked ':''}}>
                                            <label for="sexo" class="form-check-label" for="sexo">Masculino</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-12 col-sm-auto">
                                        <div class="form-check my-auto">
                                            <input type="radio" name="sexo" class="form-check-input" id="sexo" value="2" {{$servidor->sexo==2?'checked ':''}}>
                                            <label for="sexo" class="form-check-label" for="sexo">Feminino</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    {{-- Nome, cpf --}}
                                    @include('layouts.inputs.input_text', ['label' => 'Nome Completo', 'campo' => 'nome', 'classe' => 'col-12 col-sm-6', 'valor' => $servidor->nome])
                                    @include('layouts.inputs.input_text_disabled', ['label' => 'CPF', 'classe' => 'col-12 col-sm-6 mt-3 mt-sm-0', 'classe2' => 'cpf', 'valor' => $servidor->cpf])
                                    {{-- RG --}}
                                    @include('layouts.inputs.input_text', ['label' => 'RG', 'campo' => 'rg_numero', 'classe' => 'col-12 col-sm-6 col-md-3', 'valor' => $servidor->rg_numero])
                                    @include('layouts.inputs.input_text', ['label' => 'Órgão Emissor', 'campo' => 'rg_orgao_emissor', 'classe' => ' col-12 col-sm-6 col-md-3 mt-sm-0', 'valor' => $servidor->rg_orgao_emissor])
                                    @include('layouts.inputs.input_select', ['label' => 'UF', 'campo' => 'rg_uf', 'classe' => 'col-12 col-sm-6 col-md-3 mt-sm-0', 'items' => UF, 'idSelect' => $servidor->rg_uf])
                                    @include('layouts.inputs.input_text', ['label' => 'Nascimento', 'type' => 'date', 'campo' => 'nascimento', 'classe' => 'col-12 col-sm-6 col-md-3 mt-sm-0', 'valor' => $servidor->nascimento])
                                </div>
                                <div class="button-row d-flex mt-4">
                                    <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="button" title="Next">Avançar</button>
                                </div>
                            </div>
                        </div>
                        <!-- Dados profissionais form panel-->
                        <div class="card multisteps-form__panel p-3 border-radius-xl bg-white" data-animation="FadeIn">
                            <div class="d-flex">
                                <h4 class="font-weight-bolder">Dados Pofissionais</h4>
                                <div class="ms-auto my-auto mt-lg-0 mt-4">
                                    <div class="ms-auto my-auto">
                                        <a href="" class="btn bg-gradient-primary btn-sm mb-0" target="_blank">+&nbsp; Incluir Anexo</a>
                                    </div>
                                </div>
                            </div>
                            <div class="multisteps-form__content">
                                @include('layouts.inputs.input_text', ['label' => 'Secretaria de Origem', 'campo' => 'secretariaOrigem', 'valor' => $servidor->secretaria_origem])

                                <h5 class="font-weight-bolder bg-gray-200 py-2 text-center">Ensino Regular</h5>
                                <div class="row">
                                    <div class="row">
                                        @include('layouts.inputs.input_select_bd', ['label' => 'Escolaridade', 'campo' => 'escolaridade', 'classe' => 'col-12 col-md-6 mt-3 mt-sm-0', 'items' => $escolaridades, 'idSelect' => $servidor->escolaridade])
                                        
                                        <div id="orgaoClasse" class="col-12 col-md-6 mt-3 mt-sm-0 {{$servidor->escolaridade>5?'':'d-none'}}">
                                            <div class="row">
                                                @include('layouts.inputs.input_text', ['label' => 'Órgão de Classe', 'campo' => 'ordemClassNome', 'valor' => $servidor->nome_o_classe, 'classe' => 'col-12 col-md-6 mt-1 mt-sm-0 align-self-end', 'placeholder' => 'Nome'])
                                                @include('layouts.inputs.input_text', ['campo' => 'ordemClassNumero', 'valor' => $servidor->numero_o_classe, 'classe' => 'col-12 col-md-6 mt-1 mt-sm-0 align-self-end ps-0', 'placeholder' => 'Número'])
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="button-row d-flex mt-4">
                                    <button class="btn bg-gradient-light mb-0 js-btn-prev" type="button" title="Prev">Voltar</button>
                                    <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="button" title="Next">Avançar</button>
                                </div>
                            </div>
                        </div>
                        <!--Dados de contato form panel-->
                        <div class="card multisteps-form__panel p-3 border-radius-xl bg-white" data-animation="FadeIn">
                            <div class="d-flex">
                                <h4 class="font-weight-bolder">Dados para Contato</h4>
                                <div class="ms-auto my-auto mt-lg-0 mt-4">
                                    <div class="ms-auto my-auto">
                                        <a href="" class="btn bg-gradient-primary btn-sm mb-0" target="_blank">+&nbsp; Incluir Anexo</a>
                                    </div>
                                </div>
                            </div>
                            <div class="multisteps-form__content">
                            <h5 class="font-weight-bolder bg-gray-200 py-2 text-center">Telefone</h5>
                            <div class="row mt-3">
                                @include('layouts.inputs.input_text', ['label' => 'WhatsApp', 'campo' => 'telefone1', 'classe' => 'col-12 col-sm-6', 'valor' => $servidor->telefone])
                                @include('layouts.inputs.input_text', ['label' => 'Outro telefone', 'campo' => 'telefone2', 'classe' => 'col-12 col-sm-6 mt-sm-0', 'valor' => $servidor->telefone2])
                            </div>
                            <h5 class="font-weight-bolder bg-gray-200 py-2 text-center mt-3">E-mail</h5>
                            <div class="row">
                                @include('layouts.inputs.input_text', ['label' => 'Governamental', 'campo' => 'email1', 'classe' => 'col-12 col-sm-6', 'valor' => $servidor->email])
                                @include('layouts.inputs.input_text', ['label' => 'Pessoal', 'campo' => 'email2', 'classe' => 'col-12 col-sm-6', 'valor' => $servidor->email2])
                            </div>

                            <h5 class="font-weight-bolder bg-gray-200 py-2 text-center mt-3">Endereço</h5>
                            <div class="row">
                                @include('layouts.inputs.input_text', ['label' => 'Logradouro', 'campo' => 'endereco_rua', 'classe' => 'col-9 col-sm-6 mx-0', 'valor' => $servidor->endereco_rua])
                                @include('layouts.inputs.input_text', ['label' => 'Nº', 'campo' => 'endereco_numero', 'classe' => 'col-3 col-sm-1 mt-sm-0 mx-0', 'valor' => $servidor->endereco_numero])
                                @include('layouts.inputs.input_text', ['label' => 'Bairro', 'campo' => 'endereco_bairro', 'classe' => 'col-12 col-sm-5 mt-sm-0', 'valor' => $servidor->endereco_bairro])
                                @include('layouts.inputs.input_text', ['label' => 'Complemento', 'campo' => 'endereco_complemento', 'classe' => 'col-12 col-sm-6 mt-sm-0', 'valor' => $servidor->endereco_complemento])
                                @include('layouts.inputs.input_text', ['label' => 'Cidade', 'campo' => 'endereco_cidade', 'classe' => 'col-12 col-sm-6 mt-sm-0', 'valor' => $servidor->endereco_cidade])
                            </div>

                            <div class="row">
                                <div class="button-row d-flex mt-4 col-12">
                                    <input type="hidden" name="user_id" value="{{Crypt::encrypt($idUser)}}">
                                    <button class="btn bg-gradient-light mb-0 js-btn-prev" type="button" title="Prev">Voltar</button>
                                    <button class="btn bg-gradient-dark ms-auto mb-0" type="submit" title="Salvar os dados do servidor">Salvar</button>
                                </div>
                            </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<?=CDN_JS_MULTISTEP_FORM?>
<?=CDN_JS_MASK?>
@endsection
