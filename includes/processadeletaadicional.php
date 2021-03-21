<?php 
ob_start();
session_start();
require('../_app/Config.inc.php');
require('../_app/Mobile_Detect.php');
$detect = new Mobile_Detect;
$site = HOME;

$getdadosdeletarAdicional = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$deletbanco->ExeDelete("ws_adicionais_itens", "WHERE user_id = :userid AND id_adicionais = :idadicional", "userid={$getdadosdeletarAdicional['user_id']}&idadicional={$getdadosdeletarAdicional['id_adicionais']}");
if($deletbanco->getResult()):
	echo "true";
else:
	echo "false";
endif;

ob_end_flush();
?>