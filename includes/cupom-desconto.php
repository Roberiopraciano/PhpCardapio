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



<div id="contato_do_site">
  <div style="background-color:#ffffff;" class="container margin_60">     
    <div class="row"> 
      <div class="col-md-8 col-md-offset-2">  
        <div id="success"></div>
        <div id="sendnewpass" class="indent_title_in">
          <i class="icon-ticket-2"></i>
          <h3>Cupom de Desconto</h3>
          <p>
            Ofereça descontos para conseguir mais clientes.
          </p>
          <br />
          <form id="formcupom" method="post">
            <div class="row">
              <div class="col-md-6 col-sm-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Código de Ativação</label>
                  <input required type="text" maxlength="20" class="form-control" name="ativacao" aria-describedby="emailHelp" placeholder="EX: CUPOM10" />
                  <small id="emailHelp" class="form-text text-muted">Para enviar para seus clientes. (max. 20 caracteres)</small>
                </div>
              </div>
              <div class="col-md-6 col-sm-6">
                <div class="form-group">
                  <label for="exampleInputPassword1">Desconto %</label>
                  <input required type="number" class="form-control descontoporcentagem" value="1" name="porcentagem" min="1" max="100" />
                  <small class="form-text text-muted">Porcentagem de desconto.</small>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 col-sm-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Data de Válidade</label>
                  <input required type="text" class="form-control" name='data_validade' id="datepicker" data-mask="00/00/0000" placeholder="00/00/0000" />
                  <small id="emailHelp" class="form-text text-muted">Data de expiração do cupom</small>
                </div>
              </div>
              <div class="col-md-6 col-sm-6">
                <div class="form-group">
                  <label for="exampleInputPassword1">Quantidade</label>
                  <input required type="number" class="form-control numero" name="total_vezes" value="1" min="1" max="100000" />
                  <small class="form-text text-muted">Número de vezes que o cupom pode ser usado!</small>
                </div>
              </div>
            </div>
            <input type="hidden" name="user_id" value="<?=$userlogin['user_id'];?>">
            <input type="hidden" name="lojaurl" value="<?=$Url[0];?>">
            <input type="hidden" name="submitcupomconfirm" value="true">
            <input type="hidden" name="mostrar_site" value="0">
            <a id="submitbtncupom" class="btn btn-primary">Cadastrar Cupom</a>
          </form>
          <br />
          <script type="text/javascript">
            $(document).ready(function(){
              $('#submitbtncupom').click(function(){
                $.ajax({
                  url: '<?=$site;?>includes/processasubmitcupom.php',
                  method: 'post',
                  data: $('#formcupom').serialize(),
                  success: function(data){
                    $('#sucsesscupom').html(data);
                  }
                });
              });
            });
          </script>
          <div id="sucsesscupom"></div>

          <br />
          <br />
          <?php
          $lerbanco->ExeRead('cupom_desconto', "WHERE user_id = :userid ORDER BY id_cupom DESC", "userid={$userlogin['user_id']}");
          if ($lerbanco->getResult()):
            ?>
            <div class="table-responsive">
              <table data-sortable class="table table-hover table-striped">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">Ativação</th>
                    <th scope="col">Desconto</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Expira em</th>
                    <th scope="col">Situação</th>
                    <th scope="col">Exibir no site</th>
                    <th scope="col">Excluir</th>
                  </tr>
                </thead>
                <tbody style="text-align: center;">
                  <?php
                  foreach ($lerbanco->getResult() as $dadoscupons):
                    extract($dadoscupons); 
                    ?>
                    <tr>
                      <th scope="row"><?=$ativacao;?></th>
                      <td><?=$porcentagem;?> %</td>
                      <td><?=$total_vezes;?></td>
                      <td>
                        <?php
                        $datavalidade = explode("-", $data_validade);
                        $datavalidade = array_reverse($datavalidade);
                        $datavalidade = implode("/",  $datavalidade);
                        echo $datavalidade;
                        ?>                      
                      </td>
                      <td>

                        <?php
                        if(!isDateExpired($data_validade, 1)):
                          echo "<strong style='color: red;'>EXPIROU!</strong>";
                        elseif($total_vezes <= 0):
                         echo "<strong style='color: red;'>ACABOU!</strong>";
                       else:
                        echo "<strong style='color: #82C152;'>ATIVO</strong>";
                      endif;
                      ?> 

                    </td>
                    <td><button type="button" class="btn btn-defalt exibirsite" data-idcupom="<?=$id_cupom;?>"><?=($mostrar_site == 0 ? 'Não' : 'Sim');?></button></td>
                    <td><button type="button" class="btn btn-danger excluircupom" data-idcupom="<?=$id_cupom;?>">Excluir</button></td>
                  </tr>
                  <?php
                endforeach;
                ?>
              </tbody>
            </table>
          </div>
          <?php
        endif;
        ?>

      </div>

    </div><!-- End col  --> 

  </div><!-- End row  -->
</div>
</div><!-- End container  -->
<script type="text/javascript">
  $(document).ready(function(){
    $('.exibirsite').click(function(){
      var idcupom = $(this).data('idcupom');
      $(this).prop('disabled', true);

      $.ajax({
        url: '<?=$site;?>includes/processamostrarcupom.php',
        method: 'post',
        data: {'iddocupom' : idcupom, 'url' : '<?=$Url[0];?>', 'iduser' : '<?=$userlogin['user_id'];?>'},
        success: function(data){
          $('.exibirsite').prop('disabled', false);
          if(data == 'erro1'){
            x0p('Opss...', 
              'Ocorreu um arro!',
              'error', false);
          }else if(data == 'erro0'){
            window.location.replace('<?=$site.$Url[0].'/cupom-desconto';?>');
          }

        }
      });
    });
  });
</script>



<script type="text/javascript">
  $(document).ready(function(){
    $('.excluircupom').click(function(){
      var idcupom = $(this).data('idcupom');
      x0p({
        title: 'Atenção!',
        text: 'Tem certeza de que deseja excluir esse cupom?',
        animationType: 'slideUp',
        buttons: [
        {
          type: 'error',
          key: 49,
          text: 'Cancelar',

        },
        {
          type: 'info',
          key: 50,
          text: 'Excluir'
        }
        ]
      }).then(function(data) {
        if(data.button == 'error'){

        }else if(data.button == 'info'){

          $.ajax({
            url: '<?=$site;?>includes/processadeletarcupom.php',
            method: 'post',
            data: {'iddocupom' : idcupom, 'url' : '<?=$Url[0];?>', 'iduser' : '<?=$userlogin['user_id'];?>'},
            success: function(data){
              $('#sucsesscupom').html(data);
              $('.excluircupom').prop('disabled', false);
            }
          });
        }
      });
    });
  });
</script>



