<?php 
ob_start();
session_start();
require('../_app/Config.inc.php');
$site = HOME;

$somarv = $_POST['maisum'];
$userid = $_POST['userid'];

$lerbanco->ExeRead("views", "WHERE user_id = :userid", "userid={$userid}");
if (!$lerbanco->getResult()):
	$novacontagemum['contar'] = $somarv;
	$novacontagemum['user_id'] = $userid;
	$addbanco->ExeCreate("views", $novacontagemum);
else:
    
	$dadosview = $lerbanco->getResult();
	$contarr = ($dadosview[0]['contar'] + $somarv);
	$novacontagemDois['contar'] = $contarr;

	$updatebanco->ExeUpdate("views", $novacontagemDois, "WHERE user_id = :userid", "userid={$userid}");

endif;

ob_end_flush();