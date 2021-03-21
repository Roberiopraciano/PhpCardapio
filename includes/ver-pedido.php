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


(int) $pegaId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if(empty($pegaId)):
  header("Location: {$site}");
else:
  $lerbanco->ExeRead('ws_pedidos', "WHERE user_id = :userid AND id = :f", "userid={$userlogin['user_id']}&f={$pegaId}");
  if (!$lerbanco->getResult()):
   header("Location: {$site}");
 else:
  foreach ($lerbanco->getResult() as $i):
    extract($i);
  endforeach;
endif;
endif;

?>

<div id="atualizaStatus"></div>
<div style="background-color:#ffffff;" class="container margin_60">

  <div class="big-title3 text-center">
    <h3 class="big_title3"><?=$codigo_pedido;?></h3>
    <p style=" border-bottom: 5px solid red;border-bottom-width: medium; padding-bottom: 10px;" class="title-para3">Código do Pedido!</p>
  </div>

  <?php
  $pegaStatusPost = filter_input_array(INPUT_POST, FILTER_DEFAULT); 

  if(!empty($pegaStatusPost)):

    unset($pegaStatusPost['enviarNovoStatus']);

    $pegaStatusPost = array_map('strip_tags', $pegaStatusPost);
    $pegaStatusPost = array_map('trim', $pegaStatusPost);

    if(in_array('', $pegaStatusPost) || in_array('null', $pegaStatusPost)):
      echo "<div class=\"alert alert-info alert-dismissable\">
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
    <center>Selecione todos os campos!</center>
    </div>";
  elseif(!isset($pegaStatusPost['status']) || $pegaStatusPost['status'] == ''):
    echo "<div class=\"alert alert-info alert-dismissable\">
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
    <center>Selecione um Status!</center>
    </div>";
  elseif(!isset($pegaStatusPost['campomsg']) || $pegaStatusPost['campomsg'] == ''):
    echo "<div class=\"alert alert-info alert-dismissable\">
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
    <center>Escreva uma mensagem para enviar ao ciente!</center>
    </div>";
  else:

    $textoGet = $pegaStatusPost['campomsg'];
    unset($pegaStatusPost['campomsg']);

    $pegaStatusPost['valor_troco'] = Check::Valor($pegaStatusPost['valor_troco']);

    $updatebanco->ExeUpdate("ws_pedidos", $pegaStatusPost, "WHERE user_id = :userid AND id = :up", "userid={$userlogin['user_id']}&up={$pegaStatusPost['id']}");
    if ($updatebanco->getResult()):
      echo "<div class=\"alert alert-success alert-dismissable\">
      <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
      <center>
      <b class=\"alert-link\">SUCESSO!</b> STATUS ATUALIZADO.
      </center>
      </div>";
      $telefone = preg_replace("/[^0-9]/", "", $telefone);
      $telefoneEmpresa = preg_replace("/[^0-9]/", "", $telefone_empresa);

      $empresaNome  = (!empty($nome_empresa) ? $nome_empresa : 'Nome_do_seu_negócio');
      $msgAenviar = "🔔 *{$empresaNome}*%0A%0A{$textoGet} %0A%0A*Desenvolvido por {$empresaNome}*";


      ?>
      <script type="text/javascript">
        var link1 = "https://api.whatsapp.com/send?phone=55<?=$telefone;?>&text=<?=$msgAenviar;?>";
        window.open( link1, "_blank");
      </script>
      <?php

      header("Refresh: 2; url={$site}{$Url[0]}/pedidos");
    else:
      echo "<div class=\"alert alert-danger alert-dismissable\">
      <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button><center>
      <b class=\"alert-link\">OCORREU UM ERRO!</b> Tente novamente.
      </center>
      </div>";
    endif;
  endif;
endif;
?>

<style type="text/css">
  #divImprimir{
   size: auto;

   margin: 2mm 2mm 2mm 2mm;  

   font-family: monospace;

   font-size: 9pt;

   width: 80mm;
 }
</style>

<center>
  <a href="<?=$site,$Url[0];?>/pedidos"><button class="btn_1"><i class="fa fa-reply" aria-hidden="true"></i> voltar</button></a>

  <a href="https://api.whatsapp.com/send?phone=55<?=$telefone;?>&text=🔔 Olá, você acaba de realizar um pedido conosco. Estamos ansiosos para lhe atender. Podemos confirmar o pedido?"><button class="btn_1">Confirmar o Pedido <i class="fa fa-arrow-right" aria-hidden="true"></i></button></a>
