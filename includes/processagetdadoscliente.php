<?php 
require('../_app/Config.inc.php');
$site = HOME;

$getuu = $_POST['iduser'];

$lerbanco->ExeRead('ws_empresa', "WHERE user_id = :femp", "femp={$getuu}");
if (!$lerbanco->getResult()):
else:
	foreach ($lerbanco->getResult() as $i):
		extract($i);
	endforeach;
endif;

$BuscarCliente = $_POST['numerocliente'];

$lerbanco->ExeRead('ws_pedidos', "WHERE user_id = :getuser and (telefone = :t and opcao_delivery = :tr)", "getuser={$getuu}&t={$BuscarCliente}&tr=true");
if($lerbanco->getResult()):
	foreach($lerbanco->getResult() as $i):
		extract($i);
	endforeach;

	$complemento1 = ($complemento == '*Não informado*' ? '' : $complemento);
	$observacao1  = ($observacao == '*Não informado*' ? '' : $observacao);
	$nome = str_replace('%20', ' ', $nome);

	$lerbanco->ExeRead('bairros_delivery');
	if(!$lerbanco->getResult()):
		echo "
		<script type=\"text/javascript\">
		$('#nome').val('{$nome}');
		$('#rua').val('{$rua}');
		$('#unidade').val('{$unidade}');
		$('#cidade').val('{$cidade_empresa}');
		$('#uf').val('{$end_uf_empresa}');
		$('#complemento').val('{$complemento1}');
		$('#observacao').val('{$observacao1}');
		$('#bairro').val('{$bairro}');
		</script>
		";
	else:
		echo "
		<script type=\"text/javascript\">
		$('#nome').val('{$nome}');
		$('#rua').val('{$rua}');
		$('#unidade').val('{$unidade}');
		$('#cidade').val('{$cidade}');
		$('#uf').val('{$uf}');
		$('#complemento').val('{$complemento1}');
		$('#observacao').val('{$observacao1}');
		</script>
		";
	endif;
endif;
?>
