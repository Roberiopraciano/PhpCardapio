<?php
require('../_app/Config.inc.php');
require('../_app/Helpers/Check.class.php');
require('../ticket/autoload.php'); //Nota: si renombraste la carpeta a algo diferente de "ticket" cambia el nombre en esta línea
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

$userid      = $_POST['user_id'];
$idpedido    = $_POST['id_pedido'];

if(!empty($userid) && !empty($idpedido)):

	$lerbanco->ExeRead("ws_impressora", "WHERE user_id = :userid", "userid={$userid}");
if(!$lerbanco->getResult()):
	echo "erro1";
else:

	$valorNomeImpressora = $lerbanco->getResult();
	$nomeImpre = $valorNomeImpressora[0]['nome_impressora'];

	$lerbanco->ExeRead('ws_pedidos', "WHERE user_id = :userid AND id = :f", "userid={$userid}&f={$idpedido}");
	if (!$lerbanco->getResult()):

		echo "erro2";

	else:
		foreach ($lerbanco->getResult() as $i):
			extract($i);
		endforeach;

		$dataex = explode(' ', $data);
		$dataex[0] = explode('-', $dataex[0]);
		$dataex[0] = array_reverse($dataex[0]);
		$dataex[0] = implode('/', $dataex[0]);

		$dataformatada =  $dataex[0].' - '.$dataex[1];

		$nome = str_replace('%20', ' ', $nome);
		$nomeCliente = $nome;
		$telefoneformatado = formatPhone($telefone);

		$taxaPedido = Check::Real($valor_taxa);
		$valorTroco = Check::Real($valor_troco);
		$totalPedido = Check::Real($total);


		$resumoPedidosFormatado = str_replace('*', '', $resumo_pedidos);
		$resumoPedidosFormatado = str_replace('<b>', '', $resumoPedidosFormatado);
		$resumoPedidosFormatado = str_replace('</b>', '', $resumoPedidosFormatado);
		$resumoPedidosFormatado = str_replace("<br />", "\n", $resumoPedidosFormatado);

		$lerbanco->ExeRead('ws_empresa', "WHERE user_id = :userid", "userid={$userid}");
		if(!$lerbanco->getResult()):
			echo "erro3";
		else:

			foreach ($lerbanco->getResult() as $ii):
				extract($ii);
			endforeach;

			$telefoneEmpresaFormatado = formatPhone($telefone_empresa);


			try {
    // Enter the share name for your USB printer here
    //$connector = null;
				$connector = new WindowsPrintConnector($nomeImpre);

				/* Print a "Hello world" receipt" */
				$printer = new Printer($connector);
				$printer->text("{$nome_empresa}\n");
				$printer->text("\n");
				$printer->text("PEDIDO: #{$codigo_pedido}\n");		
				$printer->text("{$dataformatada} \n");	
				$printer->text("-----------------------------"."\n");				
				$printer->text("RESUMO DO PEDIDO:\n");
				$printer->text("{$resumoPedidosFormatado}");
				$printer->text("-----------------------------"."\n");
				$printer->text("DADOS DO CLIENTE:\n");
				if($opcao_delivery != 'true'):
				$printer->text("NOME: {$nomeCliente} \n");
				$printer->text("TEL: {$telefoneformatado} \n");
				$printer->text("{$texto['msg_Buscar_pedido']} \n");
				else:
				$printer->text("NOME: {$nomeCliente} \n");
				$printer->text("TEL: {$telefoneformatado} \n");
				$printer->text("Rua: {$rua}, Nº {$unidade} \n");
				$printer->text("Bairro: {$bairro} \n");
				$printer->text("Cidade: {$cidade} - {$uf} \n");
				$printer->text("Complemento: {$complemento} \n");
				$printer->text("Observação: {$observacao} \n");
				endif;
				$printer->text("-----------------------------"."\n");
				$printer->text("PAGAMENTO: {$forma_pagamento}\n");
				if($valor_taxa != '0.00'):
				$printer->text("DELIVERY: R$ {$taxaPedido}\n");
				endif;
				if(!empty($desconto) && $desconto != 0):
				$printer->text("DESCONTO: {$desconto}% \n");
				endif;
				if(!empty($valor_troco) && $valor_troco != '0.00'):
				$printer->text("TROCO PARA: R$ {$valorTroco} \n");
				endif;
				$printer->text("TOTAL: R$ {$totalPedido} \n");
				$printer->text("-----------------------------"."\n");
				$printer->text("Telefone: {$telefoneEmpresaFormatado}\n");
				$printer->text("***OBRIGADO PELA PREFERÊNCIA***\n");
				$printer->text("\n\n\n\n\n\n");
				$printer -> cut();

				/* Close printer */
				$printer -> close();
			} catch (Exception $e) {
				echo "erro4";
		//echo "Não foi possível imprimir nesta impressora: " . $e -> getMessage() . "\n";
			}

		endif;
	endif;
endif;
endif;