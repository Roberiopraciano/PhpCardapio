<?php
require('../_app/Config.inc.php');
$site = HOME;

$PegaId = $_POST['idLocal'];
$pegaidUser = $_POST['iduserrr'];

$lerbanco->ExeRead('bairros_delivery', "WHERE id = :f and user_id = :userid", "f={$PegaId}&userid={$pegaidUser}");
if (!$lerbanco->getResult()):
	echo '<script type="text/javascript">alert("Ocorreu um erro ao localizar endereço!")</script>';
else:
	foreach($lerbanco->getResult() as $i):
		extract($i);
	endforeach;

$LocalEmjason = array();
$LocalEmArray['uf'] = $uf;
$LocalEmArray['cidade'] = $cidade;
$LocalEmArray['bairro'] = $bairro;
$LocalEmArray['taxa'] = $taxa;

echo(json_encode($LocalEmArray));
 
endif;