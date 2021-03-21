<?php
ob_start();
session_start();
require('../_app/Config.inc.php');
require('../_app/Mobile_Detect.php');
$site = HOME;

$getdadosGetOptions = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$lerbanco->ExeRead("ws_opcoes_itens", "WHERE id_option = :idoption AND user_id = :userid", "idoption={$getdadosGetOptions['idoption']}&userid={$getdadosGetOptions['userid']}");
if($lerbanco->getResult()):
	$resultadodapesquisaarray = $lerbanco->getResult();



if($resultadodapesquisaarray[0]['meio_a_meio'] == 'true' && $resultadodapesquisaarray[0]['total_qtd_itens'] != 'null'):

	echo $resultadodapesquisaarray[0]['meio_a_meio_tipo'];

	endif;
endif;
?>

<?php
ob_end_flush();
?>