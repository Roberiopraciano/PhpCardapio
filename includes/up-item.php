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

$getIdItem = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if(!isset($getIdItem)):
 header("Location: {$site}{$Url[0]}/view-item");
else:
  $lerbanco->ExeRead("ws_itens", "WHERE user_id = :userid AND id = :aa", "userid={$userlogin['user_id']}&aa={$getIdItem}");
  if ($lerbanco->getResult()):
    foreach ($lerbanco->getResult() as $dd):
      extract($dd);
    endforeach;
  else:
    header("Location: {$site}{$Url[0]}/view-item");  
  endif;
endif;


$lerbanco->ExeRead("ws_cat", "WHERE user_id = :userid AND id = :idcat", "userid={$userlogin['user_id']}&idcat={$id_cat}");
if($lerbanco->getResult()):
  $pegacatitens = $lerbanco->getResult();
  $variaveloption = "<option value=\"{$pegacatitens[0]['id']}\">{$pegacatitens[0]['nome_cat']}</option>";  
endif; 
?>

<style type="text/css">
  .select-wrapper {
    margin: auto;
    max-width: 600px;
    width: calc(100% - 40px);
  }

  .select-pure__select {
    align-items: center;
    background: #ffffff;
    border-radius: 4px;
    border: 1px solid rgba(0, 0, 0, 0.15);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
    box-sizing: border-box;
    color: #363b3e;
    cursor: pointer;
    display: flex;
    font-size: 16px;
    font-weight: 500;
    justify-content: left;
    min-height: 44px;
    padding: 5px 10px;
    position: relative;
    transition: 0.2s;
    width: 100%;
  }

  .select-pure__options {
    border-radius: 4px;
    border: 1px solid rgba(0, 0, 0, 0.15);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
    box-sizing: border-box;
    color: #363b3e;
    display: none;
    left: 0;
    max-height: 221px;
    overflow-y: scroll;
    position: absolute;
    top: 50px;
    width: 100%;
    z-index: 5;
  }

  .select-pure__select--opened .select-pure__options {
    display: block;
  }

  .select-pure__option {
    background: #fff;
    border-bottom: 1px solid #e4e4e4;
    box-sizing: border-box;
    height: 44px;
    line-height: 25px;
    padding: 10px;
  }

  .select-pure__option--disabled {
    color: #e4e4e4;
  }

  .select-pure__option--selected {
    color: #e4e4e4;
    cursor: initial;
    pointer-events: none;
  }

  .select-pure__option--hidden {
    display: none;
  }

  .select-pure__selected-label {
    align-items: 'center';
    background: #5e6264;
    border-radius: 4px;
    color: #fff;
    cursor: initial;
    display: inline-flex;
    justify-content: 'center';
    margin: 5px 10px 5px 0;
    padding: 3px 7px;
  }

  .select-pure__selected-label:last-of-type {
    margin-right: 0;
  }

  .select-pure__selected-label i {
    cursor: pointer;
    display: inline-block;
    margin-left: 7px;
  }

  .select-pure__selected-label img {
    cursor: pointer;
    display: inline-block;
    height: 18px;
    margin-left: 7px;
    width: 14px;
  }

  .select-pure__selected-label i:hover {
    color: #e4e4e4;
  }

  .select-pure__autocomplete {
    background: #f9f9f8;
    border-bottom: 1px solid #e4e4e4;
    border-left: none;
    border-right: none;
    border-top: none;
    box-sizing: border-box;
    font-size: 16px;
    outline: none;
    padding: 10px;
    width: 100%;
  }

  .select-pure__placeholder--hidden {
    display: none;
  }

  .select-pure__option::-moz-selection{
    color: inherit;
  }
</style>

