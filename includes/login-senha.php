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

$updatebanco = new Update();

?>

<div id="contato_do_site">
	<div style="background-color:#ffffff;" class="container margin_60">	 		
		<div class="row">	
			<div class="col-md-8 col-md-offset-2">	

				<div id="sendnewpass" class="indent_title_in">
					<i class="icon_shield"></i>
					<h3>Configurações de conta</h3>
					<p>
						ALTERAR SENHA:
					</p>
				</div>
				<?php
				$lerbanco->ExeRead("ws_users", "WHERE user_id = :a", "a={$userlogin['user_id']}");
				if ($lerbanco->getResult()):
					foreach ($lerbanco->getResult() as $d):
						extract($d);
					endforeach;
				endif;


				$inputnewsenha = filter_input_array(INPUT_POST, FILTER_DEFAULT);

				if($inputnewsenha && !empty($inputnewsenha['sendnewpass'])):
					unset($inputnewsenha['sendnewpass']);
						// LIMPA OS CAMPOS RETIRANDO TAGS E ESPAÇOS DESNECESSÁRIOS
					$inputnewsenha = array_map('strip_tags', $inputnewsenha);
					$inputnewsenha = array_map('trim', $inputnewsenha);

					if(in_array('', $inputnewsenha) || in_array('null', $inputnewsenha)):
						echo "<div class=\"alert alert-info alert-dismissable\">
					<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
					Preencha todos os campos!
					</div>";
				elseif (!Check::Email($inputnewsenha['user_email'])):
					echo "<div class=\"alert alert-info alert-dismissable\">
					<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
					O e-mail informado e inválido!
					</div>";
				elseif ($inputnewsenha['user_password'] != $inputnewsenha['confirmpass']):
					echo "<div class=\"alert alert-info alert-dismissable\">
					<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
					Senhas não coincidem!
					</div>";
				elseif(md5($inputnewsenha['passatual']) != $userlogin['user_password']):
					echo "<div class=\"alert alert-info alert-dismissable\">
					<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
					A senha atual informada esta errada!
					</div>";
				elseif(strlen($inputnewsenha['user_password']) <= 7):
					echo "<div class=\"alert alert-info alert-dismissable\">
					<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
					A senha informada deve ter no mínimo 8 caracteres!
					</div>";
				else:

					unset($inputnewsenha['passatual']);
					unset($inputnewsenha['confirmpass']);

					$inputnewsenha['user_password'] = md5($inputnewsenha['user_password']);
					$updatebanco->ExeUpdate("ws_users", $inputnewsenha, "WHERE user_id = :newuserpass", "newuserpass={$userlogin['user_id']}");
					if ($updatebanco->getResult()):
						echo "<div class=\"alert alert-success alert-dismissable\">
						<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">x</button>
						<b class=\"alert-link\">SUCESSO!</b> Seus dados foram alterados. saindo...
						</div>";
						header("Refresh: 5; url={$site}{$Url[0]}/login-senha&logoff=true");							
						else:
							echo "<div class=\"alert alert-danger alert-dismissable\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">x</button>
							<b class=\"alert-link\">OCORREU UM ERRO!</b> Tente novamente.
							</div>";
						endif;
					endif;			
				endif;

				?>

				<div class="widget">
					<div style="height: 380px" class="widget-content padding">        
						<form class="form-horizontal" role="form" method="post" action="#sendnewpass">
							<div class="form-group">
								<label class="col-sm-2 control-label">E-mail:</label>
								<div class="col-sm-10">
									<div class="input-group">
										<span class="input-group-addon"><i class="icon-key" aria-hidden="true"></i></span>
										<input type="text" name="user_email" value="<?=$user_email?>" class="form-control text-input" placeholder="e-mail">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Senha atual:</label>
								<div class="col-sm-10">
									<div class="input-group">
										<span class="input-group-addon"><i class="icon-key" aria-hidden="true"></i></span>
										<input type="password" name="passatual" class="form-control text-input" placeholder="********">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Nova senha:</label>
								<div class="col-sm-10">
									<div class="input-group">
										<span class="input-group-addon"><i class="icon-key" aria-hidden="true"></i></span>
										<input type="password" name="user_password" class="form-control text-input" placeholder="********">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Confirme a senha:</label>
								<div class="col-sm-10">
									<div class="input-group">
										<span class="input-group-addon"><i class="icon-key" aria-hidden="true"></i></span>
										<input type="password" name="confirmpass" class="form-control text-input" placeholder="********">
									</div>
								</div>
							</div>
							<br />						
							<input class='btn btn-success' name="sendnewpass" type='submit' value='Salvar'/> 							
						</form>       
					</div>
				</div>
			</div><!-- End col  -->			
		</div><!-- End row  -->
	</div>
</div><!-- End container  -->