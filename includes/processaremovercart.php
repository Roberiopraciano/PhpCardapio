<?php 
ob_start();
session_start();
require('../_app/Config.inc.php');
require('../_app/Mobile_Detect.php');
$detect = new Mobile_Detect;
$site = HOME;

$getnomeloja = $_POST['getpegaloja'];

$cart = new Cart([
	//Total de item que pode ser adicionado ao carrinho 0 = Ilimitado
	'cartMaxItem' => 0,

	// A quantidade máxima de um item que pode ser adicionada ao carrinho, 0 = Ilimitado
	'itemMaxQuantity' => 0,

	// Não usar cookies, os itens do carrinho desaparecerão depois que o navegador for fechado
	'useCookie' => false,
]);


if(!empty($_POST['iditem']) && !empty($_POST['itemrash'])):
	$cart->remove($_POST['iditem'], $_POST['itemrash']);
echo "<script>$('#sidebar').load('{$site}includes/sidebar.php', {'getloja': '{$getnomeloja}'});</script>";
endif;


ob_end_flush();