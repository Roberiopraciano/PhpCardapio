<?php 
ob_start();
session_start();
require('../_app/Config.inc.php');
require('../_app/Mobile_Detect.php');
$detect = new Mobile_Detect;
$site = HOME;


$getdadoseditadicional = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$getdadoseditadicional['valor'] = strip_tags(trim($getdadoseditadicional['valor']));

$arraycomvalor = array();
$arraycomvalor['number_adicional'] = $getdadoseditadicional['valor'];


$updatebanco->ExeUpdate("ws_itens", $arraycomvalor, "WHERE user_id = :userid AND id = :iditem", "userid={$getdadoseditadicional['iduser']}&iditem={$getdadoseditadicional['idproduto']}");
if($updatebanco->getResult()):                                                
	echo "true";       
else:
	echo "false";       
endif;



ob_end_flush();
?>