<?php
require('../_app/Config.inc.php');
require('../ticket/autoload.php'); //Nota: si renombraste la carpeta a algo diferente de "ticket" cambia el nombre en esta línea
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

$condimprimir = $_POST['imprimir'];
$idclientee    = $_POST['idcliente'];

if(!empty($condimprimir) && $condimprimir == 'true' && !empty($idclientee)):


	$lerbanco->ExeRead("ws_impressora", "WHERE user_id = :userid", "userid={$idclientee}");
if(!$lerbanco->getResult()):
	echo "erro1";
else:

	$valorNomeImpressora = $lerbanco->getResult();
	$nomeImpre = $valorNomeImpressora[0]['nome_impressora'];

	try {
    // Enter the share name for your USB printer here
    //$connector = null;
		$connector = new WindowsPrintConnector("smb://DESKTOP-SG9F0C3/{$nomeImpre}");

		/* Print a "Hello world" receipt" */
		$printer = new Printer($connector);
		$printer->text("PEDIDO TOP\n");
		$printer->text("\n");
		$printer->text("PEDIDO: #PED0620-05\n");		
		$printer->text(date("d-m-Y H:i:s") . "\n");	
		$printer->text("-----------------------------"."\n");
		$printer->text("RESUMO:\n");
		$printer->text("Qtd: 3x hamburguer\n");
		$printer->text( "Adicionais: Sem Adicionais  \n");
		$printer->text( "Valor: R$ 30,00  \n");
		$printer->text("\n");
		$printer->text("Qtd: 2x Xfrango\n");
		$printer->text( "Adicionais: Sem Adicionais  \n");
		$printer->text( "Valor: R$ 25,00  \n");
		$printer->text("-----------------------------"."\n");
		$printer->text("SUBTOTAL: R$ 55,00\n");
		$printer->text("DELIVERY: R$ 6,00\n");
		$printer->text("TOTAL: R$ 61,00\n");
		$printer->text("-----------------------------"."\n");
		$printer->text("Telefone: 79991322619\n");
		$printer->text("***OBRIGADO PELA PREFERÊNCIA***\n");
		$printer -> cut();

		/* Close printer */
		$printer -> close();
	} catch (Exception $e) {
		echo "erro2";
		//echo "Não foi possível imprimir nesta impressora: " . $e -> getMessage() . "\n";
	}

endif;

endif;