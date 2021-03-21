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

<style type="text/css">
/**************************************
/************ CSS ICONES *************
**************************************/
.paymentWrap {
 padding: 20px;

}

.paymentWrap .paymentBtnGroup {
 margin: auto;
}

.paymentWrap .paymentBtnGroup .paymentMethod {
 padding: 20px;
 box-shadow: none;
 position: relative;

}

.paymentWrap .paymentBtnGroup .paymentMethod.active {
 outline: none !important;
}

.paymentWrap .paymentBtnGroup .paymentMethod.active .method {
 border-color: #4cd264;
 outline: none !important;

}

.paymentWrap .paymentBtnGroup .paymentMethod .method {
 position: absolute;
 right: 0px;
 top: 3px;
 bottom: 3px;
 left: 0px;
 background-size: 20px auto;
 background-position: center;
 background-repeat: no-repeat;
 border: 2px solid transparent;
 transition: all 0.5s;
}

.paymentWrap .paymentBtnGroup .paymentMethod .method.hamburgers {
 background-image: url("<?=$site;?>img/burger.png");
 background-size: 30px auto;

}

.paymentWrap .paymentBtnGroup .paymentMethod .method.cachorro-quente {
 background-image: url("<?=$site;?>img/hot-dog.png");
 background-size: 30px auto;

}
.paymentWrap .paymentBtnGroup .paymentMethod .method.taco {
 background-image: url("<?=$site;?>img/taco.png");
 background-size: 30px auto;

}
.paymentWrap .paymentBtnGroup .paymentMethod .method.pizza {
 background-image: url("<?=$site;?>img/pizza.png");
 background-size: 30px auto;

}
.paymentWrap .paymentBtnGroup .paymentMethod .method.lemonade {
 background-image: url("<?=$site;?>img/lemonade.png");
 background-size: 30px auto;

}
.paymentWrap .paymentBtnGroup .paymentMethod .method.can {
 background-image: url("<?=$site;?>img/can.png");
 background-size: 30px auto;

}
.paymentWrap .paymentBtnGroup .paymentMethod .method.beer {
 background-image: url("<?=$site;?>img/beer.png");
 background-size: 30px auto;

}
.paymentWrap .paymentBtnGroup .paymentMethod .method.water {
 background-image: url("<?=$site;?>img/water.png");
 background-size: 30px auto;

}
.paymentWrap .paymentBtnGroup .paymentMethod .method.acai {
 background-image: url("<?=$site;?>img/acai.png");
 background-size: 30px auto;

}
.paymentWrap .paymentBtnGroup .paymentMethod .method.bolos {
 background-image: url("<?=$site;?>img/bolos.png");
 background-size: 30px auto;

}
.paymentWrap .paymentBtnGroup .paymentMethod .method.cupcake {
 background-image: url("<?=$site;?>img/cupcake.png");
 background-size: 30px auto;

}
.paymentWrap .paymentBtnGroup .paymentMethod .method.ice-cream {
 background-image: url("<?=$site;?>img/ice-cream.png");
 background-size: 30px auto;


}
.paymentWrap .paymentBtnGroup .paymentMethod .method.truffle {
 background-image: url("<?=$site;?>img/truffle.png");
 background-size: 30px auto;


}
.paymentWrap .paymentBtnGroup .paymentMethod .method.bitterballen2 {
 background-image: url("<?=$site;?>img/bitterballen2.png");
 background-size: 30px auto;

}
.paymentWrap .paymentBtnGroup .paymentMethod .method.bitterballen {
 background-image: url("<?=$site;?>img/bitterballen.png");
 background-size: 30px auto;

}

.paymentWrap .paymentBtnGroup .paymentMethod .method.breakfast {
 background-image: url("<?=$site;?>img/breakfast.png");
 background-size: 30px auto;

}
.paymentWrap .paymentBtnGroup .paymentMethod .method.chopping {
 background-image: url("<?=$site;?>img/chopping.png");
 background-size: 30px auto;

}
.paymentWrap .paymentBtnGroup .paymentMethod .method.grill {
 background-image: url("<?=$site;?>img/grill.png");
 background-size: 30px auto;

}
.paymentWrap .paymentBtnGroup .paymentMethod .method.sopa {
 background-image: url("<?=$site;?>img/sopa.png");
 background-size: 30px auto;

}

