<?php
ob_start();
session_start();

require('../_app/Config.inc.php');
require('../_app/Mobile_Detect.php');

$detect = new Mobile_Detect;
$site = HOME;


$dataLogin = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if(in_array("", $dataLogin)):
	echo "Preencha os Campos Login e Senha!";
else:
	
	$login = new Login(3);
	$login->ExeLogin($dataLogin);
	if (!$login->getResult()):
		echo $login->getError()[0];
	else:
		if($login->CheckLogin()):
			$idusuar = $_SESSION['userlogin']['user_id'];
			$lerbanco->ExeRead('ws_empresa', "WHERE user_id = :idcliente", "idcliente={$idusuar}");
			if (!$lerbanco->getResult()):
				echo "Ocorreu um erro entre em contato conosco!";
			else:
				foreach ($lerbanco->getResult() as $i):
					extract($i);
				endforeach;
				echo "<script>window.location.href = \"{$site}{$nome_empresa_link}/estatisticas\";</script>";
			endif;
		endif;	
	endif;
endif;
ob_end_flush();