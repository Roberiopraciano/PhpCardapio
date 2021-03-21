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
					<h3><strong>ADIONAIS E COMPLEMENTOS</strong></h3>
					<p>
						<b>Adicione adicionais e complementos para os itens.</b>
					</p>					
					<br />
					<form id="formaddadicional" method="post">
						<div class="row">							
							<div class="col-md-6 col-sm-6">
								<div class="form-group">
									<label for="nome_adicional">Nome</label>
									<input required type="text" name="nome_adicional" id="nome_adicional" class="form-control" placeholder="Exe: adicionais (bacon, ovo, etc)" />
									<small class="form-text text-muted">
										Nome do adicional!
									</small>
								</div>
							</div>
							<div class="col-md-6 col-sm-6">
								<div class="form-group">
									<label for="valor_adicional">Valor R$</label>
									<input required
									type="text" 
									name="valor_adicional" 
									id="valor_adicional" 
									class="form-control" 
									maxlength="11" 
									onkeypress="return formatar_moeda(this, '.', ',', event);" 
									data-mask="#.##0,00" 
									data-mask-reverse="true" 
									class="form-control" 
									placeholder="+ R$ 0,00" />
									<small id="emailHelp" class="form-text text-muted">
										Valor do adicional! <span style="color: red;">0,00 caso seja grátis.</span>
									</small>
								</div>
							</div>
						</div>	
						
						<div>
							<div>
								<label for="nome_adicional">Categoria</label>
								<div id="myselect">
									<select required class="form-control"  id="multiselect" name="categorias_adicional[]" multiple="multiple"">									
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
						<div>
							<br />
							<div class="form-group">
								<label>Medida</label>
								<br />
								<div class="icheck-material-green icheck-inline">
									<input type="radio" checked id="medidaUN" value="UN" required name="medida_adicional" />
									<label for="medidaUN">UN</label>
								</div>
								<div class="icheck-material-green icheck-inline">
									<input type="radio" id="medidaKG" required value="KG" name="medida_adicional" />
									<label for="medidaKG">KG</label>
								</div>
								<div class="icheck-material-green icheck-inline">
									<input type="radio" id="medidaLT" value="LT" required name="medida_adicional" />
									<label for="medidaLT">LT</label>
								</div>
							</div>

						</div>

						<input type="hidden" name="user_id" value="<?=$userlogin['user_id'];?>">
						<input type="hidden" name="status_adicional" value="1">
						<button class="btn btn-primary">Cadastrar</button>
					</form>
					<br />
					<br />
					<br />
				</div>
			</div><!-- End col  -->
		</div><!-- End row  -->


	
		<?php
		$getdadosAddadicional = filter_input_array(INPUT_POST, FILTER_DEFAULT);

		if(!empty($getdadosAddadicional)):	

			$getdadosAddadicional['nome_adicional'] = trim($getdadosAddadicional['nome_adicional']);
			$getdadosAddadicional['nome_adicional'] = strip_tags($getdadosAddadicional['nome_adicional']);

			$getdadosAddadicional['valor_adicional'] = trim($getdadosAddadicional['valor_adicional']);
			$getdadosAddadicional['valor_adicional'] = strip_tags($getdadosAddadicional['valor_adicional']);

			$getdadosAddadicional['medida_adicional'] = trim($getdadosAddadicional['medida_adicional']);
			$getdadosAddadicional['medida_adicional'] = strip_tags($getdadosAddadicional['medida_adicional']);


			if(empty($getdadosAddadicional['nome_adicional']) || empty($getdadosAddadicional['valor_adicional']) || empty($getdadosAddadicional['medida_adicional']) || empty($getdadosAddadicional['categorias_adicional'])):
				echo "<script>
			x0p('Opss...', 
			'Preencha todos os campos!',
			'error', false);
			</script>";
		else:

			$getdadosAddadicional['valor_adicional'] = Check::Valor($getdadosAddadicional['valor_adicional']);
			$getdadosAddadicional['categorias_adicional'] = implode(', ', $getdadosAddadicional['categorias_adicional']);		

			$addbanco->ExeCreate("ws_adicionais_itens", $getdadosAddadicional);
			if($addbanco->getResult()): 
				header("Location: {$site}{$Url[0]}/add-adicionais");
			else:
				echo "<script>
				x0p('Opss...', 
				'Ocorreu um erro ao cadastrar!',
				'error', false);
				</script>";
			endif;
		endif;
	endif;
	?>


	<div id="contentoptions" class="form-group">
		<!--|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
		<?php
		$lerbanco->FullRead("SELECT * FROM ws_adicionais_itens WHERE user_id = :userid ORDER BY id_adicionais DESC", "userid={$userlogin['user_id']}");
		if($lerbanco->getResult()):				
			?>		


			<div class="table-responsive">
				<table data-sortable class="table table-hover table-striped">
					<thead class="thead-dark">
						<tr>
							<th scope="col">Categorias vinculadas</th>
							<th scope="col">Medida</th>
							<th scope="col">Nome</th>
							<th scope="col">Valor</th>							
							<th scope="col">Editar</th>
							<th scope="col">Excluir</th>
							<th scope="col">Pausar</th>
						</tr>
					</thead>
					<tbody>
						<?php
						foreach ($lerbanco->getResult() as $extractdadositens):
							extract($extractdadositens);
							?>
							<form method="post" id="formEditaradicional_<?=$id_adicionais;?>">
								<tr>	
									<td>
										<?php
										if(strpos($categorias_adicional, ', ')):											
											$catArray = explode(', ', $categorias_adicional);
											
											$toralCat = count($catArray);

											for ($i=0; $i < $toralCat; $i++) {									

												$lerbanco->ExeRead("ws_cat", "WHERE user_id = :userid AND id =:idcat", "userid={$userlogin['user_id']}&idcat={$catArray[$i]}");
												if($lerbanco->getResult()):
													$dadosnomesgat = $lerbanco->getResult();

													if(($i + 1) < $toralCat):
														echo $dadosnomesgat[0]['nome_cat'].', ';
													else:
														echo $dadosnomesgat[0]['nome_cat'];
													endif;
													
												endif;
											}

										else:
											$lerbanco->ExeRead("ws_cat", "WHERE user_id = :userid AND id =:idcat", "userid={$userlogin['user_id']}&idcat={$categorias_adicional}");
											if($lerbanco->getResult()):
												$dadosnomesgat = $lerbanco->getResult();
												echo $dadosnomesgat[0]['nome_cat'];
											endif;
										endif;
										;
										?>
									</td>
									<td>
										<?=$medida_adicional;?>
									</td>						
									<td>
										<?php
										echo '<input type="text" style="width: 200px"  name="nome_adicional" value="'.$nome_adicional.'" id="nome_adicional_'.$id_adicionais.'" class="form-control" placeholder="Exe: adicionais (bacon, ovo, etc)" />';
										?>
									</td>
									<td>
										<?php
										echo '<input 
										type="text"
										style="width: 100px"
										name="valor_adicional" 
										id="valor_adicional_'.$id_adicionais.'" 
										class="form-control" 
										maxlength="11" 
										onkeypress="return formatar_moeda(this, '.', ',', event);" 
										data-mask="#.##0,00" 
										data-mask-reverse="true" 
										class="form-control" 
										value="'.Check::Real($valor_adicional).'"
										placeholder="+ R$ 0,00" />';

										?>
									</td>

									<input type="hidden" name="id_adicionais" value="<?=$id_adicionais;?>">
									<input type="hidden" name="user_id" value="<?=$userlogin['user_id'];?>">
									<td><button data-id_adicional="<?=$id_adicionais;?>" id="btnEditarAdicional_<?=$id_adicionais;?>" type="button" class="btn btn-success editarbtnadicional">Editar</button></td>
								</form>

								<td>
									<button id="btnExcluiradicional_<?=$id_adicionais;?>" data-excluir_adicional="<?=$id_adicionais;?>" type="button" class="btn btn-danger btnexcluiradicional">Excluir</button>
								</td>
								<td>
									<button id="btnPausarAdicional_<?=$id_adicionais;?>" data-pausar_adicional="<?=$id_adicionais;?>" class="btn <?=($status_adicional == 1 ? 'btn-info' : 'btn-warning')?> btnpausaradicional">
										<?=($status_adicional == 1 ? '<i style="font-size: 20px;" class="fa fa-pause" aria-hidden="true"></i>' : '<i style="font-size: 20px;" class="fa fa-play" aria-hidden="true"></i>')?>					
									</button>
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



