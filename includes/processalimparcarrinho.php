<?php 
ob_start();
session_start();
require('../_app/Config.inc.php');
$site = HOME;

$getnomeloja = $_POST['getlojal'];

$cart = new Cart([
	//Total de item que pode ser adicionado ao carrinho 0 = Ilimitado
	'cartMaxItem' => 0,

	// A quantidade máxima de um item que pode ser adicionada ao carrinho, 0 = Ilimitado
	'itemMaxQuantity' => 0,

	// Não usar cookies, os itens do carrinho desaparecerão depois que o navegador for fechado
	'useCookie' => false,
]);

// limpa o carrinho
if(!empty($_POST['limparcart']) && $_POST['limparcart'] == 'sim'):
	$cart->clear();
	echo "<script>$('#sidebar').load('{$site}includes/sidebar.php', {'getloja': '{$getnomeloja}'});</script>";
endif;


// limpa a lista do carrinho
ob_end_flush();

?>