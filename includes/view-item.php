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
?>
<div id="idview-item"></div>
<div style="background-color:#ffffff;" class="row">
  <div class="col-md-12">
    <div class="widget">
      <div class="indent_title_in">
        <i class="fa fa-cutlery" aria-hidden="true"></i>
        <h3>Ver todos os itens do Menu!</h3>
        <p><b style="color: red;">OBSERVAÇÃO: Em "Seleção de Adicionais" você determina o total de adicionais que pode ser selecionado pelo cliente.<br />0 = significa que o cliente pode selecionar todos os adicionais!<br />Se o item não tiver adicionais basta ignorar esse campo, para alterar basta informar a quantidade e clicar fora do campo.</b></p>
      </div>
      <div class="widget-content">


        <div class="table-responsive">
          <table data-sortable class="table table-hover table-striped">
            <thead>
              <tr>
                <th>Imagem</th>              
                <th>Categoria</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Descrição</th>                      
                <th>Seleção de Adicionais</th>                      
                <th data-sortable="false">Disponível</th>
                <th data-sortable="false">Editar</th>
                <th data-sortable="false">Excluir</th>
              </tr>
            </thead>

            <tbody>
              <?php
              //INICIO PAGINAÇÃO
              $getpage = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
              $pager = new Pager("{$site}{$Url[0]}/view-item&page=");
              $pager->ExePager($getpage, 10);
              //FIM PAGINAÇÃO
              $lerbanco->ExeRead("ws_itens", "WHERE user_id = :userid ORDER BY id DESC LIMIT :limit OFFSET :offset", "userid={$userlogin['user_id']}&limit={$pager->getLimit()}&offset={$pager->getOffset()}");              
              if (!$lerbanco->getResult()):
               $pager->ReturnPage();               
             else:
              foreach ($lerbanco->getResult() as $getItensBanco):
                extract($getItensBanco);               
                ?>
                <!-- INICIO DO LOOP DA LEITURA DO BANCO --> 
                <tr>
                 <td>
                  <div style="width:40px;" class="img-wrap">
                    <?php
                    if (!empty($img_item) && $img_item != "" && file_exists("uploads/{$img_item}") && !is_dir("uploads/{$img_item}")):
                      echo Check::Image('uploads/'.$img_item, 'Imagem-item', 40, 33);
                  else:
                    echo Check::Image('img/camara2.png', 'Imagem-item', 40, 33);
                  endif;
                  ?>
                </div>
              </td>
              <td>
                <strong>
                  <?php
                  $lerbanco->ExeRead('ws_cat', "WHERE user_id = :userid AND id = :idcatt", "userid={$userlogin['user_id']}&idcatt={$id_cat}");
                  if($lerbanco->getResult()):
                    $dadoscat = $lerbanco->getResult();
                    echo $dadoscat[0]['nome_cat'];
                  endif;
                  ?>
                </strong>
              </td>
              <td><?=(!empty($nome_item) ? limitarTexto($nome_item, 40) : '');?></td>
              <td><?=(!empty($preco_item) ? 'R$ '.Check::Real($preco_item) : '');?></td>
              <td><?=(!empty($descricao_item) ? limitarTexto($descricao_item, 30) : '');?></td>
              <td><input type="number" data-produtoid="<?=$id;?>" class="form-control number_adicional" name="number_adicional" value="<?=(!empty($number_adicional) ? $number_adicional : "")?>" placeholder="0"></td>
              <td>

                <div class="ckbx-style-14">
                  <input <?=(!empty($disponivel) && $disponivel == 1 ? 'checked' : '');?> value="<?=$id;?>" type="checkbox" id="atualizar_<?=$id;?>" name="ckbx-style-14">
                  <label class="atualizar_<?=$id;?>" for="atualizar_<?=$id;?>"></label>
                </div>                  
                
                <script type="text/javascript">
                  $(document).ready(function(){
                    $('.atualizar_<?=$id;?>').click(function(){
                      var idDoItem = $('#atualizar_<?=$id;?>').val();
                      $.ajax({
                        url: '<?=$site;?>includes/processaDisponibilidadeItens.php',
                        method: "post",
                        data: {'iditem' : idDoItem, 'iduser' : '<?=$userlogin['user_id'];?>'},

                        success: function(data){  
                        }
                      });
                    });
                  });


                </script>
              </td>              
              <td>
                <center>
                  <a href="<?=$site.$Url[0].'/up-item&id='.$id.'#upitem';?>"><p data-placement="top" data-toggle="tooltip" title="Editar"><button class="btn btn-primary" data-title="Editar"><span class="glyphicon glyphicon-pencil"></span></button></p></a>
                </center>
              </td>
              <td>
                <center>
                  <button data-getiddell="<?=$id;?>" class="btn btn-danger deletarItem"><span class="glyphicon glyphicon-trash"></span></button>
                </center>
              </td>
            </tr>  
            <!-- FINAL DO LOOP DA LEITURA DO BANCO --> 
            <?php
          endforeach;
        endif;
        ?>              
      </tbody>
    </table>
  </div>
  <div class="data-table-toolbar">
   <?php
      //INICIO PAGINAÇÃO
   $pager->ExePaginator("ws_itens", "WHERE user_id = :userid", "userid={$userlogin['user_id']}");
   echo $pager->getPaginator();
      //FIM PAGINAÇÃO
   ?>        
 </div>
</div>
</div>
</div>

</div>

<div id="resultadiasemana"></div>

<script type="text/javascript">
  $('.number_adicional').change(function (){

    var valor_total_number = $(this).val();
    var id_produto = $(this).data('produtoid');
    var iduser = '<?=$userlogin['user_id'];?>';

    $.ajax({
      url: '<?=$site;?>controlers/edit-opcao-adicionais.php',
      method: "post",
      data: {'idproduto' : id_produto, 'valor' : valor_total_number, 'iduser' : iduser},

      success: function(data){       
        if(data == 'true'){
          x0p('Sucesso!', 
            'O item foi atualizado!', 
            'ok', false);
        }else if(data == 'false'){
          x0p('Opss...', 
            'OCORREU UM ERRO!',
            'error', false);
        }
      }
    }); 

  });
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $(".deletarItem").click(function(){

      var iddoitemdel = $(this).data('getiddell');

      GrowlNotification.notify({
        title: 'Atenção!',
        description: 'Tem certeza de que deseja deletar este item?',
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
            text: ' Deletar',
            callback: function(){
              $.ajax({
                url: '<?=$site;?>includes/processadeletaritem.php',
                method: 'post',
                data: {'iditemdeletar' : iddoitemdel, 'iduser' : '<?=$userlogin['user_id'];?>'},
                success: function(data){
                  if(data == 'true'){
                    window.location.reload(1);
                  }
                }
              });

            }
          },
          cancel: {
            text: ' Cancelar'
          }
        },
        closeTimeout: 0
      });         

    });
  });
</script>