<script>
	var select=new MSFmultiSelect(
		document.querySelector('#multiselect'),
		{
			onChange:function(checked,value,instance){
				console.log(checked,value,instance);
			},
			selectAll:true,
			appendTo:'#myselect',
    //readOnly:true
}
);
</script>


<script type="text/javascript">
	$(document).ready(function(){
		$(".editarbtnadicional").click(function(){
			var idAdicional = $(this).data('id_adicional');

			$('#btnEditarAdicional_'+idAdicional).html('Aguarde...');
			$('#btnEditarAdicional_'+idAdicional).prop('disabled', true);


			if($("#valor_adicional_"+idAdicional).val() == '' || $("#nome_adicional_"+idAdicional).val() == ''){
				x0p('Opss...', 
					'Preencha os campos!',
					'error', false);
				$('#btnEditarAdicional_'+idAdicional).html('Editar');
				$('#btnEditarAdicional_'+idAdicional).prop('disabled', false);
			}else{

				$.ajax({
					url: '<?=$site;?>includes/processaeditaradicional.php',
					method: 'post',
					data: $('#formEditaradicional_'+idAdicional).serialize(),
					success: function(data){
						$('#btnEditarAdicional_'+idAdicional).html('Editar');
						$('#btnEditarAdicional_'+idAdicional).prop('disabled', false);

						if(data == 'true'){
							x0p('Sucesso!', 
								'O adicional foi atualizado!', 
								'ok', false);
						}else if(data == 'false'){
							x0p('Opss...', 
								'OCORREU UM ERRO!',
								'error', false);
						}

					}
				});

			}			

		});
	});
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('.btnexcluiradicional').click(function(){
			var btnexcluirad = $(this).data('excluir_adicional');

			GrowlNotification.notify({
				title: 'Atenção!',
				description: 'Tem certeza de que deseja deletar esse adicional?',
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
								url: '<?=$site;?>includes/processadeletaadicional.php',
								method: 'post',
								data: {'user_id' : '<?=$userlogin['user_id'];?>', 'id_adicionais' : btnexcluirad},
								success: function(data){
									if(data == 'true'){
										window.location.reload(1);
									}else{
										x0p('Opss...', 
											'OCORREU UM ERRO!',
											'error', false);
									}
								}
							});
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

<script type="text/javascript">
	$(document).ready(function(){
		$('.btnpausaradicional').click(function(){
			var idadicionalpausar = $(this).data('pausar_adicional');

			$('#btnPausarAdicional_'+idadicionalpausar).prop('disabled', true);

			$.ajax({
				url: '<?=$site;?>includes/processapausaradicional.php',
				method: 'post',
				data: {'user_id' : '<?=$userlogin['user_id'];?>', 'id_adicionais' : idadicionalpausar},
				success: function(data){
					if(data == 'true'){
						$('#btnPausarAdicional_'+idadicionalpausar).prop('disabled', false);
						window.location.reload(1);
					}else{
						x0p('Opss...', 
							'OCORREU UM ERRO!',
							'error', false);
						$('#btnPausarAdicional_'+idadicionalpausar).prop('disabled', false);
					}
				}
			});

		});
	});
</script>



