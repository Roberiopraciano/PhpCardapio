<?php 
ob_start();
session_start();
require('../_app/Config.inc.php');
require('../_app/Mobile_Detect.php');
$detect = new Mobile_Detect;
$site = HOME;


$getdadoseditadicional = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$getdadoseditadicional['valor_adicional'] = Check::Valor($getdadoseditadicional['valor_adicional']);

$updatebanco->ExeUpdate("ws_adicionais_itens", $getdadoseditadicional, "WHERE user_id = :userid AND id_adicionais = :idadicional", "userid={$getdadoseditadicional['user_id']}&idadicional={$getdadoseditadicional['id_adicionais']}");
if ($updatebanco->getResult()):                                                
	echo "true";       
else:
	echo "false";       
endif;



ob_end_flush();
?>