<?php 
require('../_app/Config.inc.php');
$site = HOME;

$getiduser = $_POST['iduser'];

$getCond = $_POST['idDoPedido'];
$atualizarver = array();
$atualizarver['view'] = 1;
$lerbanco->ExeRead('ws_pedidos', "WHERE user_id = :userid AND view = :c", "userid={$getiduser}&c={$getCond}");
$updatebanco->ExeUpdate("ws_pedidos", $atualizarver, "WHERE user_id = :userid AND id = :up", "userid={$getiduser}&up={$getCond}");
if ($updatebanco->getResult()):
	echo "true";
endif;

