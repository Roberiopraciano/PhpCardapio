<?php 
ob_start();
session_start();
require('../_app/Config.inc.php');
require('../_app/Mobile_Detect.php');
$detect = new Mobile_Detect;
$site = HOME;


$getdadoseditOptions = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$getdadoseditOptions['valor_option'] = Check::Valor($getdadoseditOptions['valor_option']);

$updatebanco->ExeUpdate("ws_opcoes_itens", $getdadoseditOptions, "WHERE user_id = :userid AND (id_option = :idoption AND id_item = :iditem)", "userid={$getdadoseditOptions['user_id']}&idoption={$getdadoseditOptions['id_option']}&iditem={$getdadoseditOptions['id_item']}");
if ($updatebanco->getResult()):                                                
	echo "true";       
else:
	echo "false";       
endif;



ob_end_flush();
?>