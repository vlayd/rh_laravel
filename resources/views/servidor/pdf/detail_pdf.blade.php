<?php
use App\Services\Operations;
use Mpdf\Mpdf;

$mpdf = new Mpdf();
$mpdf->SetHTMLHeader('
<div class="images">
    <img class="loggov" src="'.asset(PATH_APOIO_LOGOS).'" alt="">
</div>
', write: true);
$mpdf->defaultfooterline = 0;
$mpdf->SetHTMLFooter('
<hr>
<div style="font-size: 0.7em;">
    <div style="text-align: center;">
        Endereço: Travessa Habitasa, nº 95 - Habitasa - CEP 69.905-114, Rio Branco<br>
        Telefone: (068) 3223-7000/3224-4576. E-mal: procon.acre@gmail.com <br>
        Gerado em: {DATE j/m/Y} às '.date("H:i:s").'
    </div>
</div>');
//Formata itens do servidor
$escolarFaculdade = '';
$cpf = Operations::formataCPF($atual->cpf);
$rg = "{$atual->rg_numero} {$atual->rg_orgao_emissor}/{$atual->rg_uf}";
$nascimento = $atual->nascimento;
$idade = $atual->idade;
$telefone = $atual->telefone;
$telefone2 = $atual->telefone2;
$email = $atual->email;
$email2 = $atual->email2;
$endereco = "{$atual->endereco_rua}, nº {$atual->endereco_numero}, {$atual->endereco_bairro}, {$atual->endereco_complemento}, {$atual->endereco_cidade}-Acre";

$html = '
<html>
    <head>
        <title>Relatório</title>
        <style>
            body {
                font-family: Verdana, Helvetica, Gill Sans, sans-serif;
            }
            table, th {
                border: 0.5px solid black;
                border-collapse: collapse;
            }
            td {
                padding: 2mm 0 2mm 3mm;
                text-align: left;
                font-size: 13px;
            }
            .td {
                text-align: left;
                font-size: 13px;
            }
            table {
              margin-top: 5mm;
              border-radius: 15px;
            }
            th {
              width: 200mm;
              text-align: center;
              background-color: #DEE2E6;
              padding: 2mm;
              color: black;
            }
            .logproc {
                margin-top: 5mm;               
                height: 23.5mm;
                margin-left: 70mm;
            }
            .loggov {
                height: 30.3mm;
                width: 300mm;
            }
            .divider {
                border-bottom: 0.5px solid black;
            }
            .nome {
                font-size: 22px;
                font-weight: bold;
                border-radius: 10px;
                background-color: #172B4D;
                text-align: center;
                padding: 3mm;
                color: white;
            }
            .foto {
                display: block;
                margin-left: auto;
                margin-right: auto;
                width: 200mmm;
                border: 10px solid white;
                border-radius: 25px;
              }
              .th {
                border-bottom: 0.5px solid black;
                font-weight: bold;
                width: 100%;
                text-align: center;
                background-color: #DEE2E6;
                padding: 2mm;
                color: black;
              }
              .table {
                border: 0.5px solid black;
                margin-top: 5mm;
              }
              .titulo_escola {
                text-align: left;
                font-weight: bold;
                font-size: 16px;
              }
              .sub_titulo_escola {
                text-align: left;
                font-weight: bold;
                font-size: 15px;
              }
              .p-3 {
                padding: 3mm;
              }
              .fs-13 {
                font-size: 13px;
              }
              .ps-3 {
                padding-left: 3mm;
              }
              .ps-5 {
                padding-left: 5mm;
              }
              .px-3 {
                padding-left: 3mm;
                padding-right: 3mm;
              }
              .pt-3 {
                padding-top: 3mm;
              }
              .pt-5 {
                padding-top: 5mm;
              }
              .pt-2 {
                padding-top: 2mm;
              }
              .pb-3 {
                padding-bottom: 3mm;
              }
              .anexo {
                font-weight: bold;
                color: #3432a8;
                padding-left: 3mm;
                padding-top: 1mm;

              }

        </style>
    </head>

    <body>
        <div class="container">
            <div class="foto"><img class="" src="'.asset(PATH_APOIO_TEST_USER).'" alt=""></div>
            <div class="nome">Vlaydisson Valóis de Melo</div>
            <table>
                <thead>
                    <tr>
                        <th colspan="2">Dados Pessoais</th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="pt-3"><strong>CPF: </strong>'.$cpf.'</td>
                    <td class="pt-3"><strong>RG: </strong>'.$rg.'</td>
                </tr>
                <tr>
                    <td><strong>Nascimento: </strong>'.$nascimento.'</td>
                    <td><strong>Idade: </strong>'.$idade.'</td>
                </tr>
                <tr>
                    <td><strong>Telefone: </strong>'.$telefone.'</td>
                    <td><strong>Whatsapp: </strong>'.$telefone2.'</td>
                </tr>
                <tr>
                    <td><strong>E-mail Pessoal: </strong>'.$email.'</td>
                    <td><strong>E-mail Gov: </strong>'.$email2.'</td>
                </tr>
                <tr>
                    <td colspan="2" class="pb-3"><strong>Endereço: </strong>'.$endereco.'</td>
                </tr>
                </tbody>
            </table>

            <div class="pt-3"></div>
            <div class="table">
                <div class="th">Informações Profissionais</div>
                <div class="titulo_escola p-3">
                    ENSINO REGULAR
                    <div class="divider"></div>
                </div>
                <div class="td ps-3 pb-3"><strong>Escolaridade: </strong>'.$atual->nomeEscolar.'</div>'.
                $atual->escolaridade
                .'
                <div class="pt-3"></div>
            </div>

            <div class="pt-3"></div>
            <table>
                <thead>
                    <tr>
                        <th colspan="2">Informações do Contrato</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Tipo: </strong>'.$atual->nomeContrato.'</td>
                        <td><strong>Gratificação/empresa: </strong>'.$atual->nomeContrato.'</td>
                    </tr>
                    <tr>
                        <td><strong>Matrícula: </strong>'.$atual->nomeGratificacao.'</td>
                        <td><strong>Cargo: </strong>Gestor de Política Públicas</td>
                    </tr>
                    <tr>
                        <td colspan="2"><strong>Secretaria de Origem: </strong>SEAD</td>
                    </tr>
                </tbody>
            </table>

            <div class="pt-3"></div>
            <table>
                <thead>
                    <tr>
                        <th colspan="2">Em exercício Atualmente</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><div class="w-100"><strong>Função: </strong>Efetivo</div></td>
                        <td><strong>Chefia: </strong>Não</td>
                    </tr>
                    <tr>
                        <td><strong>Setor: </strong>NÚCLEO DE ATENDIMENTO REGIONAL DE CRUZEIRO DO SUL</td>
                        <td><strong>Anexos: </strong>
                            <div class="anexo">&nbsp;&nbsp;&nbsp;<a href="google.com.br">Nomeação 1</a></div>
                            <div class="anexo">&nbsp;&nbsp;&nbsp;Nomeação 2</div>
                            <div class="anexo">&nbsp;&nbsp;&nbsp;Nomeação 3</div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="pt-3"></div>
            <div class="table">
                <div class="th">Outras funções exercidas</div>
                <div class="titulo_escola p-3">
                    DIVISÃO DE COMUNICAÇÃO SOCIAL
                    <div class="divider"></div>
                </div>
                <div class="td ps-3 pb-3"><strong>Período: </strong>10/10/2024 a 13/11/2024</div>
                <div class="td ps-3 pb-3"><strong>Contrato: </strong>Efetivo</div>
                <div class="td ps-3 pb-3"><strong>Matrícula: </strong>9123318-2</div>
                <div class="td ps-3 pb-3"><strong>Função: </strong>Auxiliar Administrativo</div>
                <div class="td ps-3 pb-3"><strong>Gratificação: </strong>FG-4</div>
                <div class="td ps-3 pb-3"><strong>Chefia: </strong>Não</div>
                <div class="td ps-3 pb-3"><strong>Anexos: </strong>
                    <div class="anexo">Nomeação 1</div>
                    <div class="anexo">Nomeação 2</div>
                </div>
                <div class="titulo_escola p-3">
                    DIVISÃO DE COMUNICAÇÃO SOCIAL
                    <div class="divider"></div>
                </div>
                <div class="td ps-3 pb-3"><strong>Período: </strong>10/10/2024 a 13/11/2024</div>
                <div class="td ps-3 pb-3"><strong>Contrato: </strong>Efetivo</div>
                <div class="td ps-3 pb-3"><strong>Matrícula: </strong>9123318-2</div>
                <div class="td ps-3 pb-3"><strong>Função: </strong>Auxiliar Administrativo</div>
                <div class="td ps-3 pb-3"><strong>Gratificação: </strong>FG-4</div>
                <div class="td ps-3 pb-3"><strong>Chefia: </strong>Não</div>
                <div class="td ps-3 pb-3"><strong>Anexos: </strong>
                    <div class="anexo">Nomeação 1</div>
                    <div class="anexo">Nomeação 2</div>
                </div>
                <div class="titulo_escola p-3">
                    DIVISÃO DE COMUNICAÇÃO SOCIAL
                    <div class="divider"></div>
                </div>
                <div class="td ps-3 pb-3"><strong>Período: </strong>10/10/2024 a 13/11/2024</div>
                <div class="td ps-3 pb-3"><strong>Contrato: </strong>Efetivo</div>
                <div class="td ps-3 pb-3"><strong>Matrícula: </strong>9123318-2</div>
                <div class="td ps-3 pb-3"><strong>Função: </strong>Auxiliar Administrativo</div>
                <div class="td ps-3 pb-3"><strong>Gratificação: </strong>FG-4</div>
                <div class="td ps-3 pb-3"><strong>Chefia: </strong>Não</div>
                <div class="td ps-3 pb-3"><strong>Anexos: </strong>
                    <div class="anexo">Nomeação 1</div>
                    <div class="anexo">Nomeação 2</div>
                </div>
            </div>
        </div>
    </body>
</html>';
// echo $html;exit;
$mpdf->AddPage('P', mgh: 2, mgt: 35, mgb: 25, mgf: 2, mgr: 8, mgl: 8);
$mpdf->WriteHTML($html);
$mpdf->Output();
exit;