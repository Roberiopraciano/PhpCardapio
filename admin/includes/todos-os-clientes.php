<?php
$seach = filter_input(INPUT_POST, 's', FILTER_DEFAULT);
if(!empty($seach)):
	header("Location: {$site}admin/painel.php?exe=todos-os-clientes&s={$seach}");
endif;


$search_url = filter_input(INPUT_GET, 's', FILTER_VALIDATE_INT);


//INICIO PAGINAÇÃO
$getpage = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);


$quary   = "";
$quary2  = "";
if(!empty($search_url)):
	$pager = new Pager("{$site}admin/painel.php?exe=todos-os-clientes&s={$search_url}&page="); 
	$quary   = "WHERE user_plano = :linkzero ";
	$quary2  = "linkzero={$search_url}&";
else:
	$pager = new Pager("{$site}admin/painel.php?exe=todos-os-clientes&page="); 

endif;

$pager->ExePager($getpage, 10);
//FIM PAGINAÇÃO


?>
<div class="row">
	<div class="col-md-12">
		<div class="panel">
			<div class="panel-heading">TODOS OS CLIENTES</div>
			<div class="panel-heading">
				<div class="row">

					<form method="post">
						<div class="input-group m-b-30">  
						<select name="s" class="form-control">
							<option value="1"><?=$texto['nomePlanoUm'];?></option>
							<option value="2"><?=$texto['nomePlanoDois'];?></option>
							<option value="3"><?=$texto['nomePlanoTres'];?></option>
						</select>                 
							
							<span class="input-group-btn"> 
								<button class="btn btn-info" type="submit">Pesquisar</button> 
							</span> 
						</div>
					</form>
					<?php
					if(!empty($search_url)):
						echo '<a href="'.$site.'admin/painel.php?exe=todos-os-clientes"><button id="demo-btn-addrow" class="btn btn-outline btn-primary btn-sm"><i class="icon wb-plus" aria-hidden="true"></i>Todos os clientes</button></a>';
					endif;
					?>
				</div>
			</div>

			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>

							<th>Nome</th>
							<th>Sobrenome</th>
							<th>E-mail</th>
							<th>Cidade</th>
							<th>Estado</th>
							<th>Bairro</th>							
							<th>Rua / Nº</th>							
							<th>Telefone</th>
							<th>Plano</th>
							<th>Status</th>

						</tr>
					</thead>

					<?php

					$lerbanco->ExeRead("ws_users", "{$quary}ORDER BY user_id DESC LIMIT :limit OFFSET :offset", "{$quary2}limit={$pager->getLimit()}&offset={$pager->getOffset()}");
					if($lerbanco->getResult()):
						?>
						<tbody>
							<?php
							foreach ($lerbanco->getResult() as $getempresa):
								extract($getempresa);
								?>


								<tr>
									<td>
										<?=(!empty($user_name) ? $user_name: "");?>
									</td>

									<td>
										<?=(!empty($user_lastname) ? $user_lastname: "");?>
									</td>

									<td>
										<?=(!empty($user_email) ? $user_email: "");?>

									</td>

									<?php
									$lerbanco->ExeRead("ws_empresa", "WHERE user_id = :userid", "userid={$user_id}");
									if ($lerbanco->getResult()):
										foreach ($lerbanco->getResult() as $tclientes):
											extract($tclientes);
										endforeach;
									endif;
									?>

									<td><?=(!empty($cidade_empresa) ? $cidade_empresa: "");?></td>
									<td><?=(!empty($end_uf_empresa) ? $end_uf_empresa: "");?></td>
									<td><?=(!empty($end_bairro_empresa) ? $end_bairro_empresa: "");?></td>
									<td><?=(!empty($end_rua_n_empresa) ? $end_rua_n_empresa: "");?></td>

									<td >
										<?php
											$user_telefonee = preg_replace("/[^0-9]/", "", $user_telefone);
										?>
										 <a style="font-weight: bold;color: green;" href="https://api.whatsapp.com/send?1=pt_BR&phone=55<?=$user_telefonee;?>" target="_blank">
										<?=(!empty($user_telefone) ? $user_telefone : "");?>
									</a>
									</td>							

									<td>
										<?php
										if($user_plano == 1):
											echo $texto['nomePlanoUm'];
										elseif($user_plano == 2):
											echo $texto['nomePlanoDois'];
										elseif($user_plano == 3):
											echo $texto['nomePlanoTres'];
										endif;

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
		$pager->ExePaginator("ws_users", "{$quary}", "{$quary2}");
else:
	$pager->ExePaginator("ws_users");
endif;


echo $pager->getPaginator();
?>
</nav>
<?php

?>