</center>
<div> 
  <div class="container">
    <div style="margin: 0 auto;align-items: center;display: flex;flex-direction: row;flex-wrap: wrap;justify-content: center;" class="row justify-content-center ">
      <article class="col-md-4">
        <div id="divImprimir" style="background-color: #fdfbe3;" class="boxed-md boxed-padded">
          <?php

          $dataex = explode(' ', $data);
          $dataex[0] = explode('-', $dataex[0]);
          $dataex[0] = array_reverse($dataex[0]);
          $dataex[0] = implode('/', $dataex[0]);

          $dataformatada =  $dataex[0].' - '.$dataex[1];

          $nome = str_replace('%20', ' ', $nome);
          $nomeCliente = $nome;
          $telefoneformatado = formatPhone($telefone);

          $taxaPedido = Check::Real($valor_taxa);
          $valorTroco = Check::Real($valor_troco);
          $totalPedido = Check::Real($total);

          $resumoPedidosFormatado = str_replace('*', '', $resumo_pedidos);
          $resumoPedidosFormatado = str_replace('<b>', '', $resumoPedidosFormatado);
          $resumoPedidosFormatado = str_replace('</b>', '', $resumoPedidosFormatado);

          $telefoneEmpresaFormatado = formatPhone($telefone_empresa);

          echo "<b>".$nome_empresa."</b>";
          echo ".\n <br />";

          echo (!empty($end_rua_n_empresa) && !empty($end_bairro_empresa) && !empty($cidade_empresa) && !empty($end_uf_empresa) ? $end_rua_n_empresa.' <br /> '.$end_bairro_empresa : 'Defina_um_endereço').' - '.$cidade_empresa.' - '.$end_uf_empresa;
          echo "\n <br />";
          echo "Telefone: {$telefoneEmpresaFormatado}";


          echo "\n <br />";
          echo "\n <br />";

          echo "<b>PEDIDO: #{$codigo_pedido}</b>\n <br />";    
          echo "{$dataformatada} <br />";  
          echo "\n <br />";
          echo "-----------------------------"."\n  <br />";      
          if($opcao_delivery != 'true'):
            echo "{$msg_delivery_false}\n  <br />";
            echo "Observações: {$name_observacao_mesa}\n  <br />";
          else:
            echo "Rua: {$rua}, Nº {$unidade}\n  <br />";
            echo "Bairro: {$bairro}\n  <br />";
            echo "Cidade: {$cidade} - {$uf}\n  <br />";
            echo "Complemento: {$complemento}\n  <br />";
            echo "Observação: {$observacao}\n  <br />";
          endif;
          echo "-----------------------------"."\n  <br />"; 
          echo "\n <br />";  


          echo "DADOS DO CLIENTE: <br />";

          echo "NOME: {$nomeCliente}\n  <br />";
          echo "TEL: {$telefoneformatado}\n  <br />";  

          echo "-----------------------------"."\n  <br />"; 
                    echo "\n <br />"; 

          echo "RESUMO DO PEDIDO: <br />";
          echo "{$resumoPedidosFormatado}";
          
           echo "-----------------------------"."\n  <br />";  

          echo "PAGAMENTO: {$forma_pagamento}\n  <br />";
          echo (!empty($sub_total) || $sub_total != '0.00' ? "SUBTOTAL: R$ ".Check::Real($sub_total)." \n <br />" : "" );
          if(!empty($desconto) && $desconto != 0):
            echo "DESCONTO: {$desconto}% \n <br />";
          endif;
          if($valor_taxa != '0.00'):
            echo "DELIVERY: R$ {$taxaPedido}\n  <br />";
          endif;                    
          echo "TOTAL: R$ {$totalPedido} \n <br />";
          if(!empty($valor_troco) && $valor_troco != '0.00'):
            echo "TROCO PARA: R$ {$valorTroco}\n  <br />";
          endif;
          echo "-----------------------------"." \n <br />";
          
          echo "\n <br />";

          echo "***OBRIGADO E BOM APETITE*** \n <br />";
          ?>
        </div>
      </article>
    </div>
  </div>
</div>

<center>
 <a style="margin: 15px;" id="botaoPrint" class="btn btn-primary"><i class="icon-print-2"></i> Imprimir Pedido</a>
