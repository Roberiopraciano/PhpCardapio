<?php
if(!isDateExpired($empresa_data_renovacao, 1)):
	header("Location: {$site}");
endif;
?>
<?php
$newnumer = 1;
if(!isset($_SESSION['userlogin'])):
	?>
	<script type="text/javascript">

		$.ajax({
			url: '<?=$site;?>includes/processaviews.php',
			method: 'post',
			data: {'maisum' : '<?=$newnumer;?>', 'userid' : '<?=$getu;?>'},	
			success: function(data){		
			}		
		});

	</script>
	<?php
endif;
?>
<style type="text/css">

	#div-img-fome{
		margin: 0 auto;
		align-items: center;
		display: flex;
		flex-direction: row;
		flex-wrap: wrap;
		justify-content: center;
	}
	#img-fome {
		max-width:250px;
		max-height:200px;
		width: auto;
		height: auto;
	}





	#footer
	{
		background-color:#d9534f;
		position:fixed;
		bottom:0px;
		left:0px;
		right:0px;
		height:50px;
		margin-bottom:0px;
		text-align:center;
		text-decoration: none;
		color: #ffffff;
		width: 100%;
		font-weight: bold;
		cursor: pointer;
		padding-top: 15px;

	}
	#footer:hover{
		background-color:#00a000;
	}

	#footerr
	{
		background-color:#ff6247;
		position:fixed;
		bottom:0px;
		left:0px;
		right:0px;
		height:50px;
		margin-bottom:0px;
		text-align:center;
		text-decoration: none;
		color: #ffffff;
		width: 100%;
		font-weight: bold;
		cursor: pointer;
		padding-top: 15px;

	}
	#footerr:hover{
		background-color:#d9534f;
	}
</style>
<div class="row">	
	<div class="col-md-3">								
		<div class="box_style_1">
			<ul id="cat_nav">
				<?php
				$lerbanco->ExeRead('ws_cat', "WHERE user_id = :userid ORDER BY id", "userid={$getu}");
				if (!$lerbanco->getResult()):
					echo "<li><a><span>NÃO EXISTEM CATEGORIAS</span></a></li>";
				else:
					foreach ($lerbanco->getResult() as $iii):
						extract($iii);?>
						<li><a href="#<?=Check::Name($nome_cat);?>">
							<?php
							if (!empty($icon_cat) && file_exists("{$icon_cat}") && !is_dir("{$icon_cat}")):
								echo Check::Image($icon_cat, 'icone-categoria', 30, 30);
						else:
						endif;
						?>
						<?php echo "&nbsp;".$nome_cat;?> 
						<?php
						$totalDeItensPorCat = 0;
						$lerbanco->ExeRead('ws_itens', "WHERE id_cat = :nn AND user_id = :nnn", "nn={$id}&nnn={$getu}");
						if($lerbanco->getResult()):
							$totalDeItensPorCat = $lerbanco->getRowCount();
						endif;
						?>
						<span>(<?=$totalDeItensPorCat;?>)</span></a>
					</li>
					<?php 
				endforeach;
			endif;
			?>										
		</ul>
	</div>
	<!-- FINAL DA BOX DAS CATEGORIAS --> 	
	<div class="box_style_2 hidden-xs" id="help">
		<h4><?=$texto['msg_compartilhar'];?></h4>
		<!-- AddToAny BEGIN -->
		<div style="margin: 0 auto;align-items: center;display: flex;flex-direction: row;flex-wrap: wrap;justify-content: center;" class="a2a_kit a2a_kit_size_32 a2a_default_style" data-a2a-url="<?=$site.$nome_empresa_link;?>"> 		   
			<a class="a2a_button_facebook"></a>
			<a class="a2a_button_facebook_messenger"></a>
			<a class="a2a_button_twitter"></a>
			<a class="a2a_button_google_plus"></a>
			<a class="a2a_button_whatsapp"></a>
			<a class="a2a_button_telegram"></a>
		</div>
		<script async src="https://static.addtoany.com/menu/page.js"></script>
		<!-- AddToAny END -->
	</div>
