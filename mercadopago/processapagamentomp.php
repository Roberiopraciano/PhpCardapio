<?php 
ob_start();
session_start();
require('../_app/Config.inc.php');
$site = HOME;

require('vendor/autoload.php');

$token = $_REQUEST["token"];
$payment_method_id = $_REQUEST["payment_method_id"];
$installments = $_REQUEST["installments"];
$issuer_id = $_REQUEST["issuer_id"];


MercadoPago\SDK::setAccessToken("{$texto['accesstoken']}");

$emailuser = "";

if(!empty($_SESSION['userlogin'])):
  $planoUser = $_SESSION['userlogin']['user_plano'];
  $nomeplano = "";
  $valorplano = "";
  $emailuser = $_SESSION['userlogin']['user_email'];

  if($planoUser == 1):
    $nomeplano = $texto['nomePlanoUm'];
    $valorplano = "{$texto['valorPlanoUm']}.00";
  elseif($planoUser == 2):
    $nomeplano = $texto['nomePlanoDois'];
    $valorplano = "{$texto['valorPlanoDois']}.00";
  elseif($planoUser == 3):
    $nomeplano = $texto['nomePlanoTres'];
    $valorplano = "{$texto['valorPlanoTres']}.00";
  endif;

endif;

    //...
  //...
$payment = new MercadoPago\Payment();
$payment->transaction_amount = $valorplano;
$payment->token = $token;
$payment->description = $texto['nome_site_landing'].' - '.$nomeplano;
$payment->installments = $installments;
$payment->payment_method_id = $payment_method_id;
$payment->issuer_id = $issuer_id;
$payment->payer = array(
  "email" => "{$emailuser}"
);
    // Armazena e envia o pagamento
$payment->save();
    //...
    // Imprime o status do pagamento
echo $payment->status;
    //...

$dias = "0";
if($_SESSION['userlogin']['user_plano'] == 1):
  $dias = $texto['DiasPlanoUm'];
elseif($_SESSION['userlogin']['user_plano'] == 2):
  $dias = $texto['DiasPlanoDois'];
elseif($_SESSION['userlogin']['user_plano'] == 3):
  $dias = $texto['DiasPlanoTres'];
endif;

$lerbanco->ExeRead("ws_empresa", "WHERE user_id = :userid", "userid={$_SESSION['userlogin']['user_id']}");
if(!$lerbanco->getResult()):
else:
  $getlink = $lerbanco->getResult();
endif;


if($payment->status == "approved"):
  $novadata = array();
  $novadata['empresa_data_renovacao'] = date("Y-m-d", strtotime("+{$dias} days"));
  echo $novadata['empresa_data_renovacao'];
  $updatebanco->ExeUpdate("ws_empresa", $novadata, "WHERE user_id = :userid", "userid={$_SESSION['userlogin']['user_id']}");
  header("Location: {$site}{$getlink[0]['nome_empresa_link']}/admin-loja&statusmp=approved");
else:
    // rejected
  header("Location: {$site}{$getlink[0]['nome_empresa_link']}/admin-loja&statusmp=rejected");
endif;





ob_end_flush();