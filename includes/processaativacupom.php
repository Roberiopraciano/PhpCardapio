<?php
ob_start();
session_start();
require('../_app/Config.inc.php');
$site = HOME;

$getCupom = $_POST['codigocupom'];
$userid   = $_POST['iduser'];

$lerbanco->ExeRead("cupom_desconto", "WHERE user_id = :iduser AND ativacao = :ativacupom", "iduser={$userid}&ativacupom={$getCupom}");
if($lerbanco->getResult()):
	$getdbcupom = $lerbanco->getResult();

	if($getdbcupom[0]['total_vezes'] <= 0):
		echo "erro1";
	elseif(!isDateExpired($getdbcupom[0]['data_validade'], 1)):
		echo "erro2";
	elseif(!empty($_SESSION['desconto_cupom'])):
		echo "erro4";
	else:

		$subtraicupom = array();
		$subtraicupom['total_vezes'] = $getdbcupom[0]['total_vezes'] - 1;
		$updatebanco->ExeUpdate("cupom_desconto", $subtraicupom, "WHERE user_id = :userid AND ativacao = :upp", "userid={$userid}&upp={$getCupom}");
		if(!$updatebanco->getResult()): 
			echo "erro3";
		else:
			$_SESSION['desconto_cupom'] = array();
			$_SESSION['desconto_cupom']['desconto'] = $getdbcupom[0]['porcentagem'];
			$_SESSION['desconto_cupom']['user_id']  = $userid;
			echo "true";						
			
			
		endif;
		
	endif;
else:
	echo "erro0";
endif;


ob_end_flush();