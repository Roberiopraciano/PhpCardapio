<?php 
ob_start();
session_start();
require('../_app/Config.inc.php');
require('../_app/Mobile_Detect.php');
$site = HOME;

$linkuser = strip_tags(trim($_POST['linkuser']));
$linkuser = remove_especial_char(remove_accents($linkuser));
$linkuser = str_replace(' ', '', $linkuser);

$lerbanco->ExeRead('ws_empresa', "WHERE binary nome_empresa_link = :linkuser", "linkuser={$linkuser}");
if($lerbanco->getResult()):
	echo "true";
else:
	echo $linkuser;
endif; 

ob_end_flush();
?>