</div>
<!-- End col-md-3 -->
<div class="col-md-6" <?=($detect->isMobile() ? "style=\"padding-left: 2px;padding-right: 2px;\"" : "");?>>
	<?php
	$diasemana = array('Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado');
	$data = date('Y-m-d');
	$diasemana_numero = date('w', strtotime($data));
	$diadehoje   = $diasemana[$diasemana_numero];
	//$todososdias = 'null';
	
	?>

	<div class="box_style_2" id="main_menu"  <?=($detect->isMobile() ? "style=\"padding-left: 2px;\"" : "");?>>

		<center><h2 class="inner"><!--<i class="icon-food-1"></i></i><i class="icon-fast-food"></i><i class="icon-food"></i> --> <?=$texto['msg_cardapio'];?> <!--<i class="icon-food"></i><i class="icon-fast-food"></i><i class="icon-food-1"></i></i>--></h2></center>

		<?php
		$lerbanco->ExeRead('ws_cat', "WHERE user_id = :useridd ORDER BY id", "useridd={$getu}");
		if (!$lerbanco->getResult()):
			echo "<li><a><span>VOCÊ AINDA NÃO CADASTROU NENHUM ITEM!</span></a></li>";
		else:
			foreach ($lerbanco->getResult() as $iiii):
				extract($iiii);
				$iddacategoria = $id;
				?>

				<h3 class="nomargin_top" <?php if($detect->isMobile()): echo "style='font-size:15px;'"; endif; ?> id="<?=Check::Name($nome_cat);?>"><strong><?=$nome_cat;?></strong></h3>
				<p <?php if($detect->isMobile()): echo "style='font-size:12px;'"; endif; ?>><?=($desc_cat != 'null' ? $desc_cat : '');?></p>
				<?php
				$lerbanco->ExeRead('ws_itens', "WHERE user_id = :useridr AND id_cat = :nnn", "useridr={$getu}&nnn={$id}");
				if(!$lerbanco->getResult()):
					echo "
					<div class=\"alert alert-info fade in nomargin\">
					<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>						  
					<p><center><b> {$texto['msg_disponibilidadeItens']} </b></center></p>
					</div>
					";
				else:

					?>
					<table class="table table-striped cart-list">


						<thead>
							<tr>
								<th>
									<?=$texto['msg_itemlop'];?>						
								</th>
								
							</tr>
						</thead>
						<tbody>											

							<?php							
							foreach($lerbanco->getResult() as $itemm):
								extract($itemm);
								$ido_DoItem = $id;
								$nome_do_item = $nome_item;


								$exp = explode(',', $dia_semana);
								if(in_array($diadehoje, $exp)):
									?>
									<tr>
										<td data-toggle="modal" data-target="#popuppedido_<?=$ido_DoItem;?>">
											<?php
											if (!empty($img_item) && $img_item != "null" && file_exists("uploads/{$img_item}") && !is_dir("uploads/{$img_item}")):										
												if($detect->isMobile()): 
													echo "<figure class=\"thumb_menu_list\">".Check::Image('uploads/'.$img_item, 'Imagem-item', 180, 180)."</figure>";

												else:
													echo "<figure class=\"thumb_menu_list\">".Check::Image('uploads/'.$img_item, 'Imagem-item', 180, 180)."</figure>";
												endif;
											else:
										//echo "<figure class=\"thumb_menu_list\"><img src=\"img/menu-thumb-1.jpg\" alt=\"thumb\"></figure>";
											endif;
											?>									
											<h5 style="margin-top: 3px;"><?=$nome_do_item;?></h5>
											<p>
												<?=$descricao_item;?>

											</p>
											<strong style="float: right;"><?php
											$lerbanco->ExeRead("ws_relacao_tamanho", "WHERE id_user = :useriid AND id_item = :idiitem", "useriid={$getu}&idiitem={$ido_DoItem}");
											if(!$lerbanco->getResult()):
												echo "<b style='cursor:pointer;'>R$ ".Check::real($preco_item)."</b>";
											else:
												$total = $lerbanco->getRowCount();

												echo "<span style='cursor:pointer;'>Ver Valores<span>";
											endif;


											?></strong>
										</td>


										<form id="addItemPost_<?=$ido_DoItem;?>" name="addItemPost_<?=$ido_DoItem;?>" method="post">
											<td class="options">
												<div class="dropdown dropdown-options">
													
													<!-- Modal -->
													<div style="margin-top: 10px;" class="modal fade popuppedido" id="popuppedido_<?=$ido_DoItem;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
														<div class="modal-dialog">
															<div class="modal-content">													
																<div class="modal-body">
																	<div class="dropdown-menupop" style="border-bottom: none;">
																		<a data-dismiss="modal" style="float: right;cursor: pointer;"id="fecharmodallogin" class="close-link"><i class="icon_close_alt2"></i></a>										
																		<center><b><?=$nome_item;?> <?php
																		$lerbanco->ExeRead("ws_relacao_tamanho", "WHERE id_user = :useriid AND id_item = :idiitem", "useriid={$getu}&idiitem={$ido_DoItem}");
																		if(!$lerbanco->getResult()):
																			echo "<br /><b style='color: #4eb93e;'>R$ ".Check::real($preco_item)."</b>";
																		else:
																			echo "<br /><b style='color: #4eb93e;'>Escolha uma opção abaixo</b>";
																		endif;


																		?></b></center>
																		<center>
																			<?php
																			if (!empty($img_item) && $img_item != "null" && file_exists("uploads/{$img_item}") && !is_dir("uploads/{$img_item}")):										

																				echo "<br /><img width=\"70%\" height=\"\" src=\"{$site}uploads/{$img_item}\" /><br /><br />";
																		endif;
																		?>
																	</center>
																	<?php
												// INICIO DAS OPÇÕES DE TAMANHO
																	$condum = 1;
																	$lerbanco->ExeRead("ws_relacao_tamanho", "WHERE id_user = :userid AND id_item = :iditem", "userid={$getu}&iditem={$ido_DoItem}");
																	if(!$lerbanco->getResult()):
																		echo "<input type=\"hidden\" name=\"valor\" value=\"{$preco_item}\">";
																	else:
																		echo "<h5>".$texto['msg_tamanho']."</h5>";

																		$resultgetbanco = $lerbanco->getResult();
																		$explodegettamanhos = explode(',', $resultgetbanco[0]['id_tamanho']);   

																		$totlaraytamanhos = count($explodegettamanhos);
																		$checkedd = ($totlaraytamanhos == 1 ? "checked" : "");

																		for ($i=0; $i < $totlaraytamanhos; $i++) { 
																			$lerbanco->ExeRead("ws_opcoes_itens", "WHERE user_id = :useridd AND (id_tipo = :iidtipo AND id_option = :idoption)", "useridd={$getu}&iidtipo={$resultgetbanco[0]['id_tipo']}&idoption={$explodegettamanhos[$i]}");	
																			if($lerbanco->getResult()):
																				foreach ($lerbanco->getResult() as $iptiosnarray):
																					extract($iptiosnarray);

																					$valordoption = "";
																					if($meio_a_meio == "null" && $meio_a_meio_tipo == 0 && $valor_tamanho != '0.00'):
																						$valordoption = $valor_tamanho;
																					elseif($meio_a_meio == "true" && $meio_a_meio_tipo == 1):
						 // $valordoption = $preco_item;
																					elseif($meio_a_meio == "true" && $meio_a_meio_tipo == 2 && $valor_tamanho != '0.00'):
																						$valordoption = $valor_tamanho;
																					endif;

																					echo "<label>
																					<input type=\"radio\" value=\"{$nome_option}-_-{$valordoption}\" data-iddacategoria=\"{$iddacategoria}\" data-iddoitem=\"{$ido_DoItem}\" data-idtaamanho=\"{$id_option}\" class=\"tamanho_item\"  name=\"valor\" />
																					{$nome_option} <span> ".($valordoption != "" ? "R$ ".Check::real($valordoption) : "")."</span>
																					</label>
																					";
																				endforeach; 
																			endif;										
																		}

																		?>
																		<div id="mostrarmeioameio_<?=$ido_DoItem;?>" class="ocultarmeioameio" >
																			





																			<?php