.paymentWrap .paymentBtnGroup .paymentMethod .method.macarrao {
 background-image: url("<?=$site;?>img/macarao.png");
 background-size: 30px auto;

}

.paymentWrap .paymentBtnGroup .paymentMethod .method.pastel {
 background-image: url("<?=$site;?>img/spirra.png");
 background-size: 30px auto;

}

.paymentWrap .paymentBtnGroup .paymentMethod .method.espetinho {
 background-image: url("<?=$site;?>img/espetinho.png");
 background-size: 30px auto;

}

.paymentWrap .paymentBtnGroup .paymentMethod .method.coxasfrango {
 background-image: url("<?=$site;?>img/coxasfrango.png");
 background-size: 30px auto;

}

.paymentWrap .paymentBtnGroup .paymentMethod .method.combopizza {
 background-image: url("<?=$site;?>img/combopizza.png");
 background-size: 30px auto;

}

.paymentWrap .paymentBtnGroup .paymentMethod .method.combohamburgue {
 background-image: url("<?=$site;?>img/combohamburgue.png");
 background-size: 30px auto;

}

.paymentWrap .paymentBtnGroup .paymentMethod .method.combopipoca {
 background-image: url("<?=$site;?>img/combopipoca.png");
 background-size: 30px auto;

}

.paymentWrap .paymentBtnGroup .paymentMethod .method.refrigerantes {
 background-image: url("<?=$site;?>img/refrigerantes.png");
 background-size: 30px auto;

}

.paymentWrap .paymentBtnGroup .paymentMethod .method.vinho {
 background-image: url("<?=$site;?>img/vinho.png");
 background-size: 30px auto;

}

.paymentWrap .paymentBtnGroup .paymentMethod .method.catchup {
 background-image: url("<?=$site;?>img/catchup.png");
 background-size: 30px auto;

}

.paymentWrap .paymentBtnGroup .paymentMethod .method.petisco {
 background-image: url("<?=$site;?>img/petisco.png");
 background-size: 30px auto;

}

.paymentWrap .paymentBtnGroup .paymentMethod .method.salgadinhos {
 background-image: url("<?=$site;?>img/salgadinhos.png");
 background-size: 30px auto;

}

.paymentWrap .paymentBtnGroup .paymentMethod .method.camarao {
 background-image: url("<?=$site;?>img/camarao.png");
 background-size: 30px auto;

}

.paymentWrap .paymentBtnGroup .paymentMethod .method.peixe {
 background-image: url("<?=$site;?>img/peixe.png");
 background-size: 30px auto;

}

.paymentWrap .paymentBtnGroup .paymentMethod .method.japonesa {
 background-image: url("<?=$site;?>img/japonesa.png");
 background-size: 30px auto;

}

.paymentWrap .paymentBtnGroup .paymentMethod .method.frutas {
 background-image: url("<?=$site;?>img/frutas.png");
 background-size: 30px auto;

}

.paymentWrap .paymentBtnGroup .paymentMethod .method.legumes {
 background-image: url("<?=$site;?>img/legumes.png");
 background-size: 30px auto;

}

.paymentWrap .paymentBtnGroup .paymentMethod .method.sacolamercado {
 background-image: url("<?=$site;?>img/sacolamercado.png");
 background-size: 30px auto;

}

.paymentWrap .paymentBtnGroup .paymentMethod .method.carvao {
 background-image: url("<?=$site;?>img/carvao.png");
 background-size: 30px auto;

}

.paymentWrap .paymentBtnGroup .paymentMethod .method.biscoitos {
 background-image: url("<?=$site;?>img/biscoitos.png");
 background-size: 30px auto;

}

.paymentWrap .paymentBtnGroup .paymentMethod .method.picole {
 background-image: url("<?=$site;?>img/picole.png");
 background-size: 30px auto;

}

.paymentWrap .paymentBtnGroup .paymentMethod .method.chocolate {
 background-image: url("<?=$site;?>img/chocolate.png");
 background-size: 30px auto;

}

.paymentWrap .paymentBtnGroup .paymentMethod .method.doces {
 background-image: url("<?=$site;?>img/doces.png");
 background-size: 30px auto;

}

