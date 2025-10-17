<?php
//________________________TEXTOS BASE________________________________
define('URL_BASE', 'http://10.51.3.227/');
define('NAME_APP', 'Sistema RH');

//________________________PATH_______________________________________
define('CDN', URL_BASE.'cdn/');
define('CDN_CSS', URL_BASE.'cdn/assets/css/');
define('CDN_IMG_APOIO', URL_BASE.'cdn/assets/img/apoio/');

define('CDN_JS', URL_BASE.'cdn/assets/js/');
define('CDN_ASSETS', URL_BASE.'cdn/assets/');
define('CDN_JS_INIT', URL_BASE.'cdn/assets/js/init/');
define('CDN_JS_CORE', URL_BASE.'cdn/assets/js/core/');
define('CDN_JS_PLUGINS', URL_BASE.'cdn/assets/js/plugins/');
define('CDN_FONTAWESOME', URL_BASE.'cdn/assets/fontawesome/');

define('RH_USUARIOS', URL_BASE.'rh/public/assets/upload/usuarios/');

define('PATH_UPLOAD_USUARIO', 'assets/upload/usuarios/');
define('PATH_UPLOAD_ANEXO', 'assets/upload/usuarios/');
define('PATH_APOIO_PROCON', 'assets/img/apoio/logo.png');
define('PATH_APOIO_LOGOS', 'assets/img/apoio/logo_all.jpeg');
define('PATH_APOIO_GOVERNO', 'assets/img/apoio/imggov.png');
define('PATH_APOIO_TEST_USER', 'assets/img/apoio/test_user.jpg');
define('PATH_APOIO_TEST_USER_2', 'assets/img/apoio/test_user2.png');
define('PATH_SEM_IMAGEM', CDN_IMG_APOIO.'no-image.jpg');
define('PATH_SEM_FOTO', CDN_IMG_APOIO.'no-foto.png');
define('PATH_UPLOAD_FILE_ANEXO', 'assets/upload/usuarios/files/anexo/');

