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

<style type="text/css">
	@import "compass/css3";

	.columns {
		padding: 1em;
		font-weight: bold;
	}

	.article {
		background: #ccc;
	}

	.posts {
		background: ##CCCCCC;
	}
	.tweets {
		background: #32ccfe;
	}

	/* Default styles shown in demo */
	.numble-wrapper{
		/* contains the original input and the numble control */
	}

	.numble-control{
		width: 150px;
		height: 40px;
		padding: 10px;
		border: 1px solid #ccc;
		color: #5D8CAE;
		font-family: Arial;
		background-color: #EEEEEE;
		position: relative; /* should probably keep this, the rest can be customized to your liking */
	}

	/* These styles are only applicable if includeButtons is set to true */
	.numble-control .numble-arrow{
		position: absolute;
		right: 2px;
		font-size: 0.8em;
		cursor: pointer;
	}

	.numble-control .numble-increment{
		top: 5px;
	}

	.numble-control .numble-decrement{
		top: 20px;
	}
</style>

<div id="contato_do_site">
	<div style="background-color:#ffffff;" class="container margin_60">   		 
		<div class="row"> 
			<div class="col-md-8 col-md-offset-2">  

				<div id="success"></div>
				<div id="sendnewpass" class="indent_title_in">
					<i class="icon-plus-squared"></i>
					<h3><strong>Tipos e Tamanhos de Produtos</strong></h3>
					<p>
						<b>Cadastre ou altere os tipos de produto por tamanho e suas opções de tamanho</b>
					</p>
					<br />

					<button data-toggle="modal" data-target="#modaladdtipo" class="btn btn-success" style="width: 100px;">+ Novo Tipo</button>
					<button data-toggle="modal" data-target="#modaladdtamanho"  class="btn btn-success" style="width: 130px;">+ Novo Tamanho</button>					

					<br />

					<div class="main-content row">
						<div class="article large-6 columns" style="background-color: #ffffff;">

							<div id="loadtipos">
								<style type="text/css">
									.btnbackgroundcolor{
										background-color: #EC008C;
										font-weight: bold;
										color: #ffffff;
										border-color:  #EC008C;
									}
								</style>
								<?php
								$lerbanco->FullRead("SELECT * FROM ws_tipo_produto WHERE user_tipo_produto = :userid ORDER BY id_tipo_produto DESC", "userid={$userlogin['user_id']}");
								if($lerbanco->getResult()):				
									echo "	<label for=\"nome_tipo_produto\">Clique no tipo para ver as opções de tamanho:</label><br />";
									foreach ($lerbanco->getResult() as $extrairtipos):
										extract($extrairtipos);
										echo "<button id=\"botao_{$id_tipo_produto}\" data-idtipo=\"{$id_tipo_produto}\" class=\"btn btn-dark btn-xs btngettipo\">{$nome_tipo_produto}</button>&nbsp;&nbsp;";
									endforeach;
								endif;
								?>
								<script type="text/javascript">
									$(document).ready(function(){
										$('.btngettipo').click(function(){									
											$('.btngettipo').removeClass('btnbackgroundcolor');
											var getidtipo = $(this).data('idtipo');
											$(this).prop('disabled', true);

											$.ajax({
												url: '<?=$site?>includes/loadtamanhos.php',
												method: 'post',
												data: {'user_id' : '<?=$userlogin['user_id'];?>', 'tipo_id' : getidtipo},
												success: function(data){
													$('.table-responsive').html(data);								
													$('.btngettipo').prop('disabled', false);
													$('#botao_' + getidtipo).addClass('btnbackgroundcolor');
												}
											});

										});
									});
								</script>
							</div></div>

							<div class="posts large-3 columns">
								<div class="table-responsive">
								</div>
							</div>
						</div>
					</div>
				</div><!-- End col  -->
			</div><!-- End row  -->


			<!-- MODAL -->
			<div class="modal fade" id="modaladdtipo" style="margin-top: 100px;" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">

						<div class="modal-body">
							<div class="form-group">
								<form id="formaddtipo" style="margin-top: 10px;" method="post">
									<div>
										<div class="form-group">
											<label for="nome_tipo_produto">DESCRIÇÃO <small style="color: red;">*</small></label>
											<input type="text" name="nome_tipo_produto" id="nome_tipo_produto" class="form-control" placeholder="Pizza, Açai, etc" />
											<small class="form-text text-muted">
												Exemplo: Pizza, Milk Shake, Açai etc...
											</small>
										</div>
									</div>
									<input type="hidden" name="user_tipo_produto" value="<?=$userlogin['user_id'];?>">
									<a id="submittipo" class="btn btn-primary">Cadastrar</a>	
									<div id="resultadoformaddtipo"></div>				
								</form>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">FECHAR</button>
						</div>
					</div>
				</div>
			</div>
			<!-- MODAL -->

			<!-- MODAL -->
			<div class="modal fade" id="modaladdtamanho" style="margin-top: 30px;" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">

						<div class="modal-body">
							<div class="form-group">
								<form id="formaddoptiontamanho" style="margin-top: 10px;" method="post">
									<div>
										<div class="form-group">
											<label for="nome_option">DESCRIÇÃO <small style="color: red;">*</small></label>
											<input type="text" name="nome_option" id="nome_option" class="form-control" placeholder="Meio a Meio, Grande, Médio, Pequeno..." />
											<small class="form-text text-muted">
												Exemplo: Meio a Meio, Grande, Médio, Pequeno, etc...
											</small>
											<br />
											<br />

											<label for="valor_tamanho">VALOR R$ </label>
											<input required
											type="text" 
											name="valor_tamanho" 
											id="valor_tamanho" 
											class="form-control" 
											maxlength="11" 
											onkeypress="return formatar_moeda(this, '.', ',', event);" 
											data-mask="#.##0,00" 
											data-mask-reverse="true" 
											class="form-control" 
											placeholder="+ R$ 0,00" />
											<small id="emailHelp" class="form-text text-muted">
												Valor do Tamanho!
											</small>

											<br />
											<br />
											<label for="id_tipo">TIPO <small style="color: red;">*</small></label>
											<select class="form-control" name="id_tipo" id="id_tipo">
												<option value="">Selecione o tipo</option>
												<?php
												$lerbanco->FullRead("SELECT * FROM ws_tipo_produto WHERE user_tipo_produto = :userid ORDER BY id_tipo_produto DESC", "userid={$userlogin['user_id']}");
												if(!$lerbanco->getResult()):
													echo "<option value=''>Cadastre tipos de produtos</option>";
												else:
													foreach ($lerbanco->getResult() as $extrairtiposs):
														extract($extrairtiposs);
														echo "<option value=\"{$id_tipo_produto}\">{$nome_tipo_produto}</option>";
													endforeach;
												endif;
												?>
												
											</select>
											<br />								

											<div class="icheck-material-green">
												<input type="checkbox" name="meio_a_meio" value="false" id="meio_a_meio" />
												<label for="meio_a_meio"><strong>Permite personalizar 'meio a meio' com vários sabores?</strong></label>
											</div>
											<br />
											<!-- codigo de selecionar number  -->
											<div id="opcao" style="visibility: hidden;">
												<label for="qtdnumero">Qtd. máxima de sabores:</label>


												<input type="number" id="qtdnumero" name="total_qtd_itens" style="width: 50px;" />

												<div class="form-group">
												<label></label>
												<br />
												<div class="icheck-material-green">
													<input type="radio" checked id="meioameioum" value="1" required name="meio_a_meio_tipo" />
													<label for="meioameioum">Cobrar pelo valor do item mais caro.</label>
												</div>
												<div class="icheck-material-green">
													<input type="radio" id="meioameiodois" required value="2" name="meio_a_meio_tipo" />
													<label for="meioameiodois">Cobrar o valor inserido acima.</label>
												</div>

											</div>
											</div>

											


											<!-- codigo de selecionar number  -->

										</div>
									</div>
									<input type="hidden" name="user_id" value="<?=$userlogin['user_id'];?>">
									<a id="submitoption" class="btn btn-primary">Cadastrar</a>					
								</form>
								<div id="resultadoformaddoption"></div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">FECHAR</button>
						</div>
					</div>
				</div>
			</div>
			<!-- MODAL -->
			<script type="text/javascript">
				$(document).ready(function(){
					$('#submitoption').click(function(){					

						$(this).html('AGUARDE...');
						if($("#nome_option").val() == '' || $("#valor_tamanho").val() == '' || $("#id_tipo").val() == ''){
							$('#resultadoformaddoption').html('<br /><b style="color:red;">Preencha os campos obrigatórios!</b>');
							setTimeout(function () {
								$('#resultadoformaddoption').html('');
							}, 3000);
							$(this).html('Cadastrar');
						}else{
							var iddotipo = $("#id_tipo").val();

							$.ajax({
								url: '<?=$site?>includes/processaaddoptions.php',
								method: 'post',
								data: $('#formaddoptiontamanho').serialize(),
								success: function(data){
									$('#submitoption').html('Cadastrar');
									$('#resultadoformaddoption').html('');
									$('#modaladdtamanho').modal('hide');

									$("#opcao").css("visibility","hidden");
									$("#meio_a_meio").val("false");

									if(data == 'true'){
										window.location.reload(1);
									}else if(data == 'false'){
										x0p('Opss...', 
											'OCORREU UM ERRO!',
											'error', false);
									}

									$('#formaddoptiontamanho').each(function () {
										this.reset();
									});


								}
							});
						}
					});
				});
			</script>


			<script type="text/javascript">
				$(document).ready(function(){
					$('#submittipo').click(function(){

						$(this).html('AGUARDE...');
						if($("#nome_tipo_produto").val() == ''){						
							$('#resultadoformaddtipo').html('<br /><b style="color:red;">Preencha o campo descrição!</b>');
							setTimeout(function () {
								$('#resultadoformaddtipo').html('');
							}, 3000);
							$(this).html('Cadastrar');
						}else{

							$.ajax({
								url: '<?=$site?>includes/processaaddtipo.php',
								method: 'post',
								data: $('#formaddtipo').serialize(),
								success: function(data){
									$('#submittipo').html('Cadastrar');
									$('#resultadoformaddtipo').html('');
									$('#modaladdtipo').modal('hide');

									if(data == 'true'){
										window.location.reload(1);
									}else if(data == 'false'){
										x0p('Opss...', 
											'OCORREU UM ERRO!',
											'error', false);
									}

									$('#formaddtipo').each(function () {
										this.reset();
									});

								}
							});
						}


					});
				});
			</script>

			<script src="<?=$site;?>js/jquery.numble.min.js"></script>
			
			<script type="text/javascript">
				$("#qtdnumero").numble({
					minValue: 2,
					maxValue: 100,
					initialValue: 2
				});
			</script>

			<script>

				$("#meio_a_meio").click(function(){

					if($(this).val()=="true"){
						$("#opcao").css("visibility","hidden");
						$(this).val("false");

						$('#valor_tamanho').val('');
					}
					else{
						$("#opcao").css("visibility","visible");
						$(this).val("true");

						$('#valor_tamanho').val('0,00');
					}


				});
			</script>			
			<!--|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
		</div><!-- End form-group -->
	</div>

</div><!-- End container  -->






