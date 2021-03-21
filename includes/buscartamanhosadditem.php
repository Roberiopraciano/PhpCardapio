<?php 
ob_start();
session_start();
require('../_app/Config.inc.php');
require('../_app/Mobile_Detect.php');
$detect = new Mobile_Detect;
$site = HOME;


$getdadosmostrartamanhos = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if(!empty($getdadosmostrartamanhos)):

	$lerbanco->FullRead("SELECT * FROM ws_opcoes_itens WHERE user_id = :userid AND id_tipo = :idtipo ORDER BY id_option DESC", "userid={$getdadosmostrartamanhos['user_id']}&idtipo={$getdadosmostrartamanhos['tipo_id']}");

	if(!$lerbanco->getResult()):
		echo "<br /><b style='color: red;'>AINDA NÃO EXISTEM OPÇÕES DE TAMANHO PARA ESSE TIPO DE PRODUTO</b><br />";
	else:
		echo "<br />";
		foreach ($lerbanco->getResult() as $extrairtamanhos):
			extract($extrairtamanhos);
			$valor_tamanho = Check::Real($valor_tamanho);
			$valordotamanho = ($meio_a_meio == "true" ? "" : " - R$ {$valor_tamanho}");
		echo "
		<div class=\"icheck-material-green icheck-inline\">
		<input type=\"checkbox\" id=\"tamanho_{$id_option}\" value=\"{$id_option}\" name=\"tamanhos[]\" />
		<label for=\"tamanho_{$id_option}\">{$nome_option}{$valordotamanho}</label>
		</div>
		";
	endforeach;
		
	endif;

endif;



ob_end_flush();
?>