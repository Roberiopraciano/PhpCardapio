<?php 
ob_start();
session_start();
require('../_app/Config.inc.php');
require('../_app/Mobile_Detect.php');
$detect = new Mobile_Detect;
$site = HOME;

$updatebancoitens['config_total_s'] = strip_tags(trim($_POST['uptotal']));

$updatebanco->ExeUpdate("ws_itens", $updatebancoitens, "WHERE user_id = :userid AND id = :iditem", "userid={$_POST['user_id']}&iditem={$_POST['id_item']}");
if ($updatebanco->getResult()):                                                 
	echo "true";         
else:
	echo "false";         
endif;

ob_end_flush();