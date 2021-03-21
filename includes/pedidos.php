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

$pesquisar = filter_input(INPUT_GET, 's', FILTER_DEFAULT);    
$a = filter_input(INPUT_GET, 'status', FILTER_DEFAULT);
$a = urldecode($a);
?>
<!-- INICIO DA TABELA DE SERVICOS -->
<div style="background-color:#ffffff;" class="container margin_60"> 
  <div class="indent_title_in">
    <i class="fa fa-cutlery" aria-hidden="true"></i>
    <h3>PEDIDOS!</h3>
    <p style="color: red;"><b><span>*</span> Mantenha essa página aberta! A cada minuto ela te atualiza sobre os pedidos!</b></p>
  </div>
  <style type="text/css">
    #custom-search-input{
      padding: 3px;
      border: solid 1px #E4E4E4;
      border-radius: 6px;
      background-color: #fff;
    }

    #custom-search-input input{
      border: 0;
      box-shadow: none;
    }

    #custom-search-input button{
      margin: 2px 0 0 0;
      background: none;
      box-shadow: none;
      border: 0;
      color: #666666;
      padding: 0 8px 0 10px;
      border-left: solid 1px #ccc;
    }

    #custom-search-input button:hover{
      border: 0;
      box-shadow: none;
      border-left: solid 1px #ccc;
    }

    #custom-search-input .glyphicon-search{
      font-size: 23px;
    }
  </style>
  <div style="margin: 0 auto;align-items: center;display: flex;flex-direction: row;flex-wrap: wrap;justify-content: center;" class="toolbar-btn-action">
    <a href="<?=$site.$Url[0].'/pedidos';?>" class="btn btn-default">Todos <i class="fa fa-cutlery" aria-hidden="true"></i></a>&nbsp;
    <a href="<?=$site.$Url[0].'/pedidos&status=Aberto'?>" class="btn btn-warning">Abertos <i class="fa fa-cutlery" aria-hidden="true"></i></a>&nbsp;
    <a href="<?=$site.$Url[0].'/pedidos&status=Em Andamento'?>" class="btn btn-info">Em Andamento <i class="fa fa-cutlery" aria-hidden="true"></i></a>&nbsp;
    <a href="<?=$site.$Url[0].'/pedidos&status=Disponível para Retirada'?>" class="btn btn-info">Disponível para Retirada <i class="fa fa-cutlery" aria-hidden="true"></i></a>&nbsp;
    <a href="<?=$site.$Url[0].'/pedidos&status=Saiu para Entrega'?>" class="btn btn-primary">Saiu para Entrega <i class="fa fa-cutlery" aria-hidden="true"></i></a>&nbsp;
    <a href="<?=$site.$Url[0].'/pedidos&status=Finalizado'?>" class="btn btn-success">Finalizados <i class="fa fa-cutlery" aria-hidden="true"></i></a>&nbsp;
    <a href="<?=$site.$Url[0].'/pedidos&status=Cancelado'?>" class="btn btn-danger">Cancelados <i class="fa fa-cutlery" aria-hidden="true"></i></a>
  </div>

  <div style="margin: 0 auto;align-items: center;display: flex;flex-direction: row;flex-wrap: wrap;justify-content: center;" class="container">
    <div class="row">
      <form action="#search" method="post">
        <div class="col-md-6">           
          <div id="custom-search-input">
            <div class="input-group col-md-12">
              <input type="text" name="s" class="form-control input-lg" placeholder="Código do pedido" />
              <span class="input-group-btn">
                <button class="btn btn-info btn-lg" type="submit">
                  <i class="glyphicon glyphicon-search"></i>
                </button>
              </span>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
  <br />
  <div id="search"></div>
  <div class="table-responsive">
    <table data-sortable class="table table-hover table-striped">
      <thead>
        <tr>
          <th>Código do pedido</th>              
          <th>Data do pedido</th>              
          <th>DELIVERY</th>              
          <th>Nome</th>
          <th>Telefone</th>
          <th>Envio WhatsApp</th>
          <th>Total</th>
          <th>Status</th>            
          <th data-sortable="false">Ver Pedido</th>
        </tr>
      </thead>
      <?php
      $inputdadossearch = filter_input_array(INPUT_POST, FILTER_DEFAULT);
      if(!empty($inputdadossearch['s'])):
        $inputdadossearch['s'] = strip_tags(trim($inputdadossearch['s']));
        header("Location: {$site}{$Url[0]}/pedidos&s={$inputdadossearch['s']}");
      endif;    
      ?>
      <tbody>
        <?php
        if(!isset($pesquisar) || empty($pesquisar)):        
          ?>

        <?php
    //INICIO PAGINAÇÃO
        $pagS = (!empty($a) && $a == 'Aberto' || $a == 'Finalizado' || $a == 'Cancelado' || $a == 'Disponível para Retirada' || $a == 'Em Andamento' || $a == 'Saiu para Entrega' ? "&status={$a}" : "");
        $getpage = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
        $pager = new Pager("{$site}{$Url[0]}/pedidos{$pagS}&page=");
        $pager->ExePager($getpage, 15);
    //FIM PAGINAÇÃO
        $qurAberto = "Aberto";
        $qurFinalizado = "Finalizado";
        $qurCancelado = "Cancelado";

        $qurSaiuEntrega = "Saiu para Entrega";
        $qurDisponivelRetirada = "Disponível para Retirada";
        $qurEmAndamento = "Em Andamento";

        $quary   = "";
        $quary2  = "";

        if(!empty($a) && $a == "Aberto"):
          $quary   = "WHERE user_id = :userid AND status = :a";
          $quary2  = "userid={$userlogin['user_id']}&a={$qurAberto}&";
        elseif(!empty($a) && $a == "Finalizado"):
          $quary   = "WHERE user_id = :userid AND status = :f";
          $quary2  = "userid={$userlogin['user_id']}&f={$qurFinalizado}&";
        elseif(!empty($a) && $a == "Cancelado"):
          $quary   = "WHERE user_id = :userid AND status = :c";
          $quary2  = "userid={$userlogin['user_id']}&c={$qurCancelado}&";
        elseif(!empty($a) && $a == "Saiu para Entrega"):
          $quary   = "WHERE user_id = :userid AND status = :t";
          $quary2  = "userid={$userlogin['user_id']}&t={$qurSaiuEntrega}&";
        elseif(!empty($a) && $a == "Disponível para Retirada"):
          $quary   = "WHERE user_id = :userid AND status = :n";
          $quary2  = "userid={$userlogin['user_id']}&n={$qurDisponivelRetirada}&";
        elseif(!empty($a) && $a == "Em Andamento"):
          $quary   = "WHERE user_id = :userid AND status = :zx";
          $quary2  = "userid={$userlogin['user_id']}&zx={$qurEmAndamento}&";
        else:
           $quary   = "WHERE user_id = :userid";
          $quary2  = "userid={$userlogin['user_id']}&";
        endif;

        $lerbanco->ExeRead("ws_pedidos", "{$quary} ORDER BY data DESC LIMIT :limit OFFSET :offset", "{$quary2}limit={$pager->getLimit()}&offset={$pager->getOffset()}");              
        if (!$lerbanco->getResult()):
         $pager->ReturnPage();               
       else:
        foreach ($lerbanco->getResult() as $getItensBanco):
          extract($getItensBanco);                
          ?>
          <!-- INICIO DO LOOP DA LEITURA DO BANCO --> 
          <?php
          if($view == 0):
            echo "<script>
            var sound = new Howl({
              src: ['{$site}campainha.mp3'],
              autoplay: true,
              loop: true,
              });
              sound.play();
              </script>";
            endif;
            ?>
            <tr  <?=($view == 0 ? "style='background-color: #34AF23;font-weight: bold;color:#ffffff'" : "");?>>
              <td>
                
                 <strong><?=$codigo_pedido;?></strong>
             
             </td >
             <td>                    
               <?php
               $formatdata = explode(" ", $data);
               $dataformat = explode("-", $formatdata[0]);
               $dataformat = array_reverse($dataformat);
               $dataformat = implode("/", $dataformat);  

               $dataH = explode(":", $formatdata[1]);
               echo '<span>'.$dataformat.' ás '.$dataH[0].':'.$dataH[1].'</span>';
               ?>   
             </td>   
             <td><?=($opcao_delivery == 'true' ? '<strong style="color:green;">SIM</strong>' : '<strong style="color:#d9534f;">NÃO</strong>');?></td>
             <td>
               <?php
               $nome = str_replace('%20', ' ', $nome);
               $nome = ucfirst($nome);
               echo $nome;
               ?></td>
               <td><?=formatPhone($telefone);?></td>
               <td><?=($confirm_whatsapp == 'true' ? '<strong style="color:green;">SIM</strong>' : '<strong style="color:#d9534f;">NÃO</strong>');?></td>
               <td>R$ <?=Check::Real($total);?></td>
               <td>                    
                <?php
                if($status == "Aberto"):
                  echo "<span class=\"label label-warning\">Aberto</span>";
                elseif($status == "Finalizado"):
                  echo "<span class=\"label label-success\">Finalizado</span>";
                elseif($status == "Cancelado"):
                  echo "<span class=\"label label-danger\">Cancelado</span>";
                elseif($status == "Em Andamento"):
                  echo "<span class=\"label label-info\">Em Andamento</span>";
                elseif($status == "Saiu para Entrega"):
                  echo "<span class=\"label label-primary\">Saiu para Entrega</span>";
                elseif($status == "Disponível para Retirada"):
                  echo "<span class=\"label label-info\">Disponível para Retirada</span>";
                endif;
                ?>
              </td>
              <td>
                <button id="verPedido_<?=$id;?>" class="btn btn-primary btn-xs">Ver Pedido</button>
                <script type="text/javascript">
                  $(document).ready(function(){

                    $('#verPedido_<?=$id;?>').click(function(){
                      $('#verPedido_<?=$id;?>').html('Aguarde...');
                      $('#verPedido_<?=$id;?>').prop('disabled', true);

                      $.ajax({
                        url: '<?=$site;?>includes/processanotificacao.php',
                        method: "post",
                        data: {'idDoPedido' : '<?=$id;?>', 'iduser' : '<?=$userlogin['user_id'];?>'},

                        success: function(data){        
                          $('#verPedido_<?=$id;?>').html('Ver Pedido');
                          $('#verPedido_<?=$id;?>').prop('disabled', false);
                          if(data == 'true'){
                            window.location.replace('<?=$site.$Url[0].'/ver-pedido&id='.$id;?>');
                          }
                        }
                      });

                    }); 

                  });
                </script>
              </td>               
            </tr>   
            <?php
          endforeach;
          $corD = '000000';
          if(!empty($a) && $a == "Aberto"):
            $corD = 'f0ad4e';
          elseif(!empty($a) && $a == "Finalizado"):
           $corD = '5cb85c';
         elseif(!empty($a) && $a == "Cancelado"):
           $corD = 'd10303';
         else:
    //NÃO FAZ NADA
         endif;
         echo "<strong style=\"color: #000000\">Total de Pedidos: ".$lerbanco->getRowCount()."</span><hr />";
       endif;
       ?>  
       <!-- FINAL DO LOOP DA LEITURA DO BANCO -->

       <?php
     else:
      $lerbanco->ExeRead('ws_pedidos', "WHERE user_id = :userid AND codigo_pedido = :v", "userid={$userlogin['user_id']}&v={$pesquisar}");
      if (!$lerbanco->getResult()):
        echo "<tr>
        <div class=\"alert alert-info alert-dismissable\">
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
        <b class=\"alert-link\">PEDIDO NÃO ENCONTRADO!</b>
        </div>
        </tr>";
      else:
        foreach($lerbanco->getResult() as $getItensBanco):
          extract($getItensBanco);
        endforeach;
        ?>

        <tr>
          <td>
            
             <strong><?=$codigo_pedido;?></strong>
           
         </td>
         <td>                    
           <?php
           $formatdata = explode(" ", $data);
           $dataformat = explode("-", $formatdata[0]);
           $dataformat = array_reverse($dataformat);
           $dataformat = implode("/", $dataformat);       

           $dataH = explode(":", $formatdata[1]);
           echo '<span>'.$dataformat.' ás '.$dataH[0].':'.$dataH[1].'</span>';
           ?>   
         </td>   
         <td><?=($opcao_delivery == 'true' ? 'Sim' : 'Não');?></td>
         <td><?php echo str_replace('%20', ' ', $nome);?></td>
         <td><?=formatPhone($telefone);?></td>
         <td>R$ <?=Check::Real($total);?></td>
         <td>                    
          <?php
          if($status == "Aberto"):
            echo "<span class=\"label label-warning\">Aberto</span>";
          elseif($status == "Finalizado"):
            echo "<span class=\"label label-success\">Finalizado</span>";
          elseif($status == "Cancelado"):
            echo "<span class=\"label label-danger\">Cancelado</span>";
          elseif($status == "Em Andamento"):
            echo "<span class=\"label label-info\">Em Andamento</span>";
          elseif($status == "Saiu para Entrega"):
            echo "<span class=\"label label-primary\">Saiu para Entrega</span>";
          elseif($status == "Disponível para Retirada"):
            echo "<span class=\"label label-info\">Disponível para Retirada</span>";
          endif;
          ?>
        </td>
        <td><button id="verPedido_<?=$id;?>" class="btn btn-primary btn-xs">Ver Pedido</button>
           <script type="text/javascript">
                  $(document).ready(function(){

                    $('#verPedido_<?=$id;?>').click(function(){
                      $('#verPedido_<?=$id;?>').html('Aguarde...');
                      $('#verPedido_<?=$id;?>').prop('disabled', true);

                      $.ajax({
                        url: '<?=$site;?>includes/processanotificacao.php',
                        method: "post",
                        data: {'idDoPedido' : '<?=$id;?>', 'iduser' : '<?=$userlogin['user_id'];?>'},

                        success: function(data){        
                          $('#verPedido_<?=$id;?>').html('Ver Pedido');
                          $('#verPedido_<?=$id;?>').prop('disabled', false);
                          if(data == 'true'){
                            window.location.replace('<?=$site.$Url[0].'/ver-pedido&id='.$id;?>');
                          }
                        }
                      });

                    }); 

                  });
                </script>
        </td>   
      </tr>
      <?php
    endif;
  endif;
  ?>  
</tbody>
</table>
</div>

<div class="data-table-toolbar">
 <?php
 if(!isset($pesquisar) || empty($pesquisar)):
      //INICIO PAGINAÇÃO
   $pager->ExePaginator("ws_pedidos" ,"{$quary}", "{$quary2}");
 echo $pager->getPaginator();
      //FIM PAGINAÇÃO
endif;
?>  
</div>

</div>

<br />
<div class="alert alert-info container margin_60">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <h4><i class="icon-attach-3"></i> NOTAS!</h4>
  <p>
   <strong>Clique em "Ver Pedido" Para ver ou editar o status do pedido!  <br /> 
   <strong>Pedidos com a cor de fundo  <b style="color:#34AF23;">VERDE</b> Significa que não foram visualizados!

   </p>

 </div>
 <div id="chamadanotificacao"></div>




 <script type="text/javascript">
  setTimeout(function() {
    window.location.reload(1);
  }, 60000);
</script>