//________________________CS_______________________________________
define('CDN_CSS_CORE_ALL', '
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
<link href="'.CDN_CSS.'nucleo-icons.css" rel="stylesheet" />
<link href="'.CDN_CSS.'nucleo-svg.css" rel="stylesheet" />
');
define('CDN_CSS_FONTAWESOME_ALL', '
<link href="'.CDN_FONTAWESOME.'css/all.min.css" rel="stylesheet" />
<link href="'.CDN_FONTAWESOME.'fontawesome/css/all.min.css" rel="stylesheet" />
');
define('CDN_CSS_JQUERY_TOAST', '<link href="'.CDN_CSS.'jquery.toast.min.css" rel="stylesheet" />');
define('CDN_CSS_MAIN', '<link id="pagestyle" href="'.CDN_CSS.'argon-dashboard.css?v=2.0.5" rel="stylesheet" />');

//________________________JS_______________________________________
define('CDN_JS_CORE_ALL', '
<script src="'.CDN_JS_CORE.'jquery-3.6.0.min.js"></script>
<script src="'.CDN_JS_CORE.'popper.min.js"></script>
<script src="'.CDN_JS_CORE.'bootstrap.min.js"></script>
<script src="'.CDN_JS.'pages.js"></script>
');

define('CDN_JS_FONTAWESOME_ALL', '
<script src="'.CDN_FONTAWESOME.'js/all.min.js"></script>
<script src="'.CDN_FONTAWESOME.'fontawesome/js/all.min.js"></script>
');

define('CDN_JS_MULTISTEP_FORM', '<script src="'.CDN_JS_PLUGINS.'multistep-form.js"></script>');
define('CDN_JS_PAGES', '<script src="'.CDN_JS.'pages.js"></script>');

define('CDN_JS_DATATABLES', '
<script src="'.CDN_JS_PLUGINS.'datatables.js"></script>
<script src="'.CDN_JS_INIT.'datatables.js"></script>
');

define('CDN_JS_MASK', '
<script src="'.CDN_JS_PLUGINS.'jquery.mask.min.js"></script>
<script src="'.CDN_JS_INIT.'jquery.mask.js"></script>
');

define('JS_PLUGIN_CHOICES', '
    <script src="'.CDN_JS_PLUGINS.'choices.min.js" type="text/javascript"></script>
    <script src="'.CDN_JS_INIT.'choices.js" type="text/javascript"></script>
');

define('CDN_JS_TOAST', '
<script src="'.CDN_JS_PLUGINS.'jquery.toast.min.js"></script>
<script src="'.CDN_JS_INIT.'jquery.toast.js"></script>
');

define('CDN_JS_SWEETALERT2', '
<script src="'.CDN_JS_PLUGINS.'sweetalert2.min.js"></script>
<script src="'.CDN_JS_INIT.'sweetalert2.js"></script>
');

define('CDN_JS_PERFECT_SCROLLBAR', '
<script src="'.CDN_JS_PLUGINS.'perfect-scrollbar.min.js"></script>
<script src="'.CDN_JS_PLUGINS.'smooth-scrollbar.min.js"></script>
<script src="'.CDN_JS_INIT.'perfect-scrollbar.js"></script>
');

define('CDN_JS_MAIN', '<script src="'.CDN_JS.'argon-dashboard.min.js?v=2.0.5"></script>');

//________________________ARRAYS UTEIS________________________________
define('MES', [
    '01' => 'janeiro',
    '02' => 'fevereiro',
    '03' => 'março',
    '04' => 'abril',
    '05' => 'maio',
    '06' => 'junho',
    '07' => 'junho',
    '08' => 'agosto',
    '09' => 'setembro',
    '10' => 'outubro',
    '11' => 'novembro',
    '12' => 'dezembro',
]);

define('MES_', [
    '0' => 'dezembro',
    '1' => 'janeiro',
    '2' => 'fevereiro',
    '3' => 'março',
    '4' => 'abril',
    '5' => 'maio',
    '6' => 'junho',
    '7' => 'junho',
    '8' => 'agosto',
    '9' => 'setembro',
    '10' => 'outubro',
    '11' => 'novembro',
    '12' => 'dezembro',
    '13' => 'janeiro',
]);

define('TIPOS_ANEXO_BASIC', [
    'profissional' => 'Profissional',
    'folha' => 'Folhas de Ponto',
    'funcao' => 'Referente a Função',
]);

define('MES_ATUAL', date('m'));
define('MES_ANTERIOR', date('m', strtotime('-1 month')));
define('MES_PROXIMO', date('m', strtotime('+1 month')));

define('ESCOLARIDADE', [
    'Não informado',
    'Fundamental Incompleto',
    'Fundamental Completo',
    'Médio Incompleto',
    'Médio Completo',
    'Superior Incompleto',
    'Superior Completo',
    'Especialização',
    'Mestrado Incompleto',
    'Mestrado Completo',
    'Doutorado Incompleto',
    'Doutorado Completo',
]);

define('ALTERACAO_HISTORICO', [
    1 => 'INÍCIO',
    2 => 'CONTRATO',
    3 => 'CARGO',
    4 => 'MATRÍCULA',
    5 => 'FUNÇÃO',
    6 => 'GRATIFICAÇÃO',
    7 => 'SETOR',
    8 => 'CHEFIA'
]);

define('TIPOS_ANEXO', [
    1 => 'Folha de Ponto',
    2 => 'Faculdade',
    3 => 'Especialização',
    7 => 'Mestrado',
    8 => 'Doutorado',
    9 => 'Outros Cursos',
    10 => 'Referente a Função',
    11 => 'Documentos',
]);

define('UF', [
    'AC' => 'AC',
    'AL' => 'AL',
    'AP' => 'AP',
    'AM' => 'AM',
    'BA' => 'BA',
    'CE' => 'CE',
    'DF' => 'DF',
    'ES' => 'ES',
    'GO' => 'GO',
    'MA' => 'MA',
    'MT' => 'MT',
    'MS' => 'MS',
    'MG' => 'MG',
    'PA' => 'PA',
    'PB' => 'PB',
    'PR' => 'PR',
    'PE' => 'PE',
    'PI' => 'PI',
    'RJ' => 'RJ',
    'RN' => 'RN',
    'RS' => 'RS',
    'RO' => 'RO',
    'RR' => 'RR',
    'SC' => 'SC',
    'SP' => 'SP',
    'SE' => 'SE',
    'TO' => 'TO',
]);


// ________________SELECT____________________
define('SELECT_LISTA_USUARIO_INDEX', [
    'usuarios.id AS idUser',
    'usuarios.nome AS nomeUser',
    'usuarios.cpf',
    'usuarios.senha',
    'usuarios.foto',
    'usuarios.telefone',
    'usuarios.email',
    'usuarios.email2',
    'usuarios.rh',
    'usuarios.data_contratacao',
    'usuarios.chefia',
    'usuarios.escolaridade',
    'usuarios.matricula',
    'setores.nome AS nomeSetor',
    'setores.sigla',
    'contratos.nome AS nomeContrato'
]);

define('SELECT_TIME_LINE', [
    'historicos.id AS idhistorico',
    'historicos.id_usuario AS userHistorico',
    'historicos.contrato',
    'historicos.matricula',
    'historicos.funcao',
    'historicos.gratificacao',
    'historicos.chefia',
    'historicos.data_contratacao',
    'historicos.setor',
    'historicos.anexos',
    'data_rescisao',
    'historicos.alteracao',
    'historicos.cargo',
    'historicos.atual',
    'contratos.nome AS nomeContrato',
    'cargos.nome AS nomeCargo',
    'setores.nome AS nomeSetor',
    'gratificacoes.nome AS nomeGratificacao',
    'anexos.nome AS nomeAnexo',
    'anexos.id_usuario AS userAnexo'
]);
define('SELECT_CONTRATOS', ['contratos.nome AS nomeContrato']);
define('SELECT_CARGOS', '[cargos.nome AS nomeCargo]');
define('SELECT_GRATIFICACOES', ['gratificacoes.nome AS nomeGratificacao']);
define('SELECT_ANEXOS', ['anexos.nome AS nomeAnexo', 'anexos.id_usuario AS userAnexo']);

define('SELECT_USUARIO_SETOR', [
    'usuarios.id AS idUser', 'usuarios.nome AS nomeUser', 'sexo', 'cpf', 'senha', 'foto', 'telefone', 'telefone2', 'email', 'email2',
    'endereco_rua', 'endereco_numero', 'endereco_bairro', 'endereco_complemento', 'endereco_cidade', 'nascimento', 'aniversario',
    'secretaria_origem', 'usuarios.cargo', 'rg_numero', 'rg_orgao_emissor', 'rg_uf', 'oab', 'escolaridade', 'nome_o_classe', 'numero_o_classe',
    'rh', 'setores.nome AS nomeSetor', 'sigla'
]);

define('SELECT_SETORES', ['setores.nome AS nomeSetor', 'sigla']);

define(
    'SELECT_SERVIDOR_DETAIL',
    [
        'usuarios.id AS idUsuario',
        'usuarios.nome AS nomeUsuario',
        'usuarios.sexo',
        'usuarios.foto',
        'usuarios.nascimento',
        'usuarios.cpf',
        'usuarios.rg_numero',
        'usuarios.rg_orgao_emissor',
        'usuarios.rg_uf',
        'usuarios.telefone',
        'usuarios.telefone2',
        'usuarios.email',
        'usuarios.email2',
        'usuarios.endereco_rua',
        'usuarios.endereco_numero',
        'usuarios.endereco_complemento',
        'usuarios.endereco_bairro',
        'usuarios.endereco_cidade',
        'usuarios.nascimento',
        'usuarios.nome_o_classe',
        'usuarios.numero_o_classe',
        'usuarios.escolaridade',
        'usuarios.secretaria_origem',
        'usuarios.funcao',
        'usuarios.chefia',
        'usuarios.anexos',
        'usuarios.matricula',
        'contratos.nome AS nomeContrato',
        'gratificacoes.nome AS nomeGratificacao',
        'cargos.nome AS nomeCargo',
        'setores.nome AS nomeSetor',
        ]
    );
    
    define(
        'SELECT_SERVIDOR_HISTORICOS',
        [
        'historicos.id AS idHistorico',
        'historicos.id_usuario AS userHistorico',
        'historicos.matricula',
        'historicos.funcao',
        'historicos.gratificacao',
        'historicos.chefia',
        'historicos.data_contratacao',
        'historicos.setor',
        'historicos.anexos',
        'historicos.data_rescisao',
        'historicos.tipo',
        'historicos.cargo',
        'historicos.anexos',
        'historicos.status',
        'contratos.nome AS nomeContrato',
        'gratificacoes.nome AS nomeGratificacao',
        'cargos.nome AS nomeCargo',
        'setores.nome AS nomeSetor',
        // 'anexos.nome AS nomeAnexo',
        // 'anexos.anexo AS anexo',
        ]
    );
    
    define('SELECT_FUNCAO_INTERINA',
        [
        'funcao_interina.id',
        'funcao_interina.id_historico',
        'funcao_interina.anexos',
        'funcao_interina.funcao',
        'funcao_interina.chefia',
        'funcao_interina.data_inicio',
        'funcao_interina.data_fim',
        'funcao_interina.observacao',
        'funcao_interina.setor',
        'setores.nome AS nomeSetor'
        ]
    );
    
    // ________________JOIN____________________
    define('JOIN_USUARIO_SETOR', ['setores', 'usuarios.setor', 'setores.id']);
    define('JOIN_USUARIO_ESCOLARIDADE', 'usuarios.escolaridade = escolaridades.id');
    define('JOIN_USUARIO_HISTORICO', 'historicos.id_usuario = usuarios.id');
    define('JOIN_USUARIO_GRATIFICACAO', 'usuarios.gratificacao = gratificacoes.id');
    define('JOIN_USUARIO_CARGO', 'usuarios.cargo = cargos.id');
    define('JOIN_USUARIO_CONTRATO', 'usuarios.contrato = contratos.id');
    define('JOIN_USUARIO_PONTO', 'usuarios.id = folha_ponto.id_user');
    define('JOIN_USUARIO_FERIAS', 'usuarios.id = ferias.id_servidor');

    define('JOIN_HISTORICO_USUARIO', ['usuarios', 'historicos.id_usuario', 'usuarios.id']);
    define('JOIN_HISTORICO_CONTRATO', ['contratos', 'historicos.contrato', 'contratos.id']);
    define('JOIN_HISTORICO_CARGO', ['cargos', 'historicos.cargo', 'cargos.id']);
    define('JOIN_HISTORICO_GRATIFICACAO', ['gratificacoes', 'historicos.gratificacao', 'gratificacoes.id']);
    define('JOIN_HISTORICO_SETOR', ['setores', 'historicos.setor', 'setores.id']);
    define('JOIN_HISTORICO_ANEXO', ['anexos', 'historicos.anexos', 'anexos.id']);

    define('JOIN_FUNCAOINTERINA_SETOR', ['setores', 'funcao_interina.setor', 'setores.id']);