<div id="upitem"></div>
<div style="background-color:#ffffff;" class="container margin_60">  
  <section id="section-2">
    <div class="indent_title_in">
      <i class="fa fa-cutlery" aria-hidden="true"></i>
      <h3>Editar Item!</h3>
      <p><b style="color: red;">Importante:</b> verifique as notas no final da página!</p>
    </div>
    <?php
    require('includes/configAtualizarItens.php');

    $removeritem = filter_input(INPUT_GET, 'Remover', FILTER_VALIDATE_INT);
    if(!empty($removeritem)):

      $img = array();
      $img['img_item'] = 'false';
      $updatebanco->ExeUpdate("ws_itens", $img, "WHERE user_id = :userid AND id = :upp", "userid={$userlogin['user_id']}&upp={$getIdItem}");
      if($updatebanco->getResult()):
        if(file_exists("uploads/{$img_item}") && !is_dir("uploads/{$img_item}")):
          unlink("uploads/{$img_item}");

        echo "<div class=\"alert alert-success alert-dismissable\">
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
        <b class=\"alert-link\">SUCESSO!</b> A imagem foi removida. Atualizando...
        </div>";
        header("Refresh: 3; url={$site}{$Url[0]}/up-item&id={$getIdItem}#additem");    

      endif;
    endif;           

  endif;
  ?>
  <form method="post" action="#upitem" enctype="multipart/form-data">
    <div class="wrapper_indent">
      <div class="form-group">
       <label><span style="color: red;">*</span> CATEGORIA</label>        
       <select required class="form-control" name="id_cat">
        <?php
        $lerbanco->ExeRead("ws_cat", "WHERE user_id = :userid", "userid={$userlogin['user_id']}");
        if (!$lerbanco->getResult()):
          echo "<option value=\"\">Adicione uma categoria</option>";
        else:

          echo $variaveloption;
          foreach ($lerbanco->getResult() as $cat):
            extract($cat);
            echo "<option value=\"{$id}\">{$nome_cat}</option>";
          endforeach;
        endif;
        ?>
      </select>
    </div>
    <?php
    if(!empty($img_item) && $img_item != 'null' && $img_item != 'false'):
      $img_item_explode = explode('/', $img_item);
      $img_item_explode_ponto = explode('.', $img_item_explode[3]);
    endif;
    ?>
    <div class="strip_menu_items">
      <div class="row">
        <div class="col-sm-3">
          <div class="menu-item-pic">
            <div style="margin: 0 auto;align-items: center;display: flex;flex-direction: row;flex-wrap:wrap;justify-content:center;background-color:#ffffff;border-width: 5px;border-style:dashed;border-color:#d3394c;" class="box">
              <input type="file" name="img_item" id="file-5" class="inputfile inputfile-4" data-multiple-caption="{count} files selected" multiple />
              <label for="file-5"><figure><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg></figure> <span><?=(!empty($img_item_explode_ponto[0]) ? $img_item_explode_ponto[0] : 'Enviar Imagem&hellip;');?></span></label>
            </div>
          </div>
        </div><br />

        <div class="col-sm-9">
         <div class="row">
           <div class="col-md-8">
             <div class="form-group">
               <label><span style="color: red;">*</span> NOME:</label>
               <input placeholder="Nome do item" required type="text"  name="nome_item" value="<?=$nome_item;?>" class="form-control">
             </div>
           </div>
           <div class="col-md-4">
            <div class="form-group">
              <label><span style="color: red;">*</span> PREÇO BASE DO ITEM:</label>
              <input required type="text" data-mask="#.##0,00" data-mask-reverse="true" value="<?=$preco_item;?>" maxlength="11" onkeypress="return formatar_moeda(this, '.', ',', event);" name="preco_item" class="form-control" placeholder="R$ 00,00" />
            </div>
          </div>
        </div>
        <div class="form-group">
         <label><span style="color: red;">*</span> DESCRIÇÃO:</label>
         <textarea placeholder="Escreva uma descrição do item..." style="resize:none;" name="descricao_item" required class="form-control" rows="2"><?=$descricao_item;?></textarea>
       </div>
       <div class="form-group">
         <label>DIAS EM QUE O ITEM APARECE PARA O CLIENTE:</label>
         <span class="multi-select"></span>
       </div>
       <div class="form-group">
         <label>TAMANHO ?</label>
         <select class="form-control" id="tipodeproduto" name="id_tipo">

           <?php
           $lerbanco->FullRead("SELECT * FROM ws_relacao_tamanho WHERE id_user = :userid AND id_item = :iditem", "userid={$userlogin['user_id']}&iditem={$getIdItem}");
           if($lerbanco->getResult()):

            $resultadogettipoemrelacao = $lerbanco->getResult();
            $lerbanco->FullRead("SELECT * FROM ws_tipo_produto WHERE user_tipo_produto = :userid AND id_tipo_produto = :idtipo", "userid={$userlogin['user_id']}&idtipo={$resultadogettipoemrelacao[0]['id_tipo']}");
            if($lerbanco->getResult()):
              $getresulttamanhos = $lerbanco->getResult();
              echo "<option selected value=\"{$getresulttamanhos[0]['id_tipo_produto']}\">{$getresulttamanhos[0]['nome_tipo_produto']}</option>";
            endif;

          else:
            $lerbanco->FullRead("SELECT * FROM ws_tipo_produto WHERE user_tipo_produto = :userid ORDER BY id_tipo_produto DESC", "userid={$userlogin['user_id']}");
            if(!$lerbanco->getResult()):
            else:
              echo ' <option value="">Selecione um tipo de produto</option>';
              foreach($lerbanco->getResult() as $extrairtiposs):
                extract($extrairtiposs);
                echo "<option value=\"{$id_tipo_produto}\">{$nome_tipo_produto}</option>";
              endforeach;
            endif;
          endif;               
          ?>            

        </select>
        <div id="getResultmostrartamanhos">
          <?php
          if(!empty($getresulttamanhos[0]['id_tipo_produto'])):
                  $lerbanco->FullRead("SELECT * FROM ws_opcoes_itens WHERE user_id = :userid AND id_tipo = :idtipo ORDER BY id_option DESC", "userid={$userlogin['user_id']}&idtipo={$getresulttamanhos[0]['id_tipo_produto']}");

                  if(!$lerbanco->getResult()):
                    echo "<br /><b style='color: red;'>AINDA NÃO EXISTEM OPÇÕES DE TAMANHO PARA ESSE TIPO DE PRODUTO</b><br />";
                  else:
                    echo "<br />";


                    $explodegettamanhos = explode(',', $resultadogettipoemrelacao[0]['id_tamanho']);        




                    foreach ($lerbanco->getResult() as $extrairtamanhos):
                      extract($extrairtamanhos);
                      $valor_tamanho = Check::Real($valor_tamanho);
                      $checkvalor = (in_array($id_option, $explodegettamanhos) ? "checked" : "");
                      $valordotamanho = ($meio_a_meio == "true" ? "" : " - R$ {$valor_tamanho}");
                      echo "
                      <div class=\"icheck-material-green icheck-inline\">
                      <input type=\"checkbox\" {$checkvalor} id=\"tamanho_{$id_option}\" value=\"{$id_option}\" name=\"tamanhos[]\" />
                      <label for=\"tamanho_{$id_option}\">{$nome_option}{$valordotamanho}</label>
                      </div>
                      ";
                    endforeach;

                  endif;
          else:

          endif; 
          ?>
          <script type="text/javascript">
                $('#tipodeproduto').change(function (){

                  var buscartamanhos = $(this).val();

                  $.ajax({
                    url: '<?=$site;?>includes/buscartamanhosadditem.php',
                    method: 'post',
                    data: {'user_id' : '<?=$userlogin['user_id'];?>', 'tipo_id' : buscartamanhos},
                    success: function(data){                      
                      $('#getResultmostrartamanhos').html(data);
                    }
                  });

                  
                });
              </script>
        </div>

      </div>

      <div class="form-group">
       <div class="add_more_cat">
        <input type="hidden" name="dia_semana" id="diasdasemana" value="<?=$dia_semana;?>">
        <input type="hidden" name="user_id" value="<?=$userlogin['user_id'];?>">
        <input type="submit" class="btn_1" value="ATUALIZAR ITEM" name="atualizar_item" />
        <?php
        if(!empty($img_item) && $img_item != 'null' && $img_item != 'false'):
          ?>
          <a href="<?=$site.$Url[0]."/up-item&id={$getIdItem}&Remover=1#upitem";?>">
            <button type="button" class="btn btn-danger">Remover Imagem</button>
          </a>
          <?php
        endif;
        ?>
      </div>
    </div>




  </div><!-- End form-group -->
