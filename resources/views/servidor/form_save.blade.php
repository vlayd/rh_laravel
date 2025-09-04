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
                        <input type="hidden" name="user_id" value="{{Crypt::encrypt($idUser)}}">
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
                                    @include('layouts.image.image_preview_user')
                                </div>
                                {{-- Sexo --}}
                                <div class="row mt-3 justify-content-center">
                                    <div class="form-group col-12 col-sm-auto">
                                        <div class="form-check my-auto">
                                            <input type="radio" name="sexo" class="form-check-input" id="sexo" value="2" >
                                            <label for="sexo" class="form-check-label" for="sexo">Masculino</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-12 col-sm-auto">
                                        <div class="form-check my-auto">
                                            <input type="radio" name="sexo" class="form-check-input" id="sexo" value="2" >
                                            <label for="sexo" class="form-check-label" for="sexo">Feminino</label>
                                        </div>
                                    </div>
                                </div>

                                {{-- Nome, cpf --}}
                                <div class="row mt-3">
                                    <div class="form-group col-12 col-sm-6" id="divnome">
                                        <label for="name" class="form-label">Nome Completo</label>
                                        <input type="text" class="form-control" name="nome" id="nome" value="{{$servidor->nome??''}}">
                                    </div>
                                    <div class="form-group col-12 col-sm-6 mt-3 mt-sm-0" id="divcpf">
                                        <label for="cpf" class="form-label">CPF</label>
                                        <div class="form-control cpf bg-gray-200 fw-bold" id="cpf">
                                            {{$servidor->cpf}}
                                        </div>
                                    </div>
                                    {{-- RG --}}
                                    <div class="form-group col-12 col-sm-6 col-md-3" id="divrg_numero">
                                        <label for="rg_numero" class="form-label">RG</label>
                                        <input type="text" class="form-control" name="rg_numero" id="rg_numero" value="{{$servidor->rg_numero??''}}">
                                    </div>
                                    <div class="form-group col-12 col-sm-6 col-md-3 mt-sm-0" id="divrg_orgao_emissor">
                                        <label for="rg_orgao_emissor" class="form-label">Órgão Emissor</label>
                                        <input type="text" class="form-control" name="rg_orgao_emissor" id="rg_orgao_emissor" value="{{$servidor->rg_orgao_emissor??''}}">
                                    </div>
                                    <div class="form-group col-12 col-sm-6 col-md-3 mt-sm-0" id="divrg_uf">
                                        <label for="rg_uf" class="form-label">UF</label>
                                        <select class="form-control" name="rg_uf" id="rg_uf">
                                            <option value="0">SELECIONE</option>
                                            @foreach (UF as $ind=>$value)
                                            <option value="{{$ind}}" {{($servidor->rg_uf!=null) && ($servidor->rg_uf==$ind)?'selected':''}} >{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-12 col-sm-6 col-md-3 mt-sm-0" id="divnascimento">
                                        <label for="nascimento" class="form-label">Nascimento</label>
                                        <input type="date" class="form-control" name="nascimento" id="nascimento" value="{{$servidor->nascimento??''}}">
                                    </div>
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
                                <div class="form-group col-12" id="divsecretariaOrigem">
                                    <label for="secretariaOrigem" class="form-label">Secretaria de Origem</label>
                                    <input type="text" class="form-control" name="secretariaOrigem" id="secretariaOrigem" value="{{$servidor->secretaria_origem??''}}">
                                </div>
                                <h5 class="font-weight-bolder bg-gray-200 py-2 text-center">Ensino Regular</h5>
                                <div class="row">
                                    <div class="row">
                                        <div class="form-group col-12 col-md-6 mt-3 mt-sm-0" id="divescolaridade">
                                            <label for="escolaridade" class="form-label">Escolaridade</label>
                                            <select class="form-control" name="escolaridade" id="escolaridade">
                                                @foreach (ESCOLARIDADE as $ind=>$value)
                                                <option value="{{$ind}}" {{($servidor->escolaridade!=null) && ($servidor->escolaridade==$ind)?'selected':''}} >{{$value}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 col-md-6 mt-3 mt-sm-0">
                                            <div id="orgaoClasse" class="row">
                                                <div id="divordemClassNome" class="form-group col-12 col-md-6 mt-1 mt-sm-0 align-self-end">
                                                    <label for="ordemClassNome" class="form-label">Órgão de Classe</label>
                                                    <input type="text" class="form-control" name="ordemClassNome" id="ordemClassNome" placeholder="Nome" value="{{$servidor->nome_o_classe??''}}">
                                                </div>
                                                <div id="divordemClassNome" class="form-group col-12 col-md-6 mt-1 mt-sm-0 align-self-end ps-0">
                                                    <input type="text" class="form-control" name="ordemClassNumero" id="ordemClassNumero" placeholder="Número" value="{{$servidor->numero_o_classe??''}}">
                                                </div>
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
                                <div class="form-group col-12 col-sm-6" id="divtelefone1">
                                    <label for="telefone1" class="form-label">WhatsApp</label>
                                    <input type="text" class="form-control" name="telefone1" id="telefone1" value="{{$servidor->telefone??''}}">
                                </div>
                                <div class="form-group col-12 col-sm-6 mt-sm-0" id="divtelefone2">
                                    <label for="telefone2" class="form-label">WhatsApp</label>
                                    <input type="text" class="form-control" name="telefone2" id="telefone2" value="{{$servidor->telefone2??''}}">
                                </div>
                            </div>
                            <h5 class="font-weight-bolder bg-gray-200 py-2 text-center mt-3">E-mail</h5>
                            <div class="row">
                                <div class="form-group col-12 col-sm-6" id="divemail1">
                                    <label for="email1" class="form-label">Governamental</label>
                                    <input type="text" class="form-control" name="email1" id="email1" value="{{$servidor->email??''}}">
                                </div>
                                <div class="form-group col-12 col-sm-6 mt-sm-0" id="divemail2">
                                    <label for="email2" class="form-label">Pessoal</label>
                                    <input type="text" class="form-control" name="email2" id="email2" value="{{$servidor->email2??''}}">
                                </div>
                            </div>

                            <h5 class="font-weight-bolder bg-gray-200 py-2 text-center mt-3">Endereço</h5>
                            <div class="row">
                                <div class="form-group col-9 col-sm-6 mx-0" id="divendereco_rua">
                                    <label for="endereco_rua" class="form-label">Logradouro</label>
                                    <input type="text" class="form-control" name="endereco_rua" id="endereco_rua" value="{{$servidor->endereco_rua??''}}">
                                </div>
                                <div class="form-group col-3 col-sm-1 mt-sm-0 mx-0" id="divendereco_numero">
                                    <label for="endereco_numero" class="form-label">Nº</label>
                                    <input type="text" class="form-control" name="endereco_numero" id="endereco_numero" value="{{$servidor->endereco_numero??''}}">
                                </div>
                                <div class="form-group col-12 col-sm-5 mt-sm-0" id="divendereco_bairro">
                                    <label for="endereco_bairro" class="form-label">Bairro</label>
                                    <input type="text" class="form-control" name="endereco_bairro" id="endereco_bairro" value="{{$servidor->endereco_bairro??''}}">
                                </div>
                                <div class="form-group col-12 col-sm-6 mt-sm-0" id="divendereco_complemento">
                                    <label for="endereco_complemento" class="form-label">Complemento</label>
                                    <input type="text" class="form-control" name="endereco_complemento" id="endereco_complemento" value="{{$servidor->endereco_complemento??''}}">
                                </div>
                                <div class="form-group col-12 col-sm-6 mt-sm-0" id="divendereco_cidade">
                                    <label for="endereco_cidade" class="form-label">Pessoal</label>
                                    <input type="text" class="form-control" name="endereco_cidade" id="endereco_cidade" value="{{$servidor->endereco_cidade??''}}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="button-row d-flex mt-4 col-12">
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
<script>
    var item = 'Servidor';
    var subItem = 'Informacoes';
</script>
<script src="{{asset('assets/js/view/servidor.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/plugins/multistep-form.js')}}" type="text/javascript"></script>
@endsection