echo "<div id=\"cf_group_meioameio{$ido_DoItem}\" class=\"\">"; // AQUI E A DIV QUE CONFIGURA A QUANTIDADE QUE PODE SER SELECIONADO INICIO
$lerbanco->ExeRead('ws_itens', "WHERE user_id = :useridrr AND id_cat = :nnnn", "useridrr={$getu}&nnnn={$iddacategoria}");
if($lerbanco->getResult()):
	echo "<h5 class='hcinco'>Escolha <b id='valortotalint_{$ido_DoItem}'></b> sabores</h5>";
	foreach ($lerbanco->getResult() as $adicionalarray):
		extract($adicionalarray);
		//$checkopsabor = ($id == $ido_DoItem ? "checked disabled" : "");
		echo "<label>
		<input type=\"checkbox\" id=\"id_checkbox{$id}\" class=\"controlecheckbox\" name=\"sabormeioameio[]\" value=\"{$nome_item}-_-{$preco_item}\" /> {$nome_item} 
		<span>".($preco_item == '0.00' ? '' : 'R$ '.Check::real($preco_item))."</span>
		</label>";
	endforeach;	
	echo "<input type=\"hidden\" value=\"0\" id=\"alterarmeioameio_{$ido_DoItem}\" name=\"meio_a_meio_tipo\" />";
	echo "<br /><small id='infomeioameio_{$ido_DoItem}' style=\"color: red;\"></small>";

