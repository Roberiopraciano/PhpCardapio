<?php 
ob_start();
session_start();
require('../_app/Config.inc.php');
require('../_app/Mobile_Detect.php');
$detect = new Mobile_Detect;
$site = HOME;


$getdadosAddOptions = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if(!empty($getdadosAddOptions['meio_a_meio']) && $getdadosAddOptions['meio_a_meio'] == 'true'):
else:
	$getdadosAddOptions['meio_a_meio'] = 'null';
	$getdadosAddOptions['total_qtd_itens'] = 'null';
endif;

$getdadosAddOptions['nome_option'] = trim(strip_tags($getdadosAddOptions['nome_option']));
$getdadosAddOptions['valor_tamanho'] = trim(strip_tags($getdadosAddOptions['valor_tamanho']));
$getdadosAddOptions['valor_tamanho'] = Check::Valor($getdadosAddOptions['valor_tamanho']);


$addbanco->ExeCreate("ws_opcoes_itens", $getdadosAddOptions);
if($addbanco->getResult()):                                                
	echo "true";         
else:
	echo "false";         
endif;


ob_end_flush();