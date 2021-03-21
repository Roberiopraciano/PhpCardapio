<?php

$login = new Login(3);

if(!$login->CheckLogin()):
 unset($_SESSION['userlogin']);
 header("Location: {$site}");
else:
 $userlogin = $_SESSION['userlogin'];
endif;

$logoff = filter_input(INPUT_GET, 'logoff', FILTER_VALIDATE_BOOLEAN);

if(!empty($logoff) && $logoff == true):
 $updateacesso = new Update;
 $dataEhora    = date('d/m/Y H:i');
 $ip           = get_client_ip();
 $string_last = array("user_ultimoacesso" => " Último acesso em: {$dataEhora} IP: {$ip} ");
 $updateacesso->ExeUpdate("ws_users", $string_last, "WHERE user_id = :uselast", "uselast={$userlogin['user_id']}");

 unset($_SESSION['userlogin']);
 header("Location: {$site}");
endif;

$updatebanco = new Update();
?>



<div id="adicionarbairro"></div>
<div style="background-color:#ffffff;" class="container margin_60">
 <div class="row"> 
  <div class="col-md-8 col-md-offset-2"> 
   <div id="sendnewpass" class="indent_title_in">
    <i class="fa fa-map-marker" aria-hidden="true"></i>
    <h3>Endereços de Entrega:</h3>
    <p>
      <strong>ADICIONE TODOS OS BAIRROS QUE VOCÊ FAZ ENTREGAS.</strong><br />
     <strong style="color:red;">Importante:</strong> Leia a notas no final da página!
   </p>
 </div>

 <?php
 $getdellbairro = filter_input(INPUT_GET, 'delete', FILTER_VALIDATE_INT);

 if(!empty($getdellbairro)):

  $lerbanco->ExeRead('bairros_delivery', "WHERE user_id = :userid AND id = :v1", "userid={$userlogin['user_id']}&v1={$getdellbairro}");
  if ($lerbanco->getResult()):
  $deletbanco->ExeDelete("bairros_delivery", "WHERE user_id = :userid AND id = :k1", "userid={$userlogin['user_id']}&k1={$getdellbairro}");
    if ($deletbanco->getResult()):
      echo "<div class=\"alert alert-success alert-dismissable\">
      <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
      <b class=\"alert-link\">SUCESSO!</b> Bairro deletado do sistema.
      </div>";
      header("Refresh: 3; url={$site}{$Url[0]}/enderecos-delivery#adicionarbairro");
    else:
      echo "<div class=\"alert alert-danger alert-dismissable\">
      <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
      <b class=\"alert-link\">OCORREU UM ERRO DE CONEXÃO!</b> Tente novamente.
      </div>";
      header("Refresh: 3; url={$site}{$Url[0]}/enderecos-delivery#adicionarbairro");
    endif;
  endif;
endif;




$addBairros = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if($addBairros && isset($addBairros['sendAddBairro'])):
  unset($addBairros['sendAddBairro']);

  $addBairros = array_map('strip_tags', $addBairros);
  $addBairros = array_map('trim', $addBairros);

  if(in_array('', $addBairros) || in_array('null', $addBairros)):
    echo "<div class=\"alert alert-info alert-dismissable\">
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
  Preencha todos os campos!
  </div>";
else:
  $addBairros['bairro'] = tratar_nome($addBairros['bairro']);
  $addBairros['taxa'] = Check::Valor($addBairros['taxa']);

  $lerbanco->ExeRead('bairros_delivery', "WHERE user_id = :userid AND (uf = :u AND cidade = :c AND bairro = :v)", "userid={$userlogin['user_id']}&u={$addBairros['uf']}&c={$addBairros['cidade']}&v={$addBairros['bairro']}");

  if(!$lerbanco->getResult()):   
    $addbanco->ExeCreate("bairros_delivery", $addBairros);
    if($addbanco->getResult()):                        
      echo "<div class=\"alert alert-success alert-dismissable\">
      <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
      <b class=\"alert-link\">SUCESSO!</b> Bairro inserido no sistema.
      </div>";
    else:
      echo "<div class=\"alert alert-danger alert-dismissable\">
      <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
      <b class=\"alert-link\">OCORREU UM ERRO TENTE NOVAMENTE!</b> Tente novamente.
      </div>";
    endif;
  else:
    echo "<div class=\"alert alert-info alert-dismissable\">
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
    Você já cadastrou esse bairro!
    </div>";
  endif;
endif;
endif;
?>
<form class="form-horizontal" action="#adicionarbairro" role="form" method="post">
 <br />
 <div class="form-group"> 
   <label class="col-sm-2 control-label">UF:</label>       
   <div class="col-sm-10">
     <select required class="form-control" name="uf" id="estados2">     
     </select>
   </div>
 </div><div class="form-group"> 
   <label class="col-sm-2 control-label">Cidade:</label>       
   <div class="col-sm-10">
     <select required class="form-control" name="cidade" id="cidades2">    
     </select>
   </div>
 </div>
 <div class="form-group">
  <label class="col-sm-2 control-label">Bairro:</label>
  <div class="col-sm-10">
   <div class="input-group">
    <span class="input-group-addon"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>
    <input type="text" required name="bairro" class="form-control" placeholder="Nome do bairro...">
  </div>
</div>
</div>

 <div class="form-group">
  <label class="col-sm-2 control-label">Taxa:</label>
  <div class="col-sm-10">
   <div class="input-group">
    <span class="input-group-addon"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>
    <input type="text" required name="taxa" maxlength="11" onkeypress="return formatar_moeda(this, '.', ',', event);" data-mask="#.##0,00" data-mask-reverse="true" class="form-control" placeholder="0,00">
  </div>
</div>
</div>
<input type="hidden" name="user_id" value="<?=$userlogin['user_id'];?>">
<input type="submit" name="sendAddBairro" value="Cadastrar Endereço" class="btn btn-success" />
<br />
<br />

<div class="form-group">        
 <div class="col-sm-10">
   <?php
   $lerbanco->ExeRead("bairros_delivery", "WHERE user_id = :userid ORDER BY id DESC", "userid={$userlogin['user_id']}");
   if($lerbanco->getResult()):
     foreach($lerbanco->getResult() as $tt):
       extract($tt);                                    
       ?>     

       <a title="Deletar" href="<?=$site.$Url[0].'/enderecos-delivery&delete='.$id.'#adicionarbairro';?>">
                  <button style="margin-top: 3px;" type="button" class="btn btn-danger">
                    <strong><?=$bairro.' (R$ '.Check::real($taxa).')';?> = </strong> <span class="glyphicon glyphicon-trash"></span>
                  </button>
                </a><br />
       <?php
     endforeach;
   endif;
   ?>
 </div>
</div>


</form>
<br />
<div class="alert alert-info fade in nomargin">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <h4><i class="icon-attach-3"></i> NOTAS!</h4>
  <p>
   <i class="fa fa-exclamation-circle" aria-hidden="true"></i> Se não for inserido nenhum endereço aqui nessa página, o sistema vai tomar como base apenas "UF E CIDADE" cadastrado na página configurações! isso e aconselhado em cidades pequenas com uma taxa fixa de delivery.
 </p>

</div>
</div>
</div>
</div>