endif;


echo "</div>"; // AQUI E A DIV QUE CONFIGURA A QUANTIDADE QUE PODE SER SELECIONADO FIM
?>

</div>




<?php														
endif;
												// FINAL DAS OPÇÕES DE TAMANHO



$lerbanco->ExeRead("ws_adicionais_itens", "WHERE user_id = :userid AND status_adicional = :statusadicional", "userid={$getu}&statusadicional={$condum}");
if($lerbanco->getResult()):
	$mostrarnomemeioameio = 'false';
	foreach($lerbanco->getResult() as $extractditionais):
		extract($extractditionais);

		$catArray = explode(', ', $categorias_adicional);
		$toralCat = count($catArray);

		for ($i=0; $i < $toralCat; $i++) {		

			if($catArray[$i] == $iddacategoria):

				$mostrarnomemeioameio = 'true';
			endif;			
		}

	endforeach;

	$toaditionais = (!empty($number_adicional) && $number_adicional != 0 ? "Escolha ".$number_adicional." Opções" : "");
	echo ($mostrarnomemeioameio == "true" ? "<h5 class=\"totaladitionais\">".$texto['msg_adicionais']." ".$toaditionais."</h5>" : "");

	echo "<div id=\"cf_group_adicionais{$ido_DoItem}\" class=\"\">"; // AQUI E A DIV QUE CONFIGURA A QUANTIDADE QUE PODE SER 
	foreach($lerbanco->getResult() as $extractditionais):
		extract($extractditionais);

		$catArray = explode(', ', $categorias_adicional);
		$toralCat = count($catArray);

		for ($i=0; $i < $toralCat; $i++) {		

			if($catArray[$i] == $iddacategoria):

				echo "<label>
				<input id=\"{$i}\" type=\"checkbox\" name=\"adicional[]\" value=\"{$nome_adicional}-_-{$valor_adicional}\"> {$nome_adicional} 
				<span>".($valor_adicional == '0.00' ? '' : '+ R$ '.Check::real($valor_adicional))."</span>
				</label>";
			endif;			
		}

	endforeach;
	echo "</div>"; // AQUI E A DIV QUE CONFIGURA A QUANTIDADE QUE PODE SER SELECIONADO FIM
endif;
?>		

<script type="text/javascript">
	$(document).ready(function(){	

		$('#cf_group_adicionais<?=$ido_DoItem;?> input[type=checkbox]').change(function(){
			var maximopermitido = <?=(!empty($number_adicional) && $number_adicional != 0 ? $number_adicional : 1000)?>;
			var controle = $('#cf_group_adicionais<?=$ido_DoItem;?> input[type=checkbox]:checked').length;

			if(controle > maximopermitido){
				$(this).prop('checked', '');
				$(this).addClass("tremer");
				$('.totaladitionais').addClass("tremer");
				setTimeout(function() {
					$('input[type=checkbox]').removeClass("tremer");
					$('.totaladitionais').removeClass("tremer");
				}, 1000);
			};
		});
	});
</script>	

<!--INICIO DA QUANTIDADE-->
<h5><?=$texto['msg_quantidade'];?></h5>							
<div class="input-group">
	<span class="input-group-btn">
		<button style="height: 34px;" type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quantidade">
			<span class="glyphicon glyphicon-minus"></span>
		</button>
	</span>
	<input style="height: 34px;" type="text" name="quantidade" class="form-control input-number qtdpedido" value="1" min="1" max="100">
	<span class="input-group-btn">
		<button style="height: 34px;" type="button" class="btn btn-success btn-number" data-type="plus" data-field="quantidade">
			<span class="glyphicon glyphicon-plus"></span>
		</button>
	</span>
</div>
<!--FIM DA QUANTIDADE-->
<br />
<?php
$lerbanco->FullRead("SELECT * FROM ws_observacoes WHERE user_id = :userid AND id_categoria = :idcatt", "userid={$getu}&idcatt={$iddacategoria}");
if(!$lerbanco->getResult()):	
	?>
	<textarea class="form-control obsitem" rows="3" placeholder="<?=$texto['msg_obsItem'];?>" name="observacao"></textarea>
	<?php
else:
	echo "
		<h5>{$texto['msg_obsItem']}</h5>							
<div class=\"input-group\">
		";
	foreach ($lerbanco->getResult() as $addobservacoess):
		extract($addobservacoess);

		

		echo "<label>
		<input type=\"radio\" value=\"{$nome_observacao}\"  name=\"observacao\" />
		{$nome_observacao} <span></span>
		</label>
		";
		

	endforeach;
	echo "</div>";
