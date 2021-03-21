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
	$updateacesso->EUpdaxete("ws_users", $string_last, "WHERE user_id = :uselast", "uselast={$userlogin['user_id']}");

	unset($_SESSION['userlogin']);
	header("Location: {$site}");
endif;
?>


<script type="text/javascript">

</script>
<script src="<?=$site;?>js/MSFmultiSelect.js"></script>

<style type="text/css">
	.msf_multiselect_container .msf_multiselect {
		border: 1px solid #e4e4e4;
		list-style-type:none;
		margin: 0;
		padding: 0;
		position: absolute;
		z-index: 240;
		width: 92%;
	}
	.msf_multiselect li:hover, .sb_multiselect li:active, .sb_multiselect li:focus{
		background-color: #e5e5e5;
	}
	.msf_multiselect li.active{
		background-color: #e5e5e5;

	}
	.msf_multiselect li{
		padding-left: 4px;
		background-color: #ffffff;
		cursor: pointer;
	}
	.msf_multiselect_container textarea{
		resize: none;
		padding-left: 2px;
		padding-top: 2px;
		overflow: auto;
	}
	.msf_multiselect_container .msf_multiselect{
		height: 200px;
		overflow: auto;
		background-color: white;
		display: grid;
		text-align: left;	
	}
	.msf_multiselect label{
		display: block;
		margin-bottom: 1px;
	}

</style>

<div id="contato_do_site">
	<div style="background-color:#ffffff;" class="container margin_60">     
		<div class="row"> 
			<div class="col-md-8 col-md-offset-2"> 

				<div id="success"></div>
				<div id="sendnewpass" class="indent_title_in">
					<i class="icon-plus-squared"></i>
					<h3><strong>OBSERVAÇÕES</strong></h3>
					<p>
						<b>Adicione observações pré definidas aos itens.</b>
					</p>					
					<br />
					<form id="formaddadicional" method="post">
						<div class="row">							
							<div class="col-md-12 col-sm-12">
								<div class="form-group">
									<label for="nome_observacao">Nome</label>
									<input required type="text" name="nome_observacao" id="nome_observacao" class="form-control" placeholder="Exe: observações (bem passado, sem cebola, etc)" />
									<small class="form-text text-muted">
										Nome do adicional!
									</small>
								</div>
							</div>
							
						</div>	
						
						<div>
							<div>
								<label for="id_categoria">Categoria</label>
								<div id="myselect">
									<select required class="form-control" id="id_categoria" name="id_categoria">									
										<?php
										$lerbanco->ExeRead("ws_cat", "WHERE user_id = :userid", "userid={$userlogin['user_id']}");
										if (!$lerbanco->getResult()):
											echo "<option value=\"\">Cadastre categorias</option>";
										else:										
											foreach ($lerbanco->getResult() as $cat):
												extract($cat);
												echo "<option value=\"{$id}\"> {$nome_cat}</option>";
											endforeach;
										endif;
										?>
									</select>
								</div>
								<small class="form-text text-muted">
									Selecione as categorias para vincular.
								</small>
								
							</div>
						</div>


						<input type="hidden" name="user_id" value="<?=$userlogin['user_id'];?>">
						<button class="btn btn-primary">Cadastrar</button>
					</form>
					<br />
					<br />
					<br />
				</div>
			</div><!-- End col  -->
		</div><!-- End row  -->



		<?php
		$getdadosobservacao = filter_input_array(INPUT_POST, FILTER_DEFAULT);

		if(!empty($getdadosobservacao)):	

			$getdadosobservacao = array_map('strip_tags', $getdadosobservacao);
			$getdadosobservacao = array_map('trim', $getdadosobservacao);


			if(in_array('', $getdadosobservacao)):
				echo "<script>
				x0p('Opss...', 
				'Preencha todos os campos!',
				'error', false);
				</script>";
			else:		

				$addbanco->ExeCreate("ws_observacoes", $getdadosobservacao);
				if($addbanco->getResult()): 
					header("Location: {$site}{$Url[0]}/add-observacao");
				else:
					echo "<script>
					x0p('Opss...', 
					'Ocorreu um erro ao cadastrar!',
					'error', false);
					</script>";
				endif;
			endif;
		endif;


		$getdelldate = filter_input(INPUT_GET, 'ex', FILTER_VALIDATE_INT);

		if(!empty($getdelldate)):
			$deletbanco->ExeDelete("ws_observacoes", "WHERE id_obs = :delobs", "delobs={$getdelldate}");
			if($deletbanco->getResult()):
				header("Location: {$site}{$Url[0]}/add-observacao");
			else:
				echo "<script>
				x0p('Opss...', 
				'Ocorreu um erro ao cadastrar!',
				'error', false);
				</script>";
			endif;
		endif;
		?>


		<div id="contentoptions" class="form-group">
			<!--|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
			<?php
			$lerbanco->FullRead("SELECT * FROM ws_observacoes WHERE user_id = :userid ORDER BY id_obs DESC", "userid={$userlogin['user_id']}");
			if($lerbanco->getResult()):				
				?>		


				<div class="table-responsive">
					<table data-sortable class="table table-hover table-striped">
						<thead class="thead-dark">
							<tr>
								<th scope="col">Categoria</th>
								<th scope="col">Descrição</th>


								<th scope="col">Excluir</th>

							</tr>
						</thead>
						<tbody>
							<?php
							foreach ($lerbanco->getResult() as $extractdadositens):
								extract($extractdadositens);
								?>

								<tr>	
									<td>
										<?php
										$lerbanco->ExeRead("ws_cat", "WHERE user_id = :userid AND id = :idcat", "userid={$userlogin['user_id']}&idcat={$id_categoria}");
										if (!$lerbanco->getResult()):

										else:										
											$getnomeobs = $lerbanco->getResult();
											echo $getnomeobs[0]['nome_cat'];
										endif;
										?>
									</td>
									<td>
										<?=$nome_observacao;?>
									</td>						

									

									<td>
										<a href="<?=$site.$Url[0]."/add-observacao&ex={$id_obs}";?>">
											<button type="button" class="btn btn-danger btnexcluiradicional">Excluir</button>
										</a>
									</td>
									
								</tr>
								<?php
							endforeach;
							?>
						</tbody>
					</table>
				</div>
				<?php

			else:
			endif;
			?>


			<!--|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
		</div><!-- End form-group -->
	</div>
</div><!-- End container  -->


