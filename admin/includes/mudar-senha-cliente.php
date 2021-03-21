	<?php
	$getIdIuser = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

	if(!isset($getIdIuser)):
		header("Location: {$site}admin");
	else:
		$lerbanco->ExeRead("ws_empresa", "WHERE user_id = :userid", "userid={$getIdIuser}");
		if ($lerbanco->getResult()):
			foreach ($lerbanco->getResult() as $dd):
				extract($dd);
			endforeach;
		else:
			header("Location: {$site}admin"); 
		endif;
	endif;
	?>
	<div class="row">
		<div class="col-md-12">
			<div class="panel">
				<div class="panel-heading">
					ALTERAR SENHA DA LOJA: <b style="color: blue;"><?=$nome_empresa;?></b>
					<br /><small style="color: green;">Depois o cliente altera fazendo o login.</small>
				</div>
				<div style="width: 95%;margin: 0 auto;padding-bottom: 100px;">

					<form method="post" autocomplete="off">
						<div class="form-group">
							<label for="pass">Nova Senha</label>
							<input type="password" name="pass" id="pass" class="form-control" required placeholder="">
						</div>

						<div class="form-group">
							<label for="r_pass">Repita a Nova Senha</label>
							<input type="password" name="r_pass" id="r_pass" class="form-control" required placeholder="">
						</div>
						<button class="btn btn-success" type="submit">Alterar dados</button>
						<a class="btn btn-default" href="<?=$site?>admin/painel.php">
					Voltar
					</a>
					</form>
					

					<?php


					$inputnewsenha = filter_input_array(INPUT_POST, FILTER_DEFAULT);

					if(!empty($inputnewsenha)):		
						// LIMPA OS CAMPOS RETIRANDO TAGS E ESPAÇOS DESNECESSÁRIOS
						$inputnewsenha = array_map('strip_tags', $inputnewsenha);
						$inputnewsenha = array_map('trim', $inputnewsenha);

						if(in_array('', $inputnewsenha) || in_array('null', $inputnewsenha)):
							echo "<br /><div class=\"alert alert-info alert-dismissable\">
						<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
						Preencha todos os campos!
						</div>";
					elseif ($inputnewsenha['pass'] != $inputnewsenha['r_pass']):
						echo "<br /><div class=\"alert alert-info alert-dismissable\">
						<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
						Senhas não coincidem!
						</div>";
					elseif(strlen($inputnewsenha['pass']) <= 7):
						echo "<br /><div class=\"alert alert-info alert-dismissable\">
						<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
						A senha informada deve ter no mínimo 8 caracteres!
						</div>";
					else:

						$novosdados = array();
						$novosdados['user_password'] = md5($inputnewsenha['pass']);

						$updatebanco->ExeUpdate("ws_users", $novosdados, "WHERE user_id = :uid", "uid={$getIdIuser}");
						if ($updatebanco->getResult()):
							echo "<br /><div class=\"alert alert-success alert-dismissable\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">x</button>
							<b class=\"alert-link\">SUCESSO!</b> a senha foi alterada.
							</div>";
							header("Refresh: 5; url={$site}admin/painel.php?exe=mudar-senha-cliente&id={$getIdIuser}");									
						else:
							echo "<br /><div class=\"alert alert-danger alert-dismissable\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">x</button>
							<b class=\"alert-link\">OCORREU UM ERRO!</b> Tente novamente.
							</div>";
						endif;
					endif;			
				endif;

				?>

			</div>
		</div>
	</div>
</div>
