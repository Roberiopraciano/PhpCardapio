<?php
ob_start();
session_start();
require('../../_app/Config.inc.php');
require('../../_app/Mobile_Detect.php');
$detect = new Mobile_Detect;
$site = HOME;


$getexcluircliente = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if(!empty($getexcluircliente)):
	
	$lerbanco->FullRead("SELECT * FROM ws_users WHERE user_id = :userid", "userid={$getexcluircliente['idcliente']}");
	if(!$lerbanco->getResult()):
		echo "0";
	else:

		if($getexcluircliente['idcliente'] == 1):
		else:

			$deletbanco->ExeDelete("bairros_delivery", "WHERE user_id = :userid", "userid={$getexcluircliente['idcliente']}");

			$deletbanco->ExeDelete("cupom_desconto", "WHERE user_id = :userid", "userid={$getexcluircliente['idcliente']}");

			$deletbanco->ExeDelete("views", "WHERE user_id = :userid", "userid={$getexcluircliente['idcliente']}");

			$deletbanco->ExeDelete("ws_adicionais_itens", "WHERE user_id = :userid", "userid={$getexcluircliente['idcliente']}");

			$deletbanco->ExeDelete("ws_cat", "WHERE user_id = :userid", "userid={$getexcluircliente['idcliente']}");

			$deletbanco->ExeDelete("ws_datas_close", "WHERE user_id = :userid", "userid={$getexcluircliente['idcliente']}");

			$deletbanco->ExeDelete("ws_empresa", "WHERE user_id = :userid", "userid={$getexcluircliente['idcliente']}");

			$deletbanco->ExeDelete("ws_formas_pagamento", "WHERE user_id = :userid", "userid={$getexcluircliente['idcliente']}");

			$deletbanco->ExeDelete("ws_itens", "WHERE user_id = :userid", "userid={$getexcluircliente['idcliente']}");

			$deletbanco->ExeDelete("ws_opcoes_itens", "WHERE user_id = :userid", "userid={$getexcluircliente['idcliente']}");

			$deletbanco->ExeDelete("ws_pedidos", "WHERE user_id = :userid", "userid={$getexcluircliente['idcliente']}");

			$deletbanco->ExeDelete("ws_pedidos_itens", "WHERE USER_ID = :userid", "userid={$getexcluircliente['idcliente']}");

			$deletbanco->ExeDelete("ws_relacao_tamanho", "WHERE id_user = :userid", "userid={$getexcluircliente['idcliente']}");

			$deletbanco->ExeDelete("ws_tipo_produto", "WHERE user_tipo_produto = :userid", "userid={$getexcluircliente['idcliente']}");

			$deletbanco->ExeDelete("ws_users", "WHERE user_id = :userid", "userid={$getexcluircliente['idcliente']}");

		endif;


		echo "1";

	endif;
endif;













ob_end_flush();
?>