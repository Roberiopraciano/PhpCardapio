<?php
require 'funcoes.php';


// CONFIGRAÇÕES DO BANCO DE DADOS ####################
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DBSA', 'delivery');

// DEFINE SERVIDOR DE E-MAIL PARA RECEBER NOTIFICAÇÃO VIA E-MAIL ################
define('MAILUSER', ''); // email: exemplo contato@pedido.top
define('MAILPASS', ''); // Senha do email
define('MAILPORT', '465'); // exemplo: 465
define('MAILHOST', '');  // exemplo: mail.pedido.top

// DEFINE IDENTIDADE DO SITE ################


// DEFINE A BASE DO SITE ####################
define('HOME', 'http://localhost/script-delivery/'); // SEMPRE COM A BARRA NA FRENTE ---- ---- ---- ----
date_default_timezone_set('America/Sao_Paulo');


// DEFINE HTACCESS PARA URLS AMIGÁVEIS ####################

$getUrl = strip_tags(trim(filter_input(INPUT_GET, 'url', FILTER_DEFAULT)));
$setUrl = (empty($getUrl) ? 'index' : $getUrl);
$Url    = explode('/', $setUrl);

// AUTO LOAD DE CLASSES ####################
function __autoload($Class)
{

    $cDir = ['Conn', 'Helpers', 'Models'];
    $iDir = null;

    foreach ($cDir as $dirName) :
        if (!$iDir && file_exists(__DIR__ . DIRECTORY_SEPARATOR . $dirName . DIRECTORY_SEPARATOR . $Class . '.class.php') && !is_dir(__DIR__ . DIRECTORY_SEPARATOR . $dirName . DIRECTORY_SEPARATOR . $Class . '.class.php')) :
            include_once(__DIR__ . DIRECTORY_SEPARATOR . $dirName . DIRECTORY_SEPARATOR . $Class . '.class.php');
            $iDir = true;
        endif;
    endforeach;

    if (!$iDir) :
        trigger_error("Não foi possível incluir {$Class}.class.php", E_USER_ERROR);
        die;
    endif;
}
// TRATAMENTO TELEFONE #####################
function formatPhone($phone)
{
    $formatedPhone = preg_replace('/[^0-9]/', '', $phone);
    $matches = [];
    preg_match('/^([0-9]{2})([0-9]{4,5})([0-9]{4})$/', $formatedPhone, $matches);
    if ($matches) {
        return '(' . $matches[1] . ') ' . $matches[2] . '-' . $matches[3];
    }

    return $phone; // Retornao numero formatado
}

// TRATAMENTO DE ERROS #####################
//CSS constantes :: Mensagens de Erro
define('WS_ACCEPT', 'accept');
define('WS_INFOR', 'infor');
define('WS_ALERT', 'alert');
define('WS_ERROR', 'error');

//WSErro :: Exibe erros lançados :: Front
function WSErro($ErrMsg, $ErrNo, $ErrDie = null)
{
    $CssClass = ($ErrNo == E_USER_NOTICE ? WS_INFOR : ($ErrNo == E_USER_WARNING ? WS_ALERT : ($ErrNo == E_USER_ERROR ? WS_ERROR : $ErrNo)));
    echo "<p class=\"trigger {$CssClass}\">{$ErrMsg}<span class=\"ajax_close\"></span></p>";

    if ($ErrDie) :
        die;
    endif;
}

//PHPErro :: personaliza o gatilho do PHP
function PHPErro($ErrNo, $ErrMsg, $ErrFile, $ErrLine)
{
    $CssClass = ($ErrNo == E_USER_NOTICE ? WS_INFOR : ($ErrNo == E_USER_WARNING ? WS_ALERT : ($ErrNo == E_USER_ERROR ? WS_ERROR : $ErrNo)));
    echo "<p class=\"trigger {$CssClass}\">";
    echo "<b>Erro na Linha: #{$ErrLine} ::</b> {$ErrMsg}<br>";
    echo "<small>{$ErrFile}</small>";
    echo "<span class=\"ajax_close\"></span></p>";

    if ($ErrNo == E_USER_ERROR) :
        die;
    endif;
}

set_error_handler('PHPErro');

$lerbanco    = new Read;
$updatebanco = new Update;
$addbanco    = new Create;
$deletbanco  = new Delete;


//require('Library/PHPMailer/PHPMailerAutoload.php');

$lerbanco->ExeRead("configuracoes_site");
if ($lerbanco->getResult()) :
    $getEmpresa = $lerbanco->getResult();
endif;

require 'textos.config.php';
