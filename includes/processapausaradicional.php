<?php 
ob_start();
session_start();
require('../_app/Config.inc.php');
require('../_app/Mobile_Detect.php');
$detect = new Mobile_Detect;
$site = HOME;

$getdadospauseAdicional = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$lerbanco->ExeRead("ws_adicionais_itens", "WHERE user_id = :userid AND id_adicionais = :idadicional", "userid={$getdadospauseAdicional['user_id']}&idadicional={$getdadospauseAdicional['id_adicionais']}");
if(!$lerbanco->getResult()):
	echo "false 1";
else:
	$dadosgetadicional = $lerbanco->getResult();

	$getdadospauseAd['status_adicional'] = ($dadosgetadicional[0]['status_adicional'] == 1 ? 0 : 1);

	$updatebanco->ExeUpdate("ws_adicionais_itens", $getdadospauseAd, "WHERE user_id = :userid AND id_adicionais = :idadicional", "userid={$getdadospauseAdicional['user_id']}&idadicional={$getdadospauseAdicional['id_adicionais']}");

	if($updatebanco->getResult()):                                                
		echo "true";       
	else:
		echo "false 2";       
	endif;

endif;

ob_end_flush();
?>