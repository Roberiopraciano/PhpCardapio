<?php 
require('../_app/Config.inc.php');
$site = HOME;

$inputCupom = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if(!empty($inputCupom['submitcupomconfirm'])):
	unset($inputCupom['submitcupomconfirm']);

	$inputCupom = array_map('strip_tags', $inputCupom);
	$inputCupom = array_map('trim', $inputCupom); 

	$inputCupom['data_validade'] = explode("/", $inputCupom['data_validade']);
	$inputCupom['data_validade'] = array_reverse($inputCupom['data_validade']);
	$inputCupom['data_validade'] = implode("-",  $inputCupom['data_validade']);


	if($inputCupom['porcentagem'] == ''):
		(int) $inputCupom['porcentagem'] = 1;
	elseif((int) $inputCupom['porcentagem'] < 1):
		$inputCupom['porcentagem'] = 1;
	elseif((int) $inputCupom['porcentagem'] > 100):
		$inputCupom['porcentagem'] = 100;
	else: 
		$inputCupom['porcentagem'] = str_replace('.', '', $inputCupom['porcentagem']);
		$inputCupom['porcentagem'] = str_replace(',', '', $inputCupom['porcentagem']);
		$inputCupom['porcentagem'] = (int) $inputCupom['porcentagem'];    
	endif;

	if($inputCupom['total_vezes'] == ''):
		(int) $inputCupom['total_vezes'] = 1;            
	else: 
		$inputCupom['total_vezes'] = str_replace('.', '', $inputCupom['total_vezes']);
		$inputCupom['total_vezes'] = str_replace(',', '', $inputCupom['total_vezes']);
		$inputCupom['total_vezes'] = (int) $inputCupom['total_vezes'];    
	endif;

	if (in_array('', $inputCupom) || in_array('null', $inputCupom)):
		echo "<div class=\"alert alert-info alert-dismissable\">
	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
	Preencha todos os campos!
	</div>";
elseif(!isDateExpired($inputCupom['data_validade'], 1)):
	echo "<div class=\"alert alert-info alert-dismissable\">
	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
	A data informada já expirou!
	</div>";
else:

	
	$lerbanco->ExeRead('cupom_desconto', "WHERE user_id = :userid AND ativacao = :pativacao", "userid={$inputCupom['user_id']}&pativacao={$inputCupom['ativacao']}");
	if ($lerbanco->getResult()):
		echo "<div class=\"alert alert-info alert-dismissable\">
		<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
		Já existe um cupom com essa ativação! exclua e crie outra com novas propriedades.
		</div>";
	else:
		$urlsite = $inputCupom['lojaurl'];
		unset($inputCupom['lojaurl']);
		
		$addbanco->ExeCreate("cupom_desconto", $inputCupom);
		if ($addbanco->getResult()):                                                
			echo "<div class=\"alert alert-success alert-dismissable\">
			<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
			<b class=\"alert-link\">SUCESSO!</b> Cupom cadastrado.
			</div>";      
			echo "<script>setTimeout(function() {
				window.location.replace('{$site}{$urlsite}/cupom-desconto');
			}, 2000);</script>"; 
		else:
			echo "<div class=\"alert alert-danger alert-dismissable\">
			<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
			<b class=\"alert-link\">OCORREU UM ERRO!</b> Tente novamente.
			</div>";         
		endif;
	endif;


	
endif;



endif;

