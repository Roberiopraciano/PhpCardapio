<?php
require('../_app/Config.inc.php');
$site = HOME;

$idcupom = $_POST['iddocupom'];
$iduser  = $_POST['iduser'];


$lerbanco->ExeRead("cupom_desconto", "WHERE user_id = :iduser AND mostrar_site = :mostrarcupom", "iduser={$iduser}&mostrarcupom=1");
if(!$lerbanco->getResult()):
////////////////////////////
	$updatemostrar['mostrar_site'] = 1;
	$updatebanco->ExeUpdate("cupom_desconto", $updatemostrar, "WHERE user_id = :userid AND id_cupom = :idcupom", "userid={$iduser}&idcupom={$idcupom}");
	if(!$updatebanco->getResult()): 
		echo "erro1";
	else:
		echo "erro0";
	endif;
//////////////////////////
else: // SE NÃO FAZ ISSO:

$getid = $lerbanco->getResult();
$idatualizazero = $getid[0]['id_cupom'];

if($idatualizazero == $idcupom):
	$updatezerom['mostrar_site'] = 0;
	$updatebanco->ExeUpdate("cupom_desconto", $updatezerom, "WHERE user_id = :userid AND id_cupom = :idcupom", "userid={$iduser}&idcupom={$idcupom}");
	if(!$updatebanco->getResult()): 
		echo "erro1";
	else:
		echo "erro0";
	endif;
	
else:

	$updatezero['mostrar_site'] = 0;
	$updatebanco->ExeUpdate("cupom_desconto", $updatezero, "WHERE user_id = :userid AND id_cupom = :idcupom", "userid={$iduser}&idcupom={$idatualizazero}");
	if(!$updatebanco->getResult()): 
		echo "erro1";
	else:
		$novonumeroum['mostrar_site'] = 1;
		$updatebanco->ExeUpdate("cupom_desconto", $novonumeroum, "WHERE user_id = :userid AND id_cupom = :idcupom", "userid={$iduser}&idcupom={$idcupom}");
		if(!$updatebanco->getResult()): 
			echo "erro1";
		else:
			echo "erro0";
		endif;

	endif;
	

endif;

endif;