<?php
require('../_app/Config.inc.php');
$site = HOME;

$getId = $_POST['iditem'];
$iduser = $_POST['iduser'];

$lerbanco->ExeRead('ws_itens', "WHERE user_id = :userid AND id = :f", "userid={$iduser}&f={$getId}");
if($lerbanco->getResult()):
	foreach($lerbanco->getResult() as $i):
		extract($i);
	endforeach;

	$novoStatus = array();

	 if($disponivel == 0):
	 	$novoStatus['disponivel'] = 1;
	 else:
	 	$novoStatus['disponivel'] = 0;
	 endif;

	 $updatebanco->ExeUpdate("ws_itens", $novoStatus, "WHERE user_id = :userid AND id = :upp", "userid={$iduser}&upp={$getId}");
endif;