.paymentWrap .paymentBtnGroup .paymentMethod .method.leite {
 background-image: url("<?=$site;?>img/leite.png");
 background-size: 30px auto;

}

.paymentWrap .paymentBtnGroup .paymentMethod .method.drink {
 background-image: url("<?=$site;?>img/drink.png");
 background-size: 30px auto;

}

.paymentWrap .paymentBtnGroup .paymentMethod .method.queijo {
 background-image: url("<?=$site;?>img/queijo.png");
 background-size: 30px auto;

}

.paymentWrap .paymentBtnGroup .paymentMethod .method.bolassorvete {
 background-image: url("<?=$site;?>img/bolassorvete.png");
 background-size: 30px auto;

}

.paymentWrap .paymentBtnGroup .paymentMethod .method.sacola {
 background-image: url("<?=$site;?>img/sacola.png");
 background-size: 30px auto;

}

.paymentWrap .paymentBtnGroup .paymentMethod .method.bandeja {
 background-image: url("<?=$site;?>img/bandeja.png");
 background-size: 30px auto;

}

.paymentWrap .paymentBtnGroup .paymentMethod .method:hover {
 border-color: #4cd264;
 outline: none !important;
}

</style>

<div id="categorias"></div>
<div style="background-color:#ffffff;" class="container margin_60">
 <div class="row"> 
  <div class="col-md-8 col-md-offset-2"> 
   <div id="sendnewpass" class="indent_title_in">
    <i class="fa fa-tags" aria-hidden="true"></i>
    <h3>CATEGORIAS:</h3>
    <p><span style="color: red;">** A seleção de icone e uma opção!<br /><b>OBS:</b> Coloque as categorias na sequência que você quer que apareça para o cliente.</span></p>
  </div>
  <?php
  $capturacat = filter_input_array(INPUT_POST, FILTER_DEFAULT);

  if(!empty($capturacat['cadastrarcategoria'])):
   unset($capturacat['cadastrarcategoria']);

   $capturacat = array_map('strip_tags', $capturacat);
   $capturacat = array_map('trim', $capturacat);

   if(empty($capturacat['desc_cat'])):
    $capturacat['desc_cat'] = 'null';       
  endif;

   if(empty($capturacat['icon_cat'])):
    $capturacat['icon_cat'] = 'null';       
  endif;

  if(empty($capturacat['nome_cat'])):
    echo "<div class=\"alert alert-info alert-dismissable\">
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
    Escreva o nome da categoria!
    </div>"; 
  else:

    $addbanco->ExeCreate("ws_cat", $capturacat);
    header("Location: {$site}{$Url[0]}/categoria");
  endif;



endif;
?>
<form class="form-horizontal" id="formaddacate" method="post">
 <br />
 <div class="form-group">
  <label class="col-sm-2 control-label"><span style="color: red;">*</span> Categoria:</label>
  <div class="col-sm-10">
   <div class="input-group">
    <span class="input-group-addon"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
    <input type="text" name="nome_cat" class="form-control" placeholder="Nome da categoria...">
    <input type="hidden" name="user_id" value="<?=$userlogin['user_id'];?>" />
  </div>
</div>
</div>

<div class="form-group">
  <label class="col-sm-2 control-label">Descrição:</label>
  <div class="col-sm-10">
   <div class="input-group">
    <span class="input-group-addon"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
    <input type="text" name="desc_cat" class="form-control" placeholder="Descrição da categoria...">
  </div>
</div>
</div>

<div class="form-group">
  <label class="col-sm-2 control-label">Icone:</label>
  <div class="col-sm-10">
   <div class="input-group">
     <div class="paymentWrap">
      <div class="btn-group paymentBtnGroup btn-group-justified" data-toggle="buttons"> 
       <b style="margin: 2px;">           
        <label class="btn paymentMethod">
         <div class="method hamburgers"></div>
         <input type="radio" class="input" name="icon_cat" value="img/burger.png"> 
       </label>
     </b>
     <b style="margin: 2px;"> 
      <label class="btn paymentMethod">
       <div class="method cachorro-quente"></div>
       <input type="radio" class="input" name="icon_cat" value="img/hot-dog.png"> 
     </label>
   </b>
   <b style="margin: 2px;"> 
    <label class="btn paymentMethod">
     <div class="method taco"></div>
     <input type="radio" class="input" name="icon_cat" value="img/taco.png"> 
   </label>
 </b>
 <b style="margin: 2px;"> 
  <label class="btn paymentMethod">
   <div class="method pizza"></div>
   <input type="radio" class="input" name="icon_cat" value="img/pizza.png">
 </label>
