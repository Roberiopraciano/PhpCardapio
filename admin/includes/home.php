
<!-- ============================================================== -->
<!-- Other sales widgets -->
<!-- ============================================================== -->
<!-- .row -->
<div class="row">
    <?php
    $lerbanco->ExeRead("ws_users");
    $totalclientes = 0;
    if ($lerbanco->getResult()):
        $totalclientes = $lerbanco->getRowCount();
    endif;
    ?>
    <a href="<?=$site;?>admin/painel.php?exe=todos-os-clientes">
    <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="white-box">
            <h3 class="box-title">TOTAL CLIENTES</h3>
            <ul class="list-inline two-part">
                <li><i class="icon-people text-info"></i></li>
                <li class="text-right"><span class="counter"><?=$totalclientes;?></span></li>
            </ul>            
        </div>

    </div>
    </a>
    <?php
    $lerbanco->ExeRead("ws_empresa");
    $totalempresas = 0;
    if ($lerbanco->getResult()):
        $totalempresas = $lerbanco->getRowCount();
    endif;
    ?>
    <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="white-box">
            <h3 class="box-title">LOJAS CADASTRADAS</h3>
            <ul class="list-inline two-part">
                <li><i class="icon-folder text-purple"></i></li>
                <li class="text-right"><span class="counter"><?= $totalempresas;?></span></li>
            </ul>
        </div>
    </div>
    <?php
    $lerbanco->ExeRead("ws_itens");
    $totaitens = 0;
    if ($lerbanco->getResult()):
        $totaitens = $lerbanco->getRowCount();
    endif;
    ?>
    <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="white-box">
            <h3 class="box-title">PRODUTOS CADASTRADOS</h3>
            <ul class="list-inline two-part">
                <li><i class="icon-folder-alt text-danger"></i></li>
                <li class="text-right"><span class=""><?=$totaitens?></span></li>
            </ul>
        </div>
    </div>
    <?php
    $lerbanco->ExeRead("ws_pedidos");
    $totalpedidos = 0;
    if ($lerbanco->getResult()):
        $totalpedidos = $lerbanco->getRowCount();
    endif;
    ?>
    <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="white-box">
            <h3 class="box-title">PEDIDOS REALIZADOS</h3>
            <ul class="list-inline two-part">
                <li><i class="ti-wallet text-success"></i></li>
                <li class="text-right"><span class=""><?=$totalpedidos;?></span></li>
            </ul>
        </div>
    </div>
</div>
<!-- /.row -->

<!-- ============================================================== -->
<!-- Demo table -->
<!-- ============================================================== -->

<?php
$seach = filter_input(INPUT_POST, 's', FILTER_DEFAULT);
if(!empty($seach)):
    $seach = strip_tags(trim(urlencode($seach)));
    header("Location: {$site}admin/painel.php?exe=home&s={$seach}");
endif;


$search_url = filter_input(INPUT_GET, 's', FILTER_DEFAULT);
if(!empty($search_url)):
    $searchpage = $search_url;
    $search_url = urldecode($search_url);
endif;

//INICIO PAGINAÇÃO
$getpage = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);


$quary   = "";
$quary2  = "";
if(!empty($search_url)):
    $pager = new Pager("{$site}admin/painel.php?exe=home&s={$search_url}&page="); 
    $quary   = "WHERE nome_empresa LIKE '%' :linkum '%' or nome_empresa_link LIKE '%' :linkdois '%' or cidade_empresa LIKE '%' :linktres '%' ";
    $quary2  = "linkum={$search_url}&linkdois={$search_url}&linktres={$search_url}&";
else:
    $pager = new Pager("{$site}admin/painel.php?exe=home&page="); 

endif;

$pager->ExePager($getpage, 10);
//FIM PAGINAÇÃO


