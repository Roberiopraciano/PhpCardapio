<?php
ob_start();
session_start();
require('../_app/Config.inc.php');
require('../_app/Mobile_Detect.php');
$detect = new Mobile_Detect;
$site = HOME;
$getu = $_POST['user_id'];

$lerbanco->ExeRead('ws_empresa', "WHERE user_id = :f", "f={$getu}");
if (!$lerbanco->getResult()):
else:
	foreach ($lerbanco->getResult() as $i):
		extract($i);
	endforeach;
endif;


$cart = new Cart([
	//Total de item que pode ser adicionado ao carrinho 0 = Ilimitado
	'cartMaxItem' => 0,

	// A quantidade máxima de um item que pode ser adicionada ao carrinho, 0 = Ilimitado
	'itemMaxQuantity' => 0,

	// Não usar cookies, os itens do carrinho desaparecerão depois que o navegador for fechado
	'useCookie' => false,
]);

$bairrosstatus = 'false';
$pedidos = '';

$allItems = $cart->getItems();
foreach ($allItems as $items) {
	foreach ($items as $item) {
		if(!empty($item['attributes']['totalAdicionais'])):
			$todosOsAdicionais = '';
			$todosOsAdicionaisSoma = 0;
			for($i=0; $i < $item['attributes']['totalAdicionais']; $i++):
				$todosOsAdicionais = $todosOsAdicionais.$item['attributes']['adicional_nome'.$i].', ';
				$todosOsAdicionaisSoma = ($todosOsAdicionaisSoma + $item['attributes']['adicional_valor'.$i]);
			endfor;
		endif;							

		$pedidos = $pedidos.'<b>'.$texto['msg_qtd'].'</b> '
		.$item['quantity'].'x '
		.$item['attributes']['nome']
		.'<br /><b>'.$texto['msg_adicionais'].'</b> '.
		(!empty($item['attributes']['totalAdicionais']) ? $todosOsAdicionais : $texto['msg_sem_adicionais'])
		.'<br />'

		.'<b>'.$texto['msg_valor'].'</b> R$ '.Check::Real(($item['attributes']['preco'] * $item['quantity']) + (!empty($item['attributes']['totalAdicionais']) ? ($todosOsAdicionaisSoma * $item['quantity']) : 0) )
		.'<br /><b>OBS:</b> '.$item['attributes']['observacao']

		.'<br /><br />';
	}
}