</div>
</div><!-- End row -->
</div><!-- End strip_menu_items -->
<hr />
</form>
<br />
<div class="alert alert-info fade in nomargin">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <h4><i class="icon-attach-3"></i> NOTA!</h4>
  <p>
   A imagem do item e um atributo opcional! Não e obrigatório.
 </p>

</div>
</section><!-- End section 2 -->
</div><!-- End wrapper_indent -->
<?php
if($dia_semana == 'null'):
else:
  $dia_semana = explode(',', $dia_semana);
  for ($i=0; $i < count($dia_semana); $i++) { 
   $dia_semana[$i] = "\"".$dia_semana[$i]."\"";
 }
 $dia_semana = implode(',', $dia_semana);
endif;
?>

<script>
    // You'd better put the code inside ready() function
    $(document).ready(function () {

      var multi = new SelectPure(".multi-select", {
         // Items to select
         options: [
         {
          label: "Domingo",
          value: "Domingo",
        },
        {
          label: "Segunda",
          value: "Segunda",
        },
        {
          label: "Terça",
          value: "Terça",
        },
        {
          label: "Quarta",
          value: "Quarta",
        },
        {
          label: "Quinta",
          value: "Quinta",
        },
        {
          label: "Sexta",
          value: "Sexta",
        },
        {
          label: "Sabado",
          value: "Sabado",
        },
        ],
        <?php
        if($dia_semana == 'null'):
        else:
          ?>
          value: [<?=$dia_semana;?>],
        <?php endif ;?>
        multiple: true,
        placeholder: "Selecione os dias da semana",
        icon: "fa fa-times",
        onChange: value => { $('#diasdasemana').val(value); },
      });

    });
  </script>