</center>
<div class="container">
  <div style="margin: 0 auto;align-items: center;display: flex;flex-direction: row;flex-wrap: wrap;justify-content: center;" class="row justify-content-center ">

    <form method="post" action="#atualizaStatus">
      <div class="text__center">
        <h3>Status do pedido: <strong><?=$status;?></strong></h3>

        <select name="status" required class="form-control status">
         <option value="" disabled selected><b>Atualizar Status</b></option>
         <?php
         if($opcao_delivery == 'true'):
          ?>
          <option value="Em Andamento">Em Andamento</option>
          <option value="Saiu para Entrega">Saiu para Entrega</option>            
          <option value="Finalizado">Finalizado</option>
          <option value="Cancelado">Cancelado</option>
          <?php
        else:
          ?>
          <option value="Em Andamento">Em Andamento</option>
          <option value="Disponível para Retirada">Disponível para Retirada</option> 
          <option value="Finalizado">Finalizado</option>
          <option value="Cancelado">Cancelado</option>
          <?php
        endif;
        ?> 
      </select>




    </div>
    <div class="form-group green-border-focus">
      <label for="exampleFormControlTextarea5"></label>
      <textarea id="campomsg" name="campomsg" required class="form-control" rows="5" ></textarea>
      <center><small>Essa msg será enviada ao cliente pelo whatsapp.</small></center>
    </div>

    <input type="hidden" name="id" value="<?=$id;?>">
    <hr />
    <div class="form-group">
      <label for="forma_pagamento"><span style="color: red;">* </span><?=$texto['msg_f_pagamento'];?></label>
      <select class="form-control" required name="forma_pagamento" id="forma_pagamento">  
        <?php 
        $lerbanco->ExeRead('ws_formas_pagamento', 'WHERE user_id = :idus', "idus={$getu}");
        if($lerbanco->getResult()):
          foreach ($lerbanco->getResult() as $getBancoBairros):
            extract($getBancoBairros);
            ?>
            <option value="<?=$f_pagamento;?>"><?=$f_pagamento;?></option>
            <?php
          endforeach;
        endif;

        ?>
      </select>
    </div>
    <div class="form-group">
      <label for="valor_troco"><span style="color: red;">* </span><?=$texto['msg_troco'];?></label>
      <input required type="tel" maxlength="11" data-mask="#.##0,00" data-mask-reverse="true" name="valor_troco" id="valor_troco" class="form-control" placeholder="0,00" />
    </div>

    <input type="hidden" name="enviarNovoStatus" value="true" />
    <center><button type="input" class="btn_1">SALVAR ALTERAÇAO</button></center>

  </form>
</div></div>
</div>
<br />
<div class="alert alert-info container margin_60">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <h4><i class="icon-attach-3"></i> NOTAS!</h4>
  <p>
   <strong style="color: red;">Não envia a mensagem para o whatsapp do cliente!</strong> se estiver em um computador verifique se seu navegador não esta bloqueando pop-ups.<br /> 
   <strong style="color: red;">Erro com impressão em térmicas!</strong> Tente atualizar os drivers da impressora!

 </p>

</div>



<script type="text/javascript" charset="utf-8">
  $(document).ready(function(){
    $('#botaoPrint').click(function(){
      $('#divImprimir').printThis({
        doctypeString: '<meta charset="utf-8">', 
        importStyle: true,
        base: false,
      });
    });
  });
</script>



<script type="text/javascript"> 
  $(document).ready(function() {
    $('.status').change(function (){
     var newStatus = $(this).val();

     if(newStatus == 'Em Andamento'){
      $("#campomsg").val('Ola! Já estamos preparando seu pedido.');
    }else if(newStatus == 'Saiu para Entrega'){
      $("#campomsg").val('Ola! O seu pedido está a caminho.');
    }else if(newStatus == 'Disponível para Retirada'){
      $("#campomsg").val('Ola! Seu pedido já esta disponível para retirada em nosso estabelecimento.');
    }else if(newStatus == 'Finalizado'){
      $("#campomsg").val('Pedido entregue! Obrigado pela preferência.');
    }else if(newStatus == 'Cancelado'){
      $("#campomsg").val('Ola! Seu pedido foi cancelado.');
    }    
  });
  });
</script>

<script type="text/javascript">

    //Recupera o valor para validar o campo troco.
    $('#forma_pagamento').change(function (){

      var tell = $(this).val();
      
      if (tell == "Dinheiro" || tell == "DINHEIRO" || tell == "dinheiro") {
        $('#valor_troco').prop('disabled', false);
      }
      else {
        $('#valor_troco').val('0,00');
        $('#valor_troco').prop('disabled', true);
      }
    });
  </script>

