<?php
ob_start();
session_start();
require('../_app/Config.inc.php');
$site = HOME;

$getCupom = $_POST['codigodocupom'];
$userid   = $_POST['user_id'];

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

			//CRIA A ATIVAÇÃO DO CUPOM ATRAVES DA SESSION
			$_SESSION['desconto_cupom'] = $getdbcupom[0]['porcentagem'];

			// CRIA A VALIDAÇÃO DO POP UP VIA COOCKIE
			setcookie("popupcupom", '1', time() + (86400 * 30)); // 86400 = 1 dia

			//MANDA EXIBIR A MENSAGEM DE ATIVAÇÃO
			echo "true";						


		endif;

	endif;
else:
	echo "erro0";
endif;


ob_end_flush();