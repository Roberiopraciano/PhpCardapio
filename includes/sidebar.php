<?php 
ob_start();
session_start();
require('../_app/Config.inc.php');
require('../_app/Mobile_Detect.php');

$site = HOME;
$detect = new Mobile_Detect;

$lerbanco->ExeRead('ws_empresa', "WHERE binary nome_empresa_link = :lemprise", "lemprise={$_POST['getloja']}");
if (!$lerbanco->getResult()):
	header("Location: {$site}");
else:
	$valorgetiduser = $lerbanco->getResult();
	$getu = $valorgetiduser[0]['user_id'];
	$getuverificadelivery = $valorgetiduser[0]['confirm_delivery'];
	$getuverificabalcao = $valorgetiduser[0]['confirm_balcao'];
	$getuverificamesa = $valorgetiduser[0]['confirm_mesa'];
endif;


$cart = new Cart([
	//Total de item que pode ser adicionado ao carrinho 0 = Ilimitado
	'cartMaxItem' => 0,

	// A quantidade máxima de um item que pode ser adicionada ao carrinho, 0 = Ilimitado
	'itemMaxQuantity' => 0,

	// Não usar cookies, os itens do carrinho desaparecerão depois que o navegador for fechado
	'useCookie' => false,
]);

?>


<script src="<?= $site; ?>js/theia-sticky-sidebar.js"></script>
<script>
	jQuery('#sidebar').theiaStickySidebar({
		additionalMarginTop: 80
	});
</script>


<script type="text/javascript">
	$(document).ready(function(){
		$('.remove_item').click(function(){
			$('.remove_item').prop('disabled', true);

			var id_item = $(this).data('id_item');
			var rash_item = $(this).data('item_hash');

			$.ajax({
				url: '<?= $site; ?>includes/processaremovercart.php',
				method: 'post',
				data: {'iditem':id_item,'itemrash':rash_item, 'getpegaloja' : '<?=$_POST['getloja'];?>'},

				success: function(data){
					$('.remove_item').prop('disabled', false);
					$('#updatesidebar').html(data);
				}
			});
		});


		var linkurl3 = '#sidebar';
		$('#sidebarlink').attr("href", linkurl3);
	});
</script>

<div class="theiaStickySidebar">
	<div id="cart_box" >
		<h3><?=$texto['msg_seu_pedido'];?> <i class="icon_cart_alt pull-right"></i></h3>					
		<?php
		if($cart->isEmpty()):
			
			echo "<div id=\"div-img-fome\"><figure><img style=\"max-width:250px;max-height:200px;width: auto;height: auto;\" id=\"img-fome\" src=\"{$site}img/imgfome.png\" title=\"img-fome\" alt=\"img-fome\" /></figure></div>";

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
							.'<br /><b>Obs:</b> '.$item['attributes']['observacao']

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
						data: {'limparcart':statusclean, 'getlojal' : '<?=$_POST['getloja'];?>'},
						success: function(data){
							$('#limparcarrinho').prop('disabled', false);
							$('#divlimparcarrinho').html(data);
						}
					});

				});
			});
		</script>
		<form id="irpcarrinho" data-toggle="validator" action="<?=$site.$_POST['getloja'].'/';?>carrinho" method="post">
			<hr />
			<div class="row" id="options_2" style="padding-left: 12px;">

					<?php if(!empty($getuverificadelivery) && $getuverificadelivery == "true"): ?>
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
					<?php if(!empty($getuverificabalcao) && $getuverificabalcao == "true"): ?>
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
					<?php if(!empty($getuverificamesa) && $getuverificamesa == "true"): ?>
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
										if(!empty($_SESSION['desconto_cupom'])  && $_SESSION['desconto_cupom']['user_id'] == $getu):
											echo Check::Real($total_do_pedido - Check::porcentagem($_SESSION['desconto_cupom']['desconto'], $total_do_pedido));
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

				<a style="color:#ffffff;background-color:#34af23;" class="btn_full validarCupom"><?=$texto['msg_btn_cupom'];?></a>
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
												}else{
													x0p('Parabéns!', 
														'Desconto aplicado!', 
														'ok', false);
													$('#sidebar').load('<?=$site;?>includes/sidebar.php', {'getloja' : '<?=$_POST['getloja'];?>'});
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
					<div style="margin: 0 auto;align-items: center;display: flex;flex-direction: row;flex-wrap: wrap;justify-content: center;" class="a2a_kit a2a_kit_size_32 a2a_default_style" data-a2a-url="<?=$site.$_POST['getloja'];?>"> 		   
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

			<a href="#sidebar" title="<?=$texto['msg_seu_pedido'];?>"> <span style="opacity: 0.9;" class="cart-count"><?=($cart->getTotalItem() > 0 ? (int)$cart->getTotalItem() : 0);?></span><i style="opacity: 0.6;font-size:45px;color:#27771b;" class="icon-bag"></i>
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


	<?php
	ob_end_flush();
	?>