function tirarAcentos($string){
	$formato = array();
	$formato['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr';
	$formato['b'] = 'AAAAAAAcEEEEIIIIDNOOOOOOUUUUuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
	$string = strtr(utf8_decode($string), utf8_decode($formato['a']), $formato['b']);

	return utf8_encode($string);
}


$get_dados_pedido = filter_input_array(INPUT_POST, FILTER_DEFAULT);


if(!empty($get_dados_pedido['confirm_whatsapp']) && $get_dados_pedido['confirm_whatsapp'] == 'true'):
	$get_dados_pedido['confirm_whatsapp'] = $get_dados_pedido['confirm_whatsapp'];
else:
	$get_dados_pedido['confirm_whatsapp'] = 'false';
endif;

if(isset($get_dados_pedido['enviar_pedido']) && $get_dados_pedido['enviar_pedido'] == 'enviar_agora'):
	unset($get_dados_pedido['enviar_pedido']);

		// LIMPA OS CAMPOS RETIRANDO TAGS E ESPAÇOS DESNECESSÁRIOS
	$get_dados_pedido = array_map('strip_tags', $get_dados_pedido);
	$get_dados_pedido = array_map('trim', $get_dados_pedido);

	$get_dados_pedido['complemento'] = (empty($get_dados_pedido['complemento']) ? '*Não informado*' : $get_dados_pedido['complemento']);
	$get_dados_pedido['observacao'] = (empty($get_dados_pedido['observacao']) ? '*Não informado*' : $get_dados_pedido['observacao']);

	$get_dados_pedido['telefone']    = preg_replace("/[^0-9]/", "", $get_dados_pedido['telefone']);

	if(in_array('', $get_dados_pedido) || in_array('null', $get_dados_pedido)):
		echo "<script>
	x0p('', 
	'Opss... {$texto['msg_msg_camposVazios']}',
	'error', false);

	var sound = new Howl({
		src: ['{$site}ops.mp3'],
		volume: 1.0,
		autoplay: true,
		});
		sound.play();
		</script>";
	elseif(strlen($get_dados_pedido['telefone']) < 11):
		echo "<script>
		x0p('', 
		'Opss... O numero de telefone informado e inválido!',
		'error', false);

		var sound = new Howl({
			src: ['{$site}ops.mp3'],
			volume: 1.0,
			autoplay: true,
			});
			sound.play();
			</script>";
		else:
			$moeda = "R$";
			$mes = date("m");
			$ano = date("y");
			$cont = 1;

			$lerbanco->ExeRead('ws_pedidos', "WHERE user_id = :usergeid AND (mes = :fmes AND ano = :fano)", "usergeid={$getu}&fmes={$mes}&fano={$ano}");
			if (!$lerbanco->getResult()):
				$get_dados_pedido['codigo_pedido'] = 'PED'.$mes.$ano.'-'.$cont;
			else:
				$get_dados_pedido['codigo_pedido'] = 'PED'.$mes.$ano.'-'.($cont + $lerbanco->getRowCount());
			endif;

			$get_dados_pedido['resumo_pedidos']   = $pedidos;

			$get_dados_pedido['mes']   = $mes;
			$get_dados_pedido['ano']   = $ano;
			$get_dados_pedido['resumo_pedidos']   = $pedidos;
			$get_dados_pedido['data']             = date('d/m/Y');
			$get_dados_pedido['data_chart']       = date('Y-m');
			$get_dados_pedido['data_chart2']      = date('Y-m-d');
			$get_dados_pedido['status']           = 'Aberto';
			$get_dados_pedido['nome']           = $get_dados_pedido['nome'];
			$get_dados_pedido['telefone_empresa'] = (!empty($telefone_empresa) ? $telefone_empresa : '');

		// Get all items in the cart

			$allItems = $cart->getItems();

			$get_dados_pedido['adicionais'] = 0;

			foreach ($allItems as $items):

				foreach ($items as $item):

					$todosOsAdicionaisSoma2 = 0;
					if(!empty($item['attributes']['totalAdicionais'])):

						for($i=0; $i < $item['attributes']['totalAdicionais']; $i++):
							$todosOsAdicionaisSoma2 = ($todosOsAdicionaisSoma2 + $item['attributes']['adicional_valor'.$i]);
						endfor;
						$todosOsAdicionaisSoma2 = ($todosOsAdicionaisSoma2 * $item['quantity']);
					endif;

					$get_dados_pedido['adicionais'] = $get_dados_pedido['adicionais'] + $todosOsAdicionaisSoma2;


				endforeach;
			endforeach;

			$dados_total_com_add = $cart->getAttributeTotal('preco') + $get_dados_pedido['adicionais'];

			if(!empty($_SESSION['desconto_cupom']) && $_SESSION['desconto_cupom']['user_id'] == $getu):
				$dados_total_com_add = ($dados_total_com_add - Check::porcentagem($_SESSION['desconto_cupom']['desconto'], $dados_total_com_add));
			endif;

			$valor_do_delivery0 = '';
			if($config_delivery_free == '0.00' && $get_dados_pedido['opcao_delivery'] == 'true'): 
				$valor_do_delivery0 = $config_delivery; 
			elseif($get_dados_pedido['opcao_delivery'] == 'true' && $config_delivery_free != '0.00' && $dados_total_com_add < $config_delivery_free):
				$valor_do_delivery0 = $config_delivery;  
			else: 
				$valor_do_delivery0 = '0.00';
			endif;

			$get_dados_pedido['total'] = $dados_total_com_add + $get_dados_pedido['valor_taxa'];

			$valorDaTaxa = Check::Real($get_dados_pedido['valor_taxa']);
			$msgSedelivery = ($get_dados_pedido['opcao_delivery'] == 'true' ? "*{$texto['msg_cart_delivery']}:* r$ {$valorDaTaxa}<br />" : '');


			$get_dados_pedido['total'] = Check::Real($get_dados_pedido['total']);
			$get_dados_pedido['nome'] = strip_tags(trim($get_dados_pedido['nome']));


			$get_dados_pedido['nome'] = str_replace(' ', '%20', $get_dados_pedido['nome']);
			$get_dados_pedido['nome'] = ucfirst ($get_dados_pedido['nome']);

			$inicio_texto = "Segue o pedido<br /><br />*{$get_dados_pedido['codigo_pedido']}*<br /><br />Nome: *{$get_dados_pedido['nome']}*<br /><br />Pedido:<br />";

			$enviarPedidos = str_replace('<br />', '%0A', $get_dados_pedido['resumo_pedidos']);
			$enviarPedidos = str_replace('<b>', '*', $enviarPedidos);
			$enviarPedidos = str_replace('</b>', '*', $enviarPedidos);
			$enviarPedidos = str_replace(' ', '%20', $enviarPedidos);




			$enviarPedidos = str_replace('r$', 'R$', $enviarPedidos);
			$enviarPedidos = str_replace('qtd', 'Qtd', $enviarPedidos);
			$enviarPedidos = str_replace('adicionais', 'Adicionais', $enviarPedidos);
			$enviarPedidos = str_replace('valor', 'Valor', $enviarPedidos);
		//$enviarPedidos = str_replace('Qtd:', '%0AQtd:', $enviarPedidos);

			if($get_dados_pedido['opcao_delivery'] != 'false'):								

				$bairrolink = (!empty($get_dados_pedido['bairro2']) ? $get_dados_pedido['bairro2'] : $get_dados_pedido['bairro']);
				$get_dados_pedido['bairro'] = (!empty($get_dados_pedido['bairro2']) ? $get_dados_pedido['bairro2'] : $get_dados_pedido['bairro']);
			endif;


			if($get_dados_pedido['opcao_delivery'] == 'true'):
				$terceira_parte_pedido = "*Endereço:*<br />Rua: {$get_dados_pedido['rua']}, Nº: {$get_dados_pedido['unidade']},<br />Bairro: {$bairrolink},<br />Cidade: {$get_dados_pedido['cidade']}, {$get_dados_pedido['uf']},<br />Complemento:<br />{$get_dados_pedido['complemento']}<br />OBS: {$get_dados_pedido['observacao']}<br /><br />";

			elseif(!empty($get_dados_pedido['mesa']) && !empty($get_dados_pedido['pessoas'])):

				$terceira_parte_pedido = "*Nº da mesa:* {$get_dados_pedido['mesa']}<br />*Pessoas:* {$get_dados_pedido['pessoas']}<br /><br />";
			$get_dados_pedido['msg_delivery_false'] = "Mesa: {$get_dados_pedido['mesa']}<br />Pessoas: {$get_dados_pedido['pessoas']}";			
		else:
			$terceira_parte_pedido = "*Vou Buscar no local*<br /><br />";
			$get_dados_pedido['msg_delivery_false'] = "Retirada no Balcão";
		endif;


		$terceira_parte_pedido = str_replace('<br />', '%0A', $terceira_parte_pedido);
		$terceira_parte_pedido = str_replace(' ', '%20', $terceira_parte_pedido);
		$terceira_parte_pedido = str_replace('endereco', 'Endereco', $terceira_parte_pedido);


		if(empty($get_dados_pedido['valor_troco'])):
			$get_dados_pedido['valor_troco'] = '0,00';
		endif;

		$porcentagemg = '';
		if(!empty($_SESSION['desconto_cupom']) && $_SESSION['desconto_cupom']['user_id'] == $getu):
			$porcentagemg = "*Desconto:* {$_SESSION['desconto_cupom']['desconto']}%<br />";
		endif;		


		if(!empty($get_dados_pedido['mesa']) && !empty($get_dados_pedido['pessoas'])):
			$quarta_parte_pedido = "{$porcentagemg}*Observações:* <br /> {$get_dados_pedido['name_observacao_mesa']}<br /><br />*{$get_dados_pedido['data']}*";
		$quarta_parte_pedido = str_replace('<br />', '%0A', $quarta_parte_pedido);
	elseif(!empty($get_dados_pedido['forma_pagamento'])):

		$quarta_parte_pedido = "*Pagamento:* {$get_dados_pedido['forma_pagamento']}<br />*SubTotal* R$ ".Check::Real($get_dados_pedido['sub_total'])."<br />{$porcentagemg}{$msgSedelivery}*Total:* {$moeda} {$get_dados_pedido['total']}<br />*Troco para:* {$moeda} {$get_dados_pedido['valor_troco']}<br /><br />*{$get_dados_pedido['data']}*";


		$quarta_parte_pedido = str_replace('pagamento', 'Pagamento', $quarta_parte_pedido);
		$quarta_parte_pedido = str_replace('total', 'Total', $quarta_parte_pedido);
		$quarta_parte_pedido = str_replace('troco', 'Troco', $quarta_parte_pedido);
		$quarta_parte_pedido = str_replace('r$', 'R$', $quarta_parte_pedido);
		$quarta_parte_pedido = str_replace('obrigado pelo pedido', 'Obrigado pelo pedido', $quarta_parte_pedido);
		$quarta_parte_pedido = str_replace('<br />', '%0A', $quarta_parte_pedido);
		$quarta_parte_pedido = str_replace(' ', '%20', $quarta_parte_pedido);

	endif;

	if(!empty($get_dados_pedido['mesa']) && !empty($get_dados_pedido['pessoas'])):
		unset($get_dados_pedido['mesa']);
	unset($get_dados_pedido['pessoas']);
endif;


$linkTratado = "{$inicio_texto}";

$linkTratado = str_replace('<br />', '%0A', $linkTratado);
$linkTratado = str_replace(' ', '%20', $linkTratado);

$link = "https://api.whatsapp.com/send?phone=55{$get_dados_pedido['telefone_empresa']}&text=🔔%20{$linkTratado}{$enviarPedidos}{$terceira_parte_pedido}{$quarta_parte_pedido}";

if(!empty($get_dados_pedido['mesa']) && !empty($get_dados_pedido['pessoas'])):
else:
	$get_dados_pedido['valor_troco'] = Check::Valor($get_dados_pedido['valor_troco']);
endif;

$get_dados_pedido['total']       = Check::Valor($get_dados_pedido['total']);
$get_dados_pedido['data']        = Check::Data($get_dados_pedido['data']);


unset($get_dados_pedido['bairro2']);

$get_dados_pedido['valor_taxa'] = ($get_dados_pedido['opcao_delivery'] == 'true' ? $get_dados_pedido['valor_taxa'] : '0.00');								

$get_dados_pedido['view'] = 0;
if(!empty($_SESSION['desconto_cupom']) && $_SESSION['desconto_cupom']['user_id'] == $getu):
	$get_dados_pedido['desconto'] = $_SESSION['desconto_cupom']['desconto'];
endif;


								//INICI0 DO CODIGO DE VALODAÇÃO OPEN CLOSE

   $hours = array();      



         //CONFIGURAÇÃO DE SEGUNDA FEIRA
        if(!empty($config_segunda) && $config_segunda == "false" && !empty($config_segundaa) && $config_segundaa == "false"):
            	 $hours['mon'] = array();
        elseif(!empty($config_segunda) && $config_segunda == "true" && !empty($config_segundaa) && $config_segundaa == "true"):
            $hours['mon'] = array($segunda_manha_de.'-'.$segunda_manha_ate, $segunda_tarde_de.'-'.$segunda_tarde_ate);
        
        elseif(!empty($config_segunda) && $config_segunda == "true" && !empty($config_segundaa) && $config_segundaa == "false"):
        	  $hours['mon'] = array($segunda_manha_de.'-'.$segunda_manha_ate);
       	elseif(!empty($config_segunda) && $config_segunda == "false" && !empty($config_segundaa) && $config_segundaa == "true"):
       		$hours['mon'] = array($segunda_tarde_de.'-'.$segunda_tarde_ate);
        endif;
        //CONFIGURAÇÃO DE SEGUNDA FEIRA

        //CONFIGURAÇÃO DE TERÇA FEIRA
        if(!empty($config_terca) && $config_terca == "false" && !empty($config_tercaa) && $config_tercaa == "false"):
            	 $hours['tue'] = array();
        elseif(!empty($config_terca) && $config_terca == "true" && !empty($config_tercaa) && $config_tercaa == "true"):
            $hours['tue'] = array($terca_manha_de.'-'.$terca_manha_ate, $terca_tarde_de.'-'.$terca_tarde_ate);
        
        elseif(!empty($config_terca) && $config_terca == "true" && !empty($config_tercaa) && $config_tercaa == "false"):
        	  $hours['tue'] = array($terca_manha_de.'-'.$terca_manha_ate);
       	elseif(!empty($config_terca) && $config_terca == "false" && !empty($config_tercaa) && $config_tercaa == "true"):
       		$hours['tue'] = array($terca_tarde_de.'-'.$terca_tarde_ate);
        endif;
        //CONFIGURAÇÃO DE TERÇA FEIRA

         //CONFIGURAÇÃO DE QUARTA FEIRA
        if(!empty($config_quarta) && $config_quarta == "false" && !empty($config_quartaa) && $config_quartaa == "false"):
            	 $hours['wed'] = array();
        elseif(!empty($config_quarta) && $config_quarta == "true" && !empty($config_quartaa) && $config_quartaa == "true"):
            $hours['wed'] = array($quarta_manha_de.'-'.$quarta_manha_ate, $quarta_tarde_de.'-'.$quarta_tarde_ate);
        
        elseif(!empty($config_quarta) && $config_quarta == "true" && !empty($config_quartaa) && $config_quartaa == "false"):
        	  $hours['wed'] = array($quarta_manha_de.'-'.$quarta_manha_ate);
       	elseif(!empty($config_quarta) && $config_quarta == "false" && !empty($config_quartaa) && $config_quartaa == "true"):
       		$hours['wed'] = array($quarta_tarde_de.'-'.$quarta_tarde_ate);
        endif;
        //CONFIGURAÇÃO DE QUARTA FEIRA

         //CONFIGURAÇÃO DE QUINTA FEIRA
        if(!empty($config_quinta) && $config_quinta == "false" && !empty($config_quintaa) && $config_quintaa == "false"):
            	 $hours['thu'] = array();
        elseif(!empty($config_quinta) && $config_quinta == "true" && !empty($config_quintaa) && $config_quintaa == "true"):
            $hours['thu'] = array($quinta_manha_de.'-'.$quinta_manha_ate, $quinta_tarde_de.'-'.$quinta_tarde_ate);
        
        elseif(!empty($config_quinta) && $config_quinta == "true" && !empty($config_quintaa) && $config_quintaa == "false"):
        	  $hours['thu'] = array($quinta_manha_de.'-'.$quinta_manha_ate);
       	elseif(!empty($config_quinta) && $config_quinta == "false" && !empty($config_quintaa) && $config_quintaa == "true"):
       		$hours['thu'] = array($quinta_tarde_de.'-'.$quinta_tarde_ate);
        endif;
        //CONFIGURAÇÃO DE QUINTA FEIRA

        //CONFIGURAÇÃO DE SEXTA FEIRA
        if(!empty($config_sexta) && $config_sexta == "false" && !empty($config_sextaa) && $config_sextaa == "false"):
            	 $hours['fri'] = array();
        elseif(!empty($config_sexta) && $config_sexta == "true" && !empty($config_sextaa) && $config_sextaa == "true"):
            $hours['fri'] = array($sexta_manha_de.'-'.$sexta_manha_ate, $sexta_tarde_de.'-'.$sexta_tarde_ate);
        
        elseif(!empty($config_sexta) && $config_sexta == "true" && !empty($config_sextaa) && $config_sextaa == "false"):
        	  $hours['fri'] = array($sexta_manha_de.'-'.$sexta_manha_ate);
       	elseif(!empty($config_sexta) && $config_sexta == "false" && !empty($config_sextaa) && $config_sextaa == "true"):
       		$hours['fri'] = array($sexta_tarde_de.'-'.$sexta_tarde_ate);
        endif;
        //CONFIGURAÇÃO DE SEXTA FEIRA

         //CONFIGURAÇÃO DE SABADO
        if(!empty($config_sabado) && $config_sabado == "false" && !empty($config_sabadoo) && $config_sabadoo == "false"):
            	 $hours['sat'] = array();
        elseif(!empty($config_sabado) && $config_sabado == "true" && !empty($config_sabadoo) && $config_sabadoo == "true"):
            $hours['sat'] = array($sabado_manha_de.'-'.$sabado_manha_ate, $sabado_tarde_de.'-'.$sabado_tarde_ate);
        
        elseif(!empty($config_sabado) && $config_sabado == "true" && !empty($config_sabadoo) && $config_sabadoo == "false"):
        	  $hours['sat'] = array($sabado_manha_de.'-'.$sabado_manha_ate);
       	elseif(!empty($config_sabado) && $config_sabado == "false" && !empty($config_sabadoo) && $config_sabadoo == "true"):
       		$hours['sat'] = array($sabado_tarde_de.'-'.$sabado_tarde_ate);
        endif;
        //CONFIGURAÇÃO DE SABADO

        //CONFIGURAÇÃO DE DOMINGO
        if(!empty($config_domingo) && $config_domingo == "false" && !empty($config_domingoo) && $config_domingoo == "false"):
            	 $hours['sun'] = array();
        elseif(!empty($config_domingo) && $config_domingo == "true" && !empty($config_domingoo) && $config_domingoo == "true"):
            $hours['sun'] = array($domingo_manha_de.'-'.$domingo_manha_ate, $domingo_tarde_de.'-'.$domingo_tarde_ate);
        
        elseif(!empty($config_domingo) && $config_domingo == "true" && !empty($config_domingoo) && $config_domingoo == "false"):
        	  $hours['sun'] = array($domingo_manha_de.'-'.$domingo_manha_ate);
       	elseif(!empty($config_domingo) && $config_domingo == "false" && !empty($config_domingoo) && $config_domingoo == "true"):
       		$hours['sun'] = array($domingo_tarde_de.'-'.$domingo_tarde_ate);
        endif;
        //CONFIGURAÇÃO DE DOMINGO

$lerbanco->ExeRead("ws_datas_close", "WHERE user_id = :delivdata", "delivdata={$getu}");
$exceptions = array();
if($lerbanco->getResult()):
	foreach($lerbanco->getResult() as $dadosC):
		extract($dadosC);
		$i = explode('/', $data);
		$i = array_reverse($i);
		$i = implode("-", $i);							

		if(isDateExpired($i, 1)):
			$exceptions["{$i}"] = array();							
		endif;
	endforeach;
endif;



					// Iniciando a classe
$store_hours = new StoreHours($hours, $exceptions);


					 // Display open / closed menssagem
					if($store_hours->is_open()) {

						if($get_dados_pedido['opcao_delivery'] == 'true' && !empty($minimo_delivery) && $minimo_delivery != '0.00' && $get_dados_pedido['total'] < $minimo_delivery):
							$minimo_delivery = Check::Real($minimo_delivery);
							echo "<script>
							x0p('', 
							'Opss... O valor mínimo do delivery e de R$ {$minimo_delivery}',
							'error', false);

							var sound = new Howl({
								src: ['{$site}ops.mp3'],
								volume: 1.0,
								autoplay: true,
								});
								sound.play();
								</script>";
							else:

						//INICIO COLOCAR DENTRO DOCIDIGO APOS VALIDACÃO
								$addbanco->ExeCreate("ws_pedidos", $get_dados_pedido);
								if ($addbanco->getResult()):


									$tabela_api = array();
									$tabela_api['USER_ID'] = $getu;
									$tabela_api['ID_WS_PEDIDOS'] = $addbanco->getResult();
									$tabela_api['CODIGO_PEDIDO'] = $get_dados_pedido['codigo_pedido'];



									$allItems = $cart->getItems();
									foreach ($allItems as $items) {
										foreach ($items as $item) {

											
											$valoradicionais = 0;
											$todosOsAdicionaisSoma3 = 0;
											$todosOsAdicionais = '';							

											if(!empty($item['attributes']['totalAdicionais'])):


												for($i=0; $i < $item['attributes']['totalAdicionais']; $i++):
													$todosOsAdicionais = $todosOsAdicionais.$item['attributes']['adicional_nome'.$i].', ';
													$todosOsAdicionaisSoma3 = ($todosOsAdicionaisSoma3 + $item['attributes']['adicional_valor'.$i]);
												endfor;
												$valoradicionais = ($todosOsAdicionaisSoma3 * $item['quantity']);
											endif;

											$totalitens = ($item['attributes']['preco'] * $item['quantity']);

											$tabela_api['ID_PRODUTO'] = $item['id'];						
											$tabela_api['QTDE'] = $item['quantity'];
											$tabela_api['ADICIONAIS'] = $todosOsAdicionais;
											$tabela_api['VALOR'] = ($valoradicionais + $totalitens);
											$tabela_api['OBS'] = $item['attributes']['observacao'];

											$addbanco->ExeCreate("ws_pedidos_itens", $tabela_api);


											
										}
									}

									if(!empty($_SESSION['desconto_cupom'])):
										unset($_SESSION['desconto_cupom']);
									endif;
									$cart->clear();

									if($get_dados_pedido['confirm_whatsapp'] == 'true'):
										echo "
										<script type=\"text/javascript\">
										var link1 = \"{$link}\";
										window.location.replace(link1);
										</script>
										";
									else:
										echo "<script>
										x0p({
											title: 'Sucesso!',
											text: 'Recebemos seu pedido! Aguarde nosso contato.',
											animationType: 'slideUp',
											buttons: [

											{
												type: 'info',
												key: 50,
												text: 'OK'
											}
											]
											}).then(function(data) {
												if(data.button == 'info'){
													window.location.reload(1);
												}
												});

												var sound = new Howl({
													src: ['{$site}campainha.mp3'],
													volume: 1.0,
													autoplay: true,
													});
													sound.play();
													</script>";	
												endif;

											else:
												echo "<script>
												x0p('Opss...', 
												'OCORREU UM ERRO!',
												'error', false);

												var sound = new Howl({
													src: ['{$site}ops.mp3'],
													volume: 1.0,
													autoplay: true,
													});
													sound.play();
													</script>";								
							    endif;//INICIO COLOCAR DENTRO DOCIDIGO APOS VALIDACÃO
							    //INICIO COLOCAR DENTRO DOCIDIGO APOS VALIDACÃO







							endif;
						} else {

							echo "<script>
							sweetAlert(\"Oops...\", \"{$texto['msg_msg_fechado']}\", \"{$site}img/loja-fechado.png\");

							var sound = new Howl({
								src: ['{$site}ops.mp3'],
								volume: 1.0,
								autoplay: true,
								});
								sound.play();
								</script>";

												}//FIM DO CODIGO DE VALODAÇÃO OPEN CLOSE
					//FIM DO CODIGO DE VALODAÇÃO OPEN CLOSE

											endif;
										endif;

										ob_end_flush();