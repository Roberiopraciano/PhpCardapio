<?php 
ob_start();
session_start();
require('../_app/Config.inc.php');
require('../_app/Mobile_Detect.php');
$detect = new Mobile_Detect;
$site = HOME;

$getdadosdeletarOptions = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if(!empty($getdadosdeletarOptions)):

	if(empty($getdadosdeletarOptions['edit_nome_option']) || $getdadosdeletarOptions['edit_nome_option'] == "" || empty($getdadosdeletarOptions['edit_valor_tamanho'])):
		echo "erro1";
	else:	

		$getdadosdeletarOptions['edit_nome_option'] = strip_tags(trim($getdadosdeletarOptions['edit_nome_option']));
		$getdadosdeletarOptions['edit_valor_tamanho'] = strip_tags(trim($getdadosdeletarOptions['edit_valor_tamanho']));
		$getdadosdeletarOptions['edit_valor_tamanho'] = Check::Valor($getdadosdeletarOptions['edit_valor_tamanho']);


		$novosdadostamanho = array();
		$novosdadostamanho['nome_option'] = $getdadosdeletarOptions['edit_nome_option'];
		$novosdadostamanho['valor_tamanho'] = $getdadosdeletarOptions['edit_valor_tamanho'];

		if(!empty($getdadosdeletarOptions['edit_meio_a_meio']) && $getdadosdeletarOptions['edit_meio_a_meio'] == 'true' && !empty($getdadosdeletarOptions['edit_total_qtd_itens'])):

			$novosdadostamanho['meio_a_meio'] = 'true';
		$novosdadostamanho['total_qtd_itens'] = (int) $getdadosdeletarOptions['edit_total_qtd_itens'];

	else:
		$novosdadostamanho['meio_a_meio'] = 'null';
		$novosdadostamanho['total_qtd_itens'] = 'null';
	endif;
	$novosdadostamanho['meio_a_meio_tipo'] = $getdadosdeletarOptions['meio_a_meio_tipo'];

	$updatebanco->ExeUpdate("ws_opcoes_itens", $novosdadostamanho, "WHERE user_id = :userid AND id_option = :upp", "userid={$getdadosdeletarOptions['user_id']}&upp={$getdadosdeletarOptions['id_option']}");
	if ($updatebanco->getResult()): 
		echo "true";
	else:
		echo "false";
	endif;

	
endif;
endif;

ob_end_flush();
?>