?>
<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">TODAS AS CONTAS</div>
            <div class="panel-heading">
                <div class="row">

                    <form method="post">
                        <div class="input-group m-b-30">                    
                            <input class="form-control" type="text" name="s" placeholder="Nome da loja, link da loja ou cidade da loja"> 
                            <span class="input-group-btn"> 
                                <button class="btn btn-info" type="submit">Pesquisar</button> 
                            </span> 
                        </div>
                    </form>
                    <?php
                    if(!empty($search_url)):
                        echo '<a href="'.$site.'admin/painel.php?exe=home"><button id="demo-btn-addrow" class="btn btn-outline btn-primary btn-sm"><i class="icon wb-plus" aria-hidden="true"></i>Todos os clientes</button></a>';
                    endif;
                    ?>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover manage-u-table">
                    <thead>
                        <tr>

                            <th>Nome da Loja</th>
                            <th>Link da Loja</th>
                            <th>Cidade</th>
                            <th>Produtos</th>
                            <th>Pedidos</th>
                            <th>Renovação</th>
                            <th>Status</th>
                            <th>Mudar Senha</th>
                            <th>Opção Disponíveis</th>
                        </tr>
                    </thead>

                    <?php
                    $lerbanco->ExeRead("ws_empresa", "{$quary}ORDER BY id_empresa DESC LIMIT :limit OFFSET :offset", "{$quary2}limit={$pager->getLimit()}&offset={$pager->getOffset()}");
                    if($lerbanco->getResult()):
                        ?>
                        <tbody>
                            <?php
                            foreach ($lerbanco->getResult() as $getempresa):
                                extract($getempresa);

                                $lerbanco->ExeRead("ws_users", "WHERE user_id = :userid", "userid={$user_id}");
                                if ($lerbanco->getResult()):
                                    foreach ($lerbanco->getResult() as $tclientes):
                                        extract($tclientes);
                                    endforeach;
                                endif;
                                ?>


                                <tr>
                                    <td style="text-align: left;"><span class="font-medium"><?=(!empty($nome_empresa) ? $nome_empresa: "");?></span></td>
                                    <td>
                                        <?php if(!empty($nome_empresa_link)):?>
                                            <a href="<?=$site.$nome_empresa_link;?>" target="_blank">
                                                <span class="font-medium" style="color: blue;cursor: pointer;"><?=(!empty($nome_empresa_link) ? $nome_empresa_link: "");?></span>
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?=(!empty($cidade_empresa) ? $cidade_empresa : "");?>
                                    </td>
                                    <td>

                                        <?php
                                        $gettotaldositenscliente = 0;
                                        $lerbanco->ExeRead("ws_itens", "WHERE user_id = :userid", "userid={$user_id}");
                                        if ($lerbanco->getResult()):
                                            $gettotaldositenscliente = $lerbanco->getRowCount();
                                        endif;
                                        echo $gettotaldositenscliente;
                                        ?>

                                    </td>
                                    <td>
                                        <?php
                                        $gettotaldospedidoscliente = 0;
                                        $lerbanco->ExeRead("ws_pedidos", "WHERE user_id = :userid", "userid={$user_id}");
                                        if ($lerbanco->getResult()):
                                            $gettotaldospedidoscliente = $lerbanco->getRowCount();
                                        endif;
                                        echo $gettotaldospedidoscliente;
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $empresa_data_renovacao_formatar = explode("-", $empresa_data_renovacao);
                                        $empresa_data_renovacao_formatar = array_reverse($empresa_data_renovacao_formatar);
                                        $empresa_data_renovacao_formatar = implode("/", $empresa_data_renovacao_formatar);
                                        echo $empresa_data_renovacao_formatar;
                                        ?>

                                    </td>
                                    <td>
                                        <?php
                                        if(!isDateExpired($empresa_data_renovacao, 1)):
                                           echo " <button class=\"btn btn-danger\">Inativo</button>";
                                       else:
                                        echo " <button class=\"btn btn-success\">Ativo</button>";
                                    endif;
                                    ?>

                                </td>
                                <td><center><a href="<?=$site;?>admin/painel.php?exe=mudar-senha-cliente&id=<?=$user_id;?>"><button class="btn btn-success"><i class="fa fa-unlock-alt" aria-hidden="true"></i></button></a></center></td>
                                <td>


                                   <?php
                                   if(!empty($telefone_empresa)):
                                    ?>
                                    <a href="https://api.whatsapp.com/send?1=pt_BR&phone=55<?=$telefone_empresa;?>" target="_blank">
                                        <button type="button" class="btn btn-info">                                           
                                           <i class="fa fa-whatsapp" aria-hidden="true"></i> Contato
                                       </button>
                                   </a>
                               <?php endif; ?>

                               <button type="button" data-toggle="modal" data-target="#modalRenovar_<?=$user_id;?>" class="btn btn-info renovardata">
                                <i class="fa fa-calendar" aria-hidden="true"></i> Nova data de renovação
                            </button> 

                            <!-- MODAL -->
                            <div class="modal fade" id="modalRenovar_<?=$user_id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"><b>LOJA: </b><?=$nome_empresa;?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <div class="modal-body">
                                <form method="post" id="formRenovar_<?=$user_id;?>">
                                 <div class="form-group">

                                    <label>Nova data:</label>
                                    <input class="form-control dataNascimento" type="text" name="empresa_data_renovacao" required placeholder="00/00/0000">

                                </div>

                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="user_id" value="<?=$user_id;?>">
                            </form>
                            <button type="button" data-iddaloja="<?=$user_id;?>" class="btn btn-primary salvarnovadata">Salvar</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- FIM DO MODAL --> 


            <button type="button" data-idusereloja="<?=$user_id;?>" class="btn btn-danger excluirlojaeuser">                                         
               <i class="fa fa-trash" aria-hidden="true"></i> Excluir
           </button>


       </td>
   </tr>



</tbody>
<?php
endforeach;
else:
    $pager->ReturnPage();
endif;
?>
</table>
</div>
</div>
</div>
</div>

<nav aria-label="Page navigation example">
    <?php    

    if(!empty($quary) && !empty($quary2)):
        $pager->ExePaginator("ws_empresa", "{$quary}", "{$quary2}");
else:
    $pager->ExePaginator("ws_empresa");
endif;


echo $pager->getPaginator();
?>
</nav>
<?php

?>

<script type="text/javascript">

    $(document).ready(function(){

        $('.excluirlojaeuser').click(function(){
            var iduserloja = $(this).data('idusereloja');

            x0p({
                title: 'Atênção',
                text: 'Excluir esse cliente?',
                icon: 'info',
                animationType: 'fadeIn',
                buttons: [
                {
                    type: 'cancel',
                    text: 'Cancelar'
                },
                {
                    type: 'info',
                    text: 'Sim',
                    showLoading: true
                }
                ]
            }).then(function(data) {
                if(data.button == 'info') {
        // Simulate Delay
        setTimeout(function() {



            $.ajax({
                url: '<?=$site;?>admin/controlers/excluircliente.php',
                method: 'post',
                data: {'idcliente' : iduserloja},
                success: function(data){
                    if(data == 0){
                        window.location.reload(1);
                    }else if(data == 1){
                        window.location.reload(1);
                    }
                }
            });




        }, 1500);
    }
});


        });
    });




</script>