endif;
?>

<input type="hidden" name="id-item" value="<?=$ido_DoItem;?>">
<input type="hidden" name="add-Item" value="true">
<input type="hidden" name="userid" value="<?=$getu;?>">
<input type="hidden" name="nome_item" value="<?=$nome_do_item;?>">
<input type="hidden" name="nomeloja" value="<?=$Url[0];?>">
<br />


</div>
<div class="modal-footer">
	<center><button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar janela</button></center>
	<br>
	<br>
	<br>
</div>
</div>

</div>

</div>
<?php
if(!empty($disponivel) && $disponivel == 1):
	?>	
	<a class="adicionarItemPedido_<?=$ido_DoItem;?>">
		<div id="footer">
			<b><?=$texto['msg_purchase'];?></b>
		</div>
	</a>

	
	<?php
else:
	?>	
	<div id="footerr">
		<b><?=$texto['msg_indisponivel'];?></b>
	</div>
	<?php
endif;
?>

<script type="text/javascript">
	$(document).ready(function(){

		$('.adicionarItemPedido_<?=$ido_DoItem;?>').click(function(){
			$.ajax({
				url: '<?= $site; ?>includes/processaAddItem.php',
				method: "post",
				data: $('#addItemPost_<?=$ido_DoItem;?>').serialize(),

				success: function(data){				
					$('#resultadoAddItem').html(data);					
					$('.qtdpedido').val('1');
				}
			});

		}); 
	});
</script>

</div>
</div>
</div>

</div>
</td>
</form>
</tr>
<?php
endif;
endforeach;
endif;
?>
</tbody>
</table>

<hr>
<?php 
endforeach;
endif;
?>
</div>

