<?php 
ob_start();
session_start();
require('../_app/Config.inc.php');
require('../_app/Mobile_Detect.php');
$detect = new Mobile_Detect;
$site = HOME;

$getdadosdeletarOptions = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$deletbanco->ExeDelete("ws_opcoes_itens", "WHERE user_id = :userid AND id_option = :idoption", "userid={$getdadosdeletarOptions['user_id']}&idoption={$getdadosdeletarOptions['id_tamanho']}");
if($deletbanco->getResult()):
	echo "true";
else:
	echo "false";
endif;

ob_end_flush();
?>