</b>
<b style="margin: 2px;"> 
  <label class="btn paymentMethod">
   <div class="method lemonade"></div>
   <input type="radio" class="input" name="icon_cat" value="img/lemonade.png"> 
 </label>
</b>
<b style="margin: 2px;"> 
  <label class="btn paymentMethod">
   <div class="method can"></div>
   <input type="radio" class="input" name="icon_cat" value="img/can.png"> 
 </label>
</b>
<b style="margin: 2px;"> 
  <label class="btn paymentMethod">
   <div class="method beer"></div>
   <input type="radio" class="input" name="icon_cat" value="img/beer.png"> 
 </label>
</b>
<b style="margin: 2px;"> 
  <label class="btn paymentMethod">
   <div class="method water"></div>
   <input type="radio" class="input" name="icon_cat" value="img/water.png"> 
 </label>
</b>
<b style="margin: 2px;"> 
  <label class="btn paymentMethod">
   <div class="method acai"></div>
   <input type="radio" class="input" name="icon_cat" value="img/acai.png"> 
 </label>
</b>
<b style="margin: 2px;"> 
  <label class="btn paymentMethod">
   <div class="method bolos"></div>
   <input type="radio" class="input" name="icon_cat" value="img/bolos.png"> 
 </label>
</b>
<b style="margin: 2px;"> 
  <label class="btn paymentMethod">
   <div class="method cupcake"></div>
   <input type="radio" class="input" name="icon_cat" value="img/cupcake.png"> 
 </label>
</b>
<b style="margin: 2px;"> 
  <label class="btn paymentMethod">
   <div class="method ice-cream"></div>
   <input type="radio" class="input" name="icon_cat" value="img/ice-cream.png"> 
 </label>
</b>
<b style="margin: 2px;"> 
  <label class="btn paymentMethod">
   <div class="method truffle"></div>
   <input type="radio" class="input" name="icon_cat" value="img/truffle.png"> 
 </label>
</b>
<b style="margin: 2px;"> 
  <label class="btn paymentMethod">
   <div class="method bitterballen2"></div>
   <input type="radio" class="input" name="icon_cat" value="img/bitterballen2.png"> 
 </label>
</b>
<b style="margin: 2px;"> 
  <label class="btn paymentMethod">
   <div class="method bitterballen"></div>
   <input type="radio" class="input" name="icon_cat" value="img/bitterballen.png"> 
 </label>
</b>
<b style="margin: 2px;"> 
  <label class="btn paymentMethod">
   <div class="method breakfast"></div>
   <input type="radio" class="input" name="icon_cat" value="img/breakfast.png"> 
 </label>
</b>
<b style="margin: 2px;"> 
  <label class="btn paymentMethod">
   <div class="method chopping"></div>
   <input type="radio" class="input" name="icon_cat" value="img/chopping.png"> 
 </label>
</b>
<b style="margin: 2px;"> 
  <label class="btn paymentMethod">
   <div class="method grill"></div>
   <input type="radio" class="input" name="icon_cat" value="img/grill.png"> 
 </label>
</b>

<b style="margin: 2px;"> 
  <label class="btn paymentMethod">
   <div class="method sopa"></div>
   <input type="radio" class="input" name="icon_cat" value="img/sopa.png"> 
 </label>
</b>

<b style="margin: 2px;"> 
  <label class="btn paymentMethod">
   <div class="method macarrao"></div>
   <input type="radio" class="input" name="icon_cat" value="img/macarao.png"> 
 </label>
</b>

<b style="margin: 2px;"> 
  <label class="btn paymentMethod">
   <div class="method pastel"></div>
   <input type="radio" class="input" name="icon_cat" value="img/spirra.png"> 
 </label>
</b>

<b style="margin: 2px;"> 
  <label class="btn paymentMethod">
   <div class="method espetinho"></div>
   <input type="radio" class="input" name="icon_cat" value="img/espetinho.png"> 
 </label>
