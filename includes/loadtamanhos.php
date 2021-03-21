<?php 
ob_start();
session_start();
require('../_app/Config.inc.php');
require('../_app/Mobile_Detect.php');
$detect = new Mobile_Detect;
$site = HOME;

$lerbanco->FullRead("SELECT * FROM ws_opcoes_itens WHERE user_id = :userid AND id_tipo = :idtipo ORDER BY id_option DESC", "userid={$_POST['user_id']}&idtipo={$_POST['tipo_id']}");
if(!$lerbanco->getResult()):
	echo "<b style='color: red;'>AINDA NÃO EXISTEM OPÇÕES DE TAMANHO PARA ESSE TIPO DE PRODUTO</b><br /><br />";
else:
	?>

	<style type="text/css">
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
	<script src="<?=$site;?>js/jquery.numble.min.js"></script>

	<!--Table-->
	<table class="table">

		<!--Table head-->
		<thead style="color: #ED008C;">
			<tr><b>
				<th>Tamanhos</th>

				<th class="th-lg">Editar</th>
				<th class="th-lg">Excluir</th>
			</b>
		</tr>
	</thead>
	<!--Table head-->

	<!--Table body-->
	<tbody>
		<?php
		foreach ($lerbanco->getResult() as $extrairtamanhos):
			extract($extrairtamanhos);
			?>

			<tr>
				<td><?=$nome_option;?></td>
				<td>

					<button class="btn btn-success btn-xs editartamanho" data-toggle="modal" data-target="#modaleditartamanho_<?=$id_option;?>">Editar</button>

					<!-- MODAL -->
					<div class="modal fade" id="modaleditartamanho_<?=$id_option;?>" style="margin-top: 80px;" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">

								<div class="modal-body">
									<div class="form-group">
										<form id="formeditartamanho_<?=$id_option;?>" style="margin-top: 10px;" method="post">
											<div>
												<div class="form-group">
													<label for="edit_nome_option">DESCRIÇÃO <small style="color: red;">*</small></label>
													<input type="text" name="edit_nome_option" value="<?=$nome_option;?>" id="edit_nome_option" class="form-control" placeholder="Meio a Meio, Grande, Médio, Pequeno..." />
													<small class="form-text text-muted">
														Exemplo: Meio a Meio, Grande, Médio, Pequeno, etc...
													</small>
													<br />
													<br />

													<label for="edit_valor_tamanho">VALOR R$</label>
													<input required
													type="text" 
													name="edit_valor_tamanho" 
													id="edit_valor_tamanho" 
													class="form-control" 
													maxlength="11" 
													onkeypress="return formatar_moeda(this, '.', ',', event);" 
													data-mask="#.##0,00" 
													data-mask-reverse="true" 
													class="form-control" 
													placeholder="+ R$ 0,00"
													value="<?=Check::Real($valor_tamanho);?>" />
													<small id="emailHelp" class="form-text text-muted">
														Valor do Tamanho!
													</small>

													<br />
													<br />
													<label for="edit_id_tipo">TIPO <small style="color: red;">*</small></label>
													<select disabled class="form-control" name="edit_id_tipo" id="edit_id_tipo">

														<?php
														$lerbanco->FullRead("SELECT * FROM ws_tipo_produto WHERE user_tipo_produto = :userid AND id_tipo_produto = :idtipo", "userid={$_POST['user_id']}&idtipo={$id_tipo}");
														if(!$lerbanco->getResult()):
															echo "<option value=''>Cadastre tipos de produtos</option>";
														else:

															$resultgettamanhos = $lerbanco->getResult();
															echo "<option value='{$resultgettamanhos[0]['id_tipo_produto']}'>{$resultgettamanhos[0]['nome_tipo_produto']}</option>";
														endif;
														?>

													</select>
													<br />								

													<div class="icheck-material-green">
														<input <?=($meio_a_meio == 'true' ? 'checked' : '');?> type="checkbox" name="edit_meio_a_meio" value="true" id="edit_meio_a_meio_<?=$id_option;?>" />
														<label for="edit_meio_a_meio_<?=$id_option;?>"><strong>Permite personalizar 'meio a meio' com vários sabores?</strong></label>
													</div>
													<br />

													<!-- codigo de selecionar number  -->
													<div id="edit_opcao_<?=$id_option;?>">
														<label for="edit_qtdnumero_<?=$id_option;?>">Qtd. máxima de sabores:</label>
														


														<input type="number" id="edit_qtdnumero_<?=$id_option;?>" name="edit_total_qtd_itens" style="width: 50px;" />

														<div class="form-group">
												<label></label>
												<br />
												<div class="icheck-material-green">
												<input type="radio" <?=($meio_a_meio_tipo == 1 || $meio_a_meio_tipo == 0 ? "checked" : "");?> id="meioameioum" value="1" required name="meio_a_meio_tipo" />
													<label for="meioameioum">Cobrar pelo valor do item mais caro.</label>
												</div>
												<div class="icheck-material-green">
													<input type="radio" <?=($meio_a_meio_tipo == 2 ? "checked" : "");?> id="meioameiodois" required value="2" name="meio_a_meio_tipo" />
													<label for="meioameiodois">Cobrar o valor inserido acima.</label>
												</div>

											</div>
													</div>
													<?php
													echo ($meio_a_meio != "true" ? "<script>$('#edit_opcao_{$id_option}').hide();</script>" : "");
													?>
													<script type="text/javascript">
														$(document).ready(function(){

															$("#edit_qtdnumero_<?=$id_option;?>").numble({
																minValue: 2,
																maxValue: 100,
																initialValue: <?=($total_qtd_itens != 'null' ? $total_qtd_itens : 2)?>
															});

															$("#edit_meio_a_meio_<?=$id_option;?>").click(function(){
																$("#edit_opcao_<?=$id_option;?>").toggle();
															});

														});
													</script>
													


													<!-- codigo de selecionar number  -->

												</div>
											</div>
											<input type="hidden" name="user_id" value="<?=$_POST['user_id'];?>">
											<input type="hidden" name="id_option" value="<?=$id_option;?>">
											<a id="edit_submitoption_<?=$id_option;?>" class="btn btn-primary editarotamanho" data-idoption="<?=$id_option;?>">Editar</a>					
										</form>
										<div id="resultadoformeditoption"></div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">FECHAR</button>
								</div>
							</div>
						</div>
					</div>
					<!-- MODAL -->


				</td>



				<td><button class="btn btn-danger btn-xs excluirtamanho" data-iddotamanho="<?=$id_option;?>">Excluir</button></td>
			</tr>

			<?php
		endforeach;
		?>


	</tbody>
	<!--Table body-->

