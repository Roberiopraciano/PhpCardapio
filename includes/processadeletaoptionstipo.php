<?php 
ob_start();
session_start();
require('../_app/Config.inc.php');
require('../_app/Mobile_Detect.php');
$detect = new Mobile_Detect;
$site = HOME;

$getdadosdeletarOptions = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$deletbanco->ExeDelete("ws_tipo_produto", "WHERE user_tipo_produto = :useridum AND id_tipo_produto = :idtipo", "useridum={$getdadosdeletarOptions['user_id']}&idtipo={$getdadosdeletarOptions['id_tipo']}");
if(!$deletbanco->getResult()):
	echo "false";
else:
	// deleta todos os tamanhos associados
	$deletbanco->ExeDelete("ws_opcoes_itens", "WHERE user_id = :userid AND id_tipo = :iddotipo", "userid={$getdadosdeletarOptions['user_id']}&iddotipo={$getdadosdeletarOptions['id_tipo']}");
	if($deletbanco->getResult()):
		echo "true";
	else:
		echo "false";
	endif;
// deleta todos os tamanhos associados
endif;

ob_end_flush();
?>