</b>

<b style="margin: 2px;"> 
  <label class="btn paymentMethod">
   <div class="method coxasfrango"></div>
   <input type="radio" class="input" name="icon_cat" value="img/coxasfrango.png"> 
 </label>
</b>

<b style="margin: 2px;"> 
  <label class="btn paymentMethod">
   <div class="method combopizza"></div>
   <input type="radio" class="input" name="icon_cat" value="img/combopizza.png"> 
 </label>
</b>

<b style="margin: 2px;"> 
  <label class="btn paymentMethod">
   <div class="method combohamburgue"></div>
   <input type="radio" class="input" name="icon_cat" value="img/combohamburgue.png"> 
 </label>
</b>

<b style="margin: 2px;"> 
  <label class="btn paymentMethod">
   <div class="method combopipoca"></div>
   <input type="radio" class="input" name="icon_cat" value="img/combopipoca.png"> 
 </label>
</b>

<b style="margin: 2px;"> 
  <label class="btn paymentMethod">
   <div class="method refrigerantes"></div>
   <input type="radio" class="input" name="icon_cat" value="img/refrigerantes.png"> 
 </label>
</b>

<b style="margin: 2px;"> 
  <label class="btn paymentMethod">
   <div class="method vinho"></div>
   <input type="radio" class="input" name="icon_cat" value="img/vinho.png"> 
 </label>
</b>

<b style="margin: 2px;"> 
  <label class="btn paymentMethod">
   <div class="method catchup"></div>
   <input type="radio" class="input" name="icon_cat" value="img/catchup.png"> 
 </label>
</b>

<b style="margin: 2px;"> 
  <label class="btn paymentMethod">
   <div class="method petisco"></div>
   <input type="radio" class="input" name="icon_cat" value="img/petisco.png"> 
 </label>
</b>

<b style="margin: 2px;"> 
  <label class="btn paymentMethod">
   <div class="method salgadinhos"></div>
   <input type="radio" class="input" name="icon_cat" value="img/salgadinhos.png"> 
 </label>
</b>

<b style="margin: 2px;"> 
  <label class="btn paymentMethod">
   <div class="method camarao"></div>
   <input type="radio" class="input" name="icon_cat" value="img/camarao.png"> 
 </label>
</b>

<b style="margin: 2px;"> 
  <label class="btn paymentMethod">
   <div class="method peixe"></div>
   <input type="radio" class="input" name="icon_cat" value="img/peixe.png"> 
 </label>
</b>

<b style="margin: 2px;"> 
  <label class="btn paymentMethod">
   <div class="method japonesa"></div>
   <input type="radio" class="input" name="icon_cat" value="img/japonesa.png"> 
 </label>
</b>

<b style="margin: 2px;"> 
  <label class="btn paymentMethod">
   <div class="method frutas"></div>
   <input type="radio" class="input" name="icon_cat" value="img/frutas.png"> 
 </label>
</b>

<b style="margin: 2px;"> 
  <label class="btn paymentMethod">
   <div class="method legumes"></div>
   <input type="radio" class="input" name="icon_cat" value="img/legumes.png"> 
 </label>
</b>

<b style="margin: 2px;"> 
  <label class="btn paymentMethod">
   <div class="method sacolamercado"></div>
   <input type="radio" class="input" name="icon_cat" value="img/sacolamercado.png"> 
 </label>
</b>

<b style="margin: 2px;"> 
  <label class="btn paymentMethod">
   <div class="method carvao"></div>
   <input type="radio" class="input" name="icon_cat" value="img/carvao.png"> 
 </label>
</b>

<b style="margin: 2px;"> 
  <label class="btn paymentMethod">
   <div class="method biscoitos"></div>
   <input type="radio" class="input" name="icon_cat" value="img/biscoitos.png"> 
 </label>
</b>

<b style="margin: 2px;"> 
  <label class="btn paymentMethod">
   <div class="method picole"></div>
   <input type="radio" class="input" name="icon_cat" value="img/picole.png"> 
 </label>
</b>

<b style="margin: 2px;"> 
  <label class="btn paymentMethod">
   <div class="method chocolate"></div>
   <input type="radio" class="input" name="icon_cat" value="img/chocolate.png"> 
 </label>
