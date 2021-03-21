<?php 
require('../_app/Config.inc.php');
$site = HOME;

$idcategoria = $_POST['idcat'];
$idusuario   = $_POST['iduser'];

$deletbanco->ExeDelete("ws_cat", "WHERE user_id = :userid AND id = :fdv", "userid={$idusuario}&fdv={$idcategoria}");
if($deletbanco->getResult()):

    $lerbanco->ExeRead('ws_itens', "WHERE user_id = :userid AND id_cat = :fff", "userid={$idusuario}&fff={$idcategoria}");

    if($lerbanco->getResult()):

    foreach ($lerbanco->getResult() as $i):
        extract($i);

        if(file_exists("../uploads/{$img_item}") && !is_dir("../uploads/{$img_item}")):
          unlink("../uploads/{$img_item}");
        endif;
        
    endforeach;

    $deletbanco->ExeDelete("ws_itens", "WHERE user_id = :userid AND id_cat = :fdv", "userid={$idusuario}&fdv={$idcategoria}");
    else:
    endif;

endif;