</table>
<!--Table-->

<?php endif; ?>

<button class="btn btn-danger" id="excluirTipo" data-excluirtipo="<?=$_POST['tipo_id'];?>">EXCLUIR TIPO DE PRODUTO</button>

<script type="text/javascript">
	$(document).ready(function(){
		$('.editarotamanho').click(function(){
			var getiddomanhoeditar = $(this).data('idoption');

			if($("#edit_nome_option").val() == '' || $("#edit_valor_tamanho").val() == ''){
				$('#resultadoformeditoption').html('<br /><b style="color:red;">Preencha os campos Obrigatórios!</b>');
				setTimeout(function () {
					$('#resultadoformeditoption').html('');
				}, 3000);
			}else{
				$('#modaleditartamanho_'+getiddomanhoeditar).modal('hide');

				$.ajax({
					url: '<?=$site?>includes/processaeditarotamanho.php',
					method: 'post',
					data: $('#formeditartamanho_'+getiddomanhoeditar).serialize(),
					success: function(data){

						if(data == 'erro1'){
							x0p('Opss...', 
								'Preencha o campo descrição!',
								'error', false);
						}else if(data == 'true'){

								window.location.reload(1);

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
		$('#excluirTipo').click(function(){
			var getexcluirtipo = $(this).data('excluirtipo');
			

			x0p({
				title: 'Atênção',
				text: 'Excluir tipo de produto?',
				icon: 'info',
				animationType: 'fadeIn',
				buttons: [
				{
					type: 'cancel',
					text: 'NÃO'
				},
				{
					type: 'info',
					text: 'SIM',
					showLoading: true
				}
				]
			}).then(function(data) {
				if(data.button == 'info') {
        // Simulate Delay
        setTimeout(function() {
        	// ajax -------------        	
        	$.ajax({

        		url: '<?=$site;?>includes/processadeletaoptionstipo.php',
        		method: 'post',
        		data: {'user_id' : '<?=$_POST['user_id'];?>', 'id_tipo' : getexcluirtipo},
        		success: function(data){

        			if(data == 'true'){
        				window.location.reload(1);
        			}else{
        				x0p('Opss...', 
        					'OCORREU UM ERRO AO DELETAR O TAMANHO!',
        					'error', false);
        			}
        		}        		
        	});
        	// ajax -------------

        }, 1500);
    }
});
		});
	});
</script>


<script type="text/javascript">
	$(document).ready(function(){
		$('.excluirtamanho').click(function(){
			var getiddotamanhoexcluir = $(this).data('iddotamanho');
			var pegaiddottipo = '<?=$_POST['tipo_id'];?>';

			x0p({
				title: 'Atênção',
				text: 'Deseja excluir esse tamanho?',
				icon: 'info',
				animationType: 'fadeIn',
				buttons: [
				{
					type: 'cancel',
					text: 'NÃO'
				},
				{
					type: 'info',
					text: 'SIM',
					showLoading: true
				}
				]
			}).then(function(data) {
				if(data.button == 'info') {
        // Simulate Delay
        setTimeout(function() {

        	// ajax -------------
        	
        	$.ajax({

        		url: '<?=$site;?>includes/processadeletaoptions.php',
        		method: 'post',
        		data: {'user_id' : '<?=$_POST['user_id'];?>', 'id_tamanho' : getiddotamanhoexcluir},
        		success: function(data){

        			if(data == 'true'){
        				x0p('Tamanho deletado!', null, 'ok', false);
        				$('.table-responsive').load('<?=$site;?>includes/loadtamanhos.php', {'user_id' : '<?=$_POST['user_id'];?>', 'tipo_id' : pegaiddottipo});
        			}else{
        				x0p('Opss...', 
        					'OCORREU UM ERRO AO DELETAR O TAMANHO!',
        					'error', false);
        			}
        		}

        	});
        	// ajax -------------

        }, 1500);
    }
});

		});
	});
</script>








<?php 

ob_end_flush();
?>