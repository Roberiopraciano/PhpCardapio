<?php 
require('../_app/Config.inc.php');
$site = HOME;

$iddoitem = $_POST['iditemdeletar'];
$idusuario   = $_POST['iduser'];


$lerbanco->ExeRead('ws_itens', "WHERE user_id = :userid AND id =:iditem", "userid={$idusuario}&iditem={$iddoitem}");
if($lerbanco->getResult()):
    foreach ($lerbanco->getResult() as $i):
        extract($i);               
    endforeach;

    if(file_exists("../uploads/{$img_item}") && !is_dir("../uploads/{$img_item}")):
      unlink("../uploads/{$img_item}");
endif; 

$deletbanco->ExeDelete("ws_itens", "WHERE user_id = :userid AND id = :iditem", "userid={$idusuario}&iditem={$iddoitem}");
if($deletbanco->getResult()):
   $deletbanco->ExeDelete("ws_relacao_tamanho", "WHERE 	id_user = :userid AND id_item = :iditem", "userid={$idusuario}&iditem={$iddoitem}");

   echo "true";
endif;   

endif;

