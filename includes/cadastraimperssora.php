<?php 
ob_start();
session_start();
require('../_app/Config.inc.php');
require('../_app/Mobile_Detect.php');
$detect = new Mobile_Detect;
$site = HOME;


$nomeImpressora = strip_tags(trim($_POST['nomeImpresora']));
$impress = array();
$impress['nome_impressora'] = $nomeImpressora;
$impress['user_id'] = $_SESSION['userlogin']['user_id'];


$lerbanco->ExeRead("ws_impressora", "WHERE user_id = :userid AND nome_impressora = :aa", "userid={$_SESSION['userlogin']['user_id']}&aa={$nomeImpressora}");
if($lerbanco->getResult()):
	$updatebanco->ExeUpdate("ws_impressora", $impress, "WHERE user_id = :userid AND nome_impressora = :upp", "userid={$_SESSION['userlogin']['user_id']}&upp={$nomeImpressora}");
else:
	$addbanco->ExeCreate("ws_impressora", $impress);
endif;

ob_end_flush();