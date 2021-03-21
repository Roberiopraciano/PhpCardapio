<?php
require('../_app/Config.inc.php');
$site = HOME;

$idcupom = $_POST['iddocupom'];
$iduser  = $_POST['iduser'];

$deletbanco->ExeDelete("cupom_desconto", "WHERE user_id = :userid AND id_cupom = :idcupom", "userid={$iduser}&idcupom={$idcupom}");
    if($deletbanco->getResult()):
        echo "<script>setTimeout(function() {
				window.location.replace('{$site}{$_POST['url']}/cupom-desconto');
			}, 1000);</script>";
    endif;