</b>

<b style="margin: 2px;"> 
  <label class="btn paymentMethod">
   <div class="method doces"></div>
   <input type="radio" class="input" name="icon_cat" value="img/doces.png"> 
 </label>
</b>

<b style="margin: 2px;"> 
  <label class="btn paymentMethod">
   <div class="method leite"></div>
   <input type="radio" class="input" name="icon_cat" value="img/leite.png"> 
 </label>
</b>

<b style="margin: 2px;"> 
  <label class="btn paymentMethod">
   <div class="method drink"></div>
   <input type="radio" class="input" name="icon_cat" value="img/drink.png"> 
 </label>
</b>

<b style="margin: 2px;"> 
  <label class="btn paymentMethod">
   <div class="method queijo"></div>
   <input type="radio" class="input" name="icon_cat" value="img/queijo.png"> 
 </label>
</b>

<b style="margin: 2px;"> 
  <label class="btn paymentMethod">
   <div class="method bolassorvete"></div>
   <input type="radio" class="input" name="icon_cat" value="img/bolassorvete.png"> 
 </label>
</b>

<b style="margin: 2px;"> 
  <label class="btn paymentMethod">
   <div class="method sacola"></div>
   <input type="radio" class="input" name="icon_cat" value="img/sacola.png"> 
 </label>
</b>

<b style="margin: 2px;"> 
  <label class="btn paymentMethod">
   <div class="method bandeja"></div>
   <input type="radio" class="input" name="icon_cat" value="img/bandeja.png"> 
 </label>
</b>
</div>        
</div>
</div>
</div>
</div>

<div class="form-group"> 
  <div class="col-sm-10">
    <input type="submit" name="cadastrarcategoria" class="btn btn-success" value="Criar Categoria">
  </div>
</div>
</form>
</div>
</div>


<div class="form-group"> 
 <div class="col-sm-10">
   <?php
   $lerbanco->ExeRead("ws_cat", "WHERE user_id = :userid", "userid={$userlogin['user_id']}");
   if($lerbanco->getResult()):
    echo " <b>Escolha uma Ação:</b><br />";
    foreach($lerbanco->getResult() as $tt):
     extract($tt);                                    
     ?>
     <a href="<?=$site.$Url[0].'/upcategoria&id='.$id.'#upcat';?>"><button style="margin-top:4px;" type="button" class="btn btn-info"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <?=$nome_cat;?> </button></a>
     <?php
   endforeach;
 endif;
 ?>
 <br />
 <?php
 $lerbanco->ExeRead("ws_cat", "WHERE user_id = :userid", "userid={$userlogin['user_id']}");
 if($lerbanco->getResult()):
   foreach($lerbanco->getResult() as $tt):
     extract($tt);                                    
     ?>
     <a style="margin-top:4px;" type="button" class="btn btn-danger deletar_<?=$id;?>"><i class="fa fa-trash-o" aria-hidden="true"></i> <?=$nome_cat;?> </a>
     <script type="text/javascript">
      $(document).ready(function(){
        $(".deletar_<?=$id;?>").click(function(){
          GrowlNotification.notify({
            title: 'Atenção!',
            description: 'Tem certeza de que deseja deletar essa categoria? isso vai apagar todos os itens associados a ela.',
            type: 'error',
            image: {
              visible: true,
              customImage: '<?=$site;?>img/danger.png'
            },
            position: 'bottom-left',
            showProgress: true,
            showButtons: true,
            buttons: {
              action: {
                text: 'SIM',
                callback: function(){
                  $.ajax({
                    url: '<?=$site;?>includes/processadeletacat.php',
                    method: 'post',
                    data: {'idcat' : '<?=$id;?>', 'iduser' : '<?=$userlogin['user_id'];?>'}
                 });
                  setTimeout(function() {
                   window.location.replace('<?=$site.$Url[0].'/categoria';?>');
                     }, 2000);
                }
              },
              cancel: {
                text: 'NÃO'
              }
            },
            closeTimeout: 0
          });

        });
      });
    </script>
    <?php
  endforeach;
endif;
?>

<br />

</div>
</div>
</div>
</div>

<script type="text/javascript">$('.input').hide();</script>