<?php
ob_start();
session_start();
require('../../_app/Config.inc.php');
require('../../_app/Mobile_Detect.php');
$detect = new Mobile_Detect;
$site = HOME;


$getnovadatarenova = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if(!empty($getnovadatarenova)):
  
  $getnovadatarenova = array_map("trim", $getnovadatarenova);
  $getnovadatarenova = array_map("strip_tags", $getnovadatarenova);

  if(in_array("", $getnovadatarenova)):
    echo "erro1";
  elseif(strlen($getnovadatarenova['empresa_data_renovacao']) != 10):
    echo "erro2";
  else:
   $getnovadatarenova['empresa_data_renovacao'] = explode("/", $getnovadatarenova['empresa_data_renovacao']);
   $getnovadatarenova['empresa_data_renovacao'] = array_reverse($getnovadatarenova['empresa_data_renovacao']);
   $getnovadatarenova['empresa_data_renovacao'] = implode("-", $getnovadatarenova['empresa_data_renovacao']);


   $updatebanco->ExeUpdate("ws_empresa", $getnovadatarenova, "WHERE user_id = :userid", "userid={$getnovadatarenova['user_id']}");
   if($updatebanco->getResult()): 
    echo "erro0";
  else:
    echo "erro3";
  endif;


endif;
endif;












ob_end_flush();
?>