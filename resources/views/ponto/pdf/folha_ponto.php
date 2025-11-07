<?php
// dd($servidor);
use App\Controllers\BaseController;
use Mpdf\Mpdf;

// $a_date = '09/01/2019';
//mês/dia/ano
$a_date = $ponto['mes'].'/01/'.$ponto['ano'];
$periodoMes = date("01/m/Y \a t/m/Y", strtotime($a_date));
//Padrão do colSpan caso o servidor não seja terceirizado
$colSpanTh = '5';
$rowDias = '';
for ($i=1; $i<=31; $i++){
    if(!checkdate($ponto['mes'], $i, 2024)) continue;
    $data = "2024-{$ponto['mes']}-$i";
    $i = $i<10?"0$i":$i;
    $numSemana = date('w', strtotime($data));
    $corLinha = '';
    $procuraFeriado = BaseController::findFeriado($data);
    $tdSemFeriados = '
        <td id="entrada"></td>
        <td id="saida"></td>
        <td id="assinatura"></td>';
    $colSpanFeriado = '3';
    if($servidor['contrato'] == 3){
        $colSpanFeriado = '7';
        $tdSemFeriados = '
            <td class="intervalo"></td>
            <td class="intervalo"></td>
            <td class="intervalo"></td>
            <td class="intervalo"></td>
            <td class="intervalo"></td>
            <td class="intervalo"></td>
            <td></td>
            ';
    }
    if($numSemana == 6 || $numSemana == 0 || $procuraFeriado){
        $corLinha = 'linhaCinza';
        if($procuraFeriado){
            $tdSemFeriados = '
                <td colspan="'.$colSpanFeriado.'" class="tdFeriado linhaCinza"><strong>'.TIPO_FERIADO[$procuraFeriado['tipo']].':</strong> '.$procuraFeriado['nome'].'</td>
            ';
        }
    }
    $rowDias .='
        <tr class="'.$corLinha.'">
            <td id="data">'.$i.'</td>
            <td id="semana">'.DIA_SEMANA_ABR[$numSemana].'</td>'.
            $tdSemFeriados
        .'</tr>';
}

$ths = '
    <tr>
        <th colspan="2" id="dias">Dias</th>
        <th>Entrada</th>
        <th>Saída</th>
        <th>Assinatura</th>
    </tr>
';
if($servidor['contrato'] == 3){
    $colSpanTh = '9';
    $ths = '
    <tr>
         <th class="semBorda semBordaInf" colspan="2" rowspan="2">Dias</th>
         <th colspan="4">Normal</th>
         <th colspan="2">Extra</th>
         <th rowspan="2">Assinatura ou observações</th>
    </tr>
    <tr>
         <th>Início</th>
         <th colspan="2">Intervalo</th>
         <th>Término</th>
         <th>Início</th>
         <th>Término</th>
    </tr>';
}
$html = '<html>
<head>
    <title>Relatório</title>
    <style>
        body {
            font-family: Verdana, Helvetica, Gill Sans, sans-serif;
        }
        .container {
            padding-top: 3mm;
        }
        .desc {
            text-align: start;
            padding-left: 2mm;
            padding-top: 1mm;
            padding-bottom: 1mm;
        }
        table {
            width: 100%;
        }
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        td {
            text-align: center;          
        }
        th {
            background-color:#f1f1f1;            
        }
        th, td {
            padding-top: 0.5mm;
            padding-bottom: 0.5mm;
        }
        .images {               
            margin-top: 50mm;
        }
        .logproc {             
            margin-top: 5mm;               
            height: 23.5mm;
            margin-left: 70mm;
        }
        .loggov {
            height: 27.3mm;
        }
        .imgTipo {
            width: 10mm;
            height: 7mm;
        }
        #data, #semana {
            font-size: 14px;        
            width: 5%;
        }
        #entrada, #saida {
            width: 20%;    
        }
        .linhaCinza {
            background-color:#DCDCDC;
        }
        .center {
            text-align: center;
        }
        .center-50 {
            width: 50%;
        }
        .float-fim {
            float: left;
        }
        .assinaturas {
            margin-top: 15mm;
        }
        th.semBorda {
        border: 0;
        }
        td.intervalo {
        width: 11%;
        }
        th.semBordaInf {
        border-bottom: 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <table>
            <thead>
                <tr>
                    <th colspan="'.$colSpanTh.'" class="desc">Folha de Ponto Individual de Funcionário - Período: '.$periodoMes.'</th>
                </tr>
                <tr>
                    <td colspan="'.$colSpanTh.'" class="desc">
                        <strong>Funcionário</strong>: '.mb_strtoupper($servidor['nomeUser']).'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Contrato</strong>: '.$servidor['nomeContrato'].'<br>
                        <strong>Setor</strong>: '.mb_strtoupper($servidor['nomeSetor']).' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Função</strong>: '.$servidor['funcao'].'<br>
                        <strong>Horário</strong>: 07:00 às 14:00<br>
                    </td>                    
                </tr>'.
                $ths
            .'</thead>
            <tbody>'.
                $rowDias
            .'</tbody>
        </table>

        <div class="center assinaturas">
            <div class="center-50 float-fim">
                <div class="center">
                    ___________________________________
                </div>
                <div class="center">
                    Assinatura do servidor
                </div>
            </div>

            <div class="center-50">
                <div class="center">
                ___________________________________
                </div>
                <div class="center">
                    Assinatura do chefe imediato
                </div>
            </div>
        </div>        
    </div>
</body>
</html> ';
$mpdf = new Mpdf();
$mpdf->SetHTMLHeader('
<div class="images">
    <img class="loggov" src="assets/img/apoio/imggov.png" alt="">
    <img class="logproc" src="assets/img/apoio/logo.png" alt="">
</div>
', write: true);
$mpdf->defaultfooterline = 0;
$mpdf->SetHTMLFooter('
<hr>
<div style="font-size: 0.7em;">
    <div style="text-align: center;">
        Endereço: Travessa Habitasa, nº 95 - Habitasa - CEP 69.905-114, Rio Branco<br>
        Telefone: (068) 3223-7000/3224-4576. E-mal: procon.acre@gmail.com
    </div>
</div>
');
// echo $html;exit;
$mpdf->AddPage('P', mgh: 2, mgt: 30, mgb: 25, mgf: 2, mgr: 8, mgl: 8);
$mpdf->WriteHTML($html);
$mpdf->Output();
exit;