</div>
<div class="col-md-3" id="sidebar">

	<div class="theiaStickySidebar">
		<div id="cart_box" >
			<h3><?=$texto['msg_seu_pedido'];?> <i class="icon_cart_alt pull-right"></i></h3>					
			<?php
			if($cart->isEmpty()):
				
				echo "<div id=\"div-img-fome\"><figure><img id=\"img-fome\" src=\"{$site}img/imgfome.png\" title=\"img-fome\" alt=\"img-fome\" /></figure></div>";

			else:
				$allItems = $cart->getItems();
				?>
				<table class="table table_summary">
					<tbody>
						<?php
						$pedidos = '';
						$allItems = $cart->getItems();
						foreach ($allItems as $items) {
							foreach ($items as $item) {
								if(!empty($item['attributes']['totalAdicionais'])):
									$todosOsAdicionais = '';
									$todosOsAdicionaisSoma = 0;
									for($i=0; $i < $item['attributes']['totalAdicionais']; $i++):
										$todosOsAdicionais = $todosOsAdicionais.$item['attributes']['adicional_nome'.$i].', ';
										$todosOsAdicionaisSoma = ($todosOsAdicionaisSoma + $item['attributes']['adicional_valor'.$i]);
									endfor;
								endif;							

								$pedidos = $pedidos.'<b>'.$texto['msg_qtd'].'</b> '
								.$item['quantity'].'x '
								.$item['attributes']['nome']
								.'<br /><b>'.$texto['msg_adicionais'].'</b> '.
								(!empty($item['attributes']['totalAdicionais']) ? $todosOsAdicionais : $texto['msg_sem_adicionais'])
								.'<br />'

								.'<b>'.$texto['msg_valor'].'</b> R$ '.Check::Real(($item['attributes']['preco'] * $item['quantity']) + (!empty($item['attributes']['totalAdicionais']) ? ($todosOsAdicionaisSoma * $item['quantity']) : 0) )
								.'<br /><b>Obs: </b>'.$item['attributes']['observacao']

								.'<br /><a style="color:#C9302C;cursor:pointer;" data-id_item="'.$item['id'].'" data-item_hash="'.$item['hash'].'" class="remove_item"><i class="fa fa-trash-o" aria-hidden="true"></i> '.$texto['msg_remover_item'].'</a>'
								.'<br /><br />';
							}
						}
						echo $pedidos;

						?>
					</tbody>
				</table>
				<?php	

				echo "<button type=\"submit\" id=\"limparcarrinho\" class=\"btn btn-danger btn-block\">{$texto['msg_limpar_pedido']}</button>";	
			endif;
			?>
			<script type="text/javascript">
				$(document).ready(function(){
					$('#limparcarrinho').click(function(){	
						var statusclean = 'sim';			
						$('#limparcarrinho').prop('disabled', true);

						$.ajax({
							url: '<?= $site; ?>includes/processalimparcarrinho.php',
							method: 'post',
							data: {'limparcart':statusclean, 'getlojal' : '<?=$Url[0];?>'},
							success: function(data){
								$('#limparcarrinho').prop('disabled', false);
								$('#divlimparcarrinho').html(data);
							}
						});

					});
				});
			</script>
			<form data-toggle="validator" action="<?=$site.$Url[0].'/';?>carrinho" method="post">
				<hr>
				<div class="row" id="options_2" style="padding-left: 12px;">
					<?php if(!empty($confirm_delivery) && $confirm_delivery == "true"): ?>
						<div style="width: 100%;">
							<div class="radio icheck-success">					
								<input type="radio" required value='true' checked="" id="enterega" name="opcao_delivery" 
								required />
								<label for="enterega">
									<span style="color:#444;">
										<p style="font-size: 14px;"><?=$texto['msg_delivery'];?></p>
									</span>
								</label>
							</div>
						</div>
					<?php endif; ?>
					<?php if(!empty($confirm_balcao) && $confirm_balcao == "true"): ?>
						<div style="width: 100%;">
							<div class="radio icheck-success">					
								<input type="radio" required value='false' id="buscar" name="opcao_delivery" 
								required />
								<label for="buscar">
									<span style="color:#444;">
										<p style="font-size: 14px;"><?=$texto['msg_Buscar_pedido'];?></p>
									</span>
								</label>
							</div>
						</div>
					<?php endif; ?>
					<?php if(!empty($confirm_mesa) && $confirm_mesa == "true"): ?>
						<div style="width: 100%;">
							<div class="radio icheck-success">					
								<input type="radio" required value='false2' id="mesa" name="opcao_delivery" 
								required />
								<label for="mesa">
									<span style="color:#444;">
										<p style="font-size: 14px;"><?=$texto['msg_pedido_mesa'];?></p>
									</span>
								</label>
							</div>
						</div>
					<?php endif; ?>
				</div><!-- Edn options 2 -->	
				<hr>
				<table class="table table_summary">
					<tbody>
						<tr>
							<td>
								Pedido 
								<span class="pull-right">
									R$ <?=(!empty($cart->getAttributeTotal('preco')) ? Check::Real($cart->getAttributeTotal('preco')) : '0,00');?>

								</span>
							</td>
						</tr>
						<tr>
							<td>
								<?=$texto['msg_adicionais'];?> <span class="pull-right">
									R$ 
									<?php

							// Get all items in the cart

									$allItems = $cart->getItems();

									$totaldeadicionais = 0;

									foreach ($allItems as $items):

										foreach ($items as $item):

											$todosOsAdicionaisSoma2 = 0;
											if(!empty($item['attributes']['totalAdicionais'])):

												for($i=0; $i < $item['attributes']['totalAdicionais']; $i++):
													$todosOsAdicionaisSoma2 = ($todosOsAdicionaisSoma2 + $item['attributes']['adicional_valor'.$i]);
												endfor;
												$todosOsAdicionaisSoma2 = ($todosOsAdicionaisSoma2 * $item['quantity']);
											endif;

											$totaldeadicionais = $totaldeadicionais + $todosOsAdicionaisSoma2;


										endforeach;
									endforeach;

									echo Check::Real($totaldeadicionais);	

									?></span>
								</td>
							</tr>
							<?php
							if(!empty($_SESSION['desconto_cupom']) && $_SESSION['desconto_cupom']['user_id'] == $getu):
								?>
								<tr>
									<td>
										<a style="color: green">
											Desconto
											<span class="pull-right">
												<?=$_SESSION['desconto_cupom']['desconto'];?> %
											</span>
										</a>
									</td>
								</tr>
								<?php
							endif;
							?>
							<tr>
								<td class="total">
									<?php $total_do_pedido = $cart->getAttributeTotal('preco') + $totaldeadicionais; ?>
									Subtotal
									<span class="pull-right">
										R$ <b id="v-total-p">
											<?php
											if(!empty($_SESSION['desconto_cupom']) && $_SESSION['desconto_cupom']['user_id'] == $getu):
												$valordesconto = Check::porcentagem($_SESSION['desconto_cupom']['desconto'], $total_do_pedido);
												echo Check::Real($total_do_pedido - $valordesconto);
											else:
												echo Check::Real($total_do_pedido);
											endif;
											?>
										</b>
									</span>
								</td>

							</tr>
						</tbody>
					</table>	


					<hr>

					<a style="color:#ffffff;background-color:#34af23;" class="btn_full validarCupom"><?=$texto['msg_btn_cupom'];?> </a>
					<button type="submit" class="btn_full"><?=$texto['msg_confirmar_puschase'];?></button>
					<script type="text/javascript">
						$(document).ready(function(){
							$('.validarCupom').click(function(){
								x0p('Coloque seu código', null, 'input',
									function(button, text) {
										if(button == 'info'){
											$.ajax({
												url: '<?=$site;?>includes/processaativacupom.php',
												method: 'post',
												data: {'codigocupom' : text, 'iduser' : '<?=$getu;?>'},
												success: function(data){											
													if(data == 'erro0'){
														x0p('Opss...', 
															'Cupom inválido!',
															'error', false);
													}else if(data == 'erro1'){
														x0p('Opss...', 
															'Cupom vencido!',
															'error', false);
													}else if(data == 'erro2'){
														x0p('Opss...', 
															'Esse cupom expirou!',
															'error', false);
													}else if(data == 'erro3'){
														x0p('Opss...', 
															'Ocorreu um arro ao validdar!',
															'error', false);
													}else if(data == 'erro4'){
														x0p('Opss...', 
															'Você já tem um desconto Ativo!',
															'error', false);
													}else if(data == 'true'){
														x0p('Parabéns!', 
															'Desconto aplicado!', 
															'ok', false);
														$('#sidebar').load('<?=$site;?>includes/sidebar.php', {"getloja" : "<?=$Url[0];?>"});
													}

												}
											});
										}
										if(button == 'cancel') {
											x0p('Cancelado', 
												'Quer ganhar um desconto? Entre em contato.',
												'error', false);
										}
									});
							});
						});
					</script>	

				</form>
				<?php if($detect->isMobile()): ?>
					<hr />
					<div class="box_style_2" id="help">
						<h4><?=$texto['msg_compartilhar'];?></h4>
						<!-- AddToAny BEGIN -->
						<div style="margin: 0 auto;align-items: center;display: flex;flex-direction: row;flex-wrap: wrap;justify-content: center;" class="a2a_kit a2a_kit_size_32 a2a_default_style" data-a2a-url="<?=$site.$nome_empresa_link;?>"> 		   
							<a class="a2a_button_facebook"></a>
							<a class="a2a_button_facebook_messenger"></a>
							<a class="a2a_button_twitter"></a>
							<a class="a2a_button_google_plus"></a>
							<a class="a2a_button_whatsapp"></a>
							<a class="a2a_button_telegram"></a>
						</div>
						<script async src="https://static.addtoany.com/menu/page.js"></script>
						<!-- AddToAny END -->
					</div>
				<?php endif; ?>

			</div><!-- End cart_box -->
		</div><!-- End theiaStickySidebar -->

		<?php if(!$cart->isEmpty()):?>
			<div id="whatsapp"  >
				
				<a href="#sidebar" title="<?=$texto['msg_seu_pedido'];?>"><span style="opacity: 0.9;" class="cart-count"><?=($cart->getTotalItem() > 0 ? (int)$cart->getTotalItem() : 0);?></span><i style="opacity: 0.6;font-size:45px;color:#27771b;" class="icon-bag"></i>
				</a>
				
			</div>
		<?php endif; ?>
		<script type="text/javascript">
			$("#whatsapp a").click(function(event){
				event.preventDefault();
				var dest=0;
				if($(this.hash).offset().top > $(document).height()-$(window).height()){
					dest=$(document).height()-$(window).height();
				}else{
					dest=$(this.hash).offset().top;
				}
				$('html,body').animate({scrollTop:dest}, 1000,'swing');
			});
		</script>

	</div><!-- End col-md-3 -->

</div><!-- End row -->

<div id="resultadoAddItem"></div>
<div id="updatesidebar"></div>
<div id="divlimparcarrinho"></div>



<div id='goTop'></div>

<script type="text/javascript">
	$(function () {
		$('#goTop').goTop({
			scrolltime: 800,
			src:"icon-up-circled",
			width: 45,
			place:"left",
			fadein: 500,
			fadeout: 500,
			opacity: 0.6,
			marginX: 0,
			marginY: 0,
			zIndex: 9
		});
	});
</script>




<?php 

$lerbanco->ExeRead("cupom_desconto", "WHERE user_id = :iduser AND mostrar_site = :mostrarcupom", "iduser={$getu}&mostrarcupom=1");
if($lerbanco->getResult()):

	$getcupommostrar = $lerbanco->getResult();

	if($getcupommostrar[0]['total_vezes'] <= 0):
	elseif(!isDateExpired($getcupommostrar[0]['data_validade'], 1)):
	else:


		if((!empty($_COOKIE['popupcupom']) && $_COOKIE['popupcupom'] == $getcupommostrar[0]['id_cupom']) || !empty($_SESSION['desconto_cupom'])):
	else:
		?>

		<script type="text/javascript">
			x0p({
				title: '',
				text: 'Parabéns! Você ganhou um desconto de <?=$getcupommostrar[0]['porcentagem'];?>%. Ativar cupom?',
				animationType: 'slideUp',
				icon: 'custom',
				iconURL: '<?=$site?>img/cupomsdesconto.png',
				buttons: [
				{
					type: 'error',
					key: 49,
					text: 'Não Obrigado',

				},
				{
					type: 'info',
					key: 50,
					text: 'Ativar Desconto'
				}
				]
			}).then(function(data) {
				if(data.button == 'error'){
					$.ajax({
						method: 'post',
						data: {'user_id' : '<?=$getu;?>', 'idcupom' : '<?=$getcupommostrar[0]['id_cupom'];?>'},
						success: function(data){
						}
					});

				}else if(data.button == 'info'){
					$.ajax({
						method: 'post',
						data: {'codigodocupom' : '<?=$getcupommostrar[0]['ativacao'];?>', 'user_id' : '<?=$getu;?>'},
						success: function(data){
							if(data == 'erro0'){
								x0p('Opss...', 
									'Cupom inválido!',
									'error', false);
							}else if(data == 'erro1'){
								x0p('Opss...', 
									'Cupom vencido!',
									'error', false);
							}else if(data == 'erro2'){
								x0p('Opss...', 
									'Esse cupom expirou!',
									'error', false);
							}else if(data == 'erro3'){
								x0p('Opss...', 
									'Ocorreu um arro ao validdar!',
									'error', false);
							}else if(data == 'erro4'){
								x0p('Opss...', 
									'Você já tem um desconto Ativo!',
									'error', false);
							}else{
								x0p('Parabéns!', 
									'Desconto aplicado!', 
									'ok', false);
								$('#sidebar').load('<?=$site;?>includes/sidebar.php', {"getloja" : "<?=$Url[0];?>"});
							}
						}
					});
				}

			});
		</script>

		<?php
	endif;
endif;
endif;
?>
<style type="text/css">
	.tremer{
		animation: treme 0.1s;
		animation-iteration-count: 3;
	}

	@keyframes treme {
		0% {margin-left: 0;}
		25% {margin-left: 5px;}
		50% {margin-left: 0;}
		75% {margin-left: -5px;}
		100% {margin-left: 0;}
	}
</style>
<script type="text/javascript">
	$(document).ready(function(){
		$('.ocultarmeioameio').hide();
	});
</script>

<div id="resultadogetmeioameio"></div>

<script type="text/javascript">
	

	$('.tamanho_item').click(function (){
		var vaaloridtamahoclick = $(this).data('idtaamanho');
		var iddoitem = $(this).data('iddoitem');
		var iddacategoria = $(this).data('iddacategoria');

		$('input:checkbox').prop("checked", false);

		$('#id_checkbox'+iddoitem).prop("checked", true);
		$('#id_checkbox'+iddoitem).prop("readonly", true);

		$.ajax({
			url: '<?=$site;?>controlers/mostrar-meioameio.php',
			method: 'post',
			data: {'iditem' : iddoitem, 'idcat' : iddacategoria, 'idoption' : vaaloridtamahoclick, 'userid' : '<?=$getu;?>'},
			success:function(data){

				if(data == 0){

					$("#mostrarmeioameio_"+iddoitem).hide();
					$('#resultadogetmeioameio').html();
					
				}else{

					$('#resultadogetmeioameio').html(data);				
				}

			}
		});


		$.ajax({
			url: '<?=$site;?>controlers/alterar-tipo-meioameio.php',
			method: 'post',
			data: {'iditem' : iddoitem, 'idcat' : iddacategoria, 'idoption' : vaaloridtamahoclick, 'userid' : '<?=$getu;?>'},
			success:function(data){		

				document.getElementById('alterarmeioameio_'+iddoitem).value=data;	
				if(data == 1){
					$('#infomeioameio_'+iddoitem).text('* Será cobrado pelo sabor de maior valor');
				}else{
					$('#infomeioameio_'+iddoitem).text('');
				}				

			}
		});





	});


</script>

