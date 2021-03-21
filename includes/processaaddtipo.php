<?php 
ob_start();
session_start();
require('../_app/Config.inc.php');
require('../_app/Mobile_Detect.php');
$detect = new Mobile_Detect;
$site = HOME;


$getdadosAddtipo = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$getdadosAddtipo['nome_tipo_produto'] = trim(strip_tags($getdadosAddtipo['nome_tipo_produto']));

 $addbanco->ExeCreate("ws_tipo_produto", $getdadosAddtipo);
    if($addbanco->getResult()):                                                
        echo "true";         
    else:
        echo "false";         
    endif;


ob_end_flush();