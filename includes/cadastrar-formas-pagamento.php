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

<?php
$getdellbairro = filter_input(INPUT_GET, 'delete', FILTER_VALIDATE_INT);

if(!empty($getdellbairro)):

	$lerbanco->ExeRead('ws_formas_pagamento', "WHERE user_id = :userid AND id_f_pagamento = :v1", "userid={$userlogin['user_id']}&v1={$getdellbairro}");
	if ($lerbanco->getResult()):
		$deletbanco->ExeDelete("ws_formas_pagamento", "WHERE user_id = :userid AND id_f_pagamento = :k1", "userid={$userlogin['user_id']}&k1={$getdellbairro}");
		if ($deletbanco->getResult()):
			header("Location: {$site}{$Url[0]}/cadastrar-formas-pagamento");
		else:
			echo "<script>
			x0p('Opss...', 
			'Ocorreu um Erro!',
			'error', false);
			</script>";
		endif;
	endif;
endif;
?>

<div id="contato_do_site">
	<div style="background-color:#ffffff;" class="container margin_60">   		 
		<div class="row"> 
			<div class="col-md-8 col-md-offset-2">  				
				<div id="sendnewpass" class="indent_title_in">
					<i class="fa fa-credit-card" aria-hidden="true"></i>
					<h3><strong>FORMAS DE PAGAMENTO</strong> </h3>
					<p>
						<b>Cadastre as formas de pagamento que você aceita em sua loja!</b>
					</p>
					<br />
					<?php
					$getformapagamento = filter_input_array(INPUT_POST, FILTER_DEFAULT);

					if(!empty($getformapagamento)):
						$getformapagamento = array_map('strip_tags', $getformapagamento);
						$getformapagamento = array_map('trim', $getformapagamento);

						if(in_array('', $getformapagamento)):
							echo "<script>
							x0p('Opss...', 
							'Preencha o campo com a forma de pagamento!',
							'error', false);
							</script>";
						else:

							$addbanco->ExeCreate("ws_formas_pagamento", $getformapagamento);
							if(!$addbanco->getResult()):
								echo "<script>
								x0p('Opss...', 
								'Ocorreu um Erro!',
								'error', false);
								</script>";
							else:
								header("Location: {$site}{$Url[0]}/cadastrar-formas-pagamento");
							endif;

						endif;

					endif;
					?>
					<form method="post">
						<div class="form-group">							
							<label for="f_pagamento">Forma de Pagameneto</label>						
							<input type="text" id="f_pagamento" name="f_pagamento" class="form-control" placeholder="Dinheiro, Crédito Visa, etc...">
						</div>
						<input type="hidden" name="user_id" value="<?=$userlogin['user_id'];?>">
						<div class="form-group">							
							<button type="submit" class="btn btn-success">Cadastrar</button>
						</div>
					</form>
					<br />				
					<br />
					<div class="form-group">        
						
						<?php
						$lerbanco->ExeRead("ws_formas_pagamento", "WHERE user_id = :userid ORDER BY id_f_pagamento ASC", "userid={$userlogin['user_id']}");
						if($lerbanco->getResult()):
							foreach($lerbanco->getResult() as $tt):
								extract($tt);                                    
								?>     

								<a title="Deletar" href="<?=$site.$Url[0].'/cadastrar-formas-pagamento&delete='.$id_f_pagamento;?>">
									<button style="margin-top: 3px;" type="button" class="btn btn-danger">
										<strong><?=$f_pagamento;?> = </strong> <span class="glyphicon glyphicon-trash"></span>
									</button>
								</a>
								<br />

								<?php
							endforeach;
						endif;
						?>
						
					</div>
					<br />

				</div>
			</div><!-- End col  -->
		</div><!-- End row  -->
	</div>

</div><!-- End container  -->