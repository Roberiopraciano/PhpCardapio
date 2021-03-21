	<div class="row">
		<div class="col-md-12">
			<div class="panel">
				<div class="panel-heading">ALTERAR DADOS DE LOGIN</div>
				<div style="width: 95%;margin: 0 auto;padding-bottom: 100px;">

					<form method="post" autocomplete="off">
						<div class="form-group">
							<label for="admin_email">Novo E-mail</label>
							<input type="text" name="admin_email" id="admin_email" class="form-control" placeholder="Seu e-mail">
						</div>

						<div class="form-group">
							<label for="admin_senha">Nova Senha</label>
							<input type="password" name="admin_senha" id="admin_senha" class="form-control" required placeholder="">
						</div>

						<div class="form-group">
							<label for="r_admin_senha">Repita a Nova Senha</label>
							<input type="password" name="r_admin_senha" id="r_admin_senha" class="form-control" required placeholder="">
						</div>
						<button class="btn btn-success" type="submit">Alterar dados</button>
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
					elseif ($inputnewsenha['admin_senha'] != $inputnewsenha['r_admin_senha']):
						echo "<br /><div class=\"alert alert-info alert-dismissable\">
						<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
						Senhas não coincidem!
						</div>";
					elseif(strlen($inputnewsenha['admin_senha']) <= 7):
						echo "<br /><div class=\"alert alert-info alert-dismissable\">
						<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
						A senha informada deve ter no mínimo 8 caracteres!
						</div>";
					else:

						unset($inputnewsenha['r_admin_senha']);


						$inputnewsenha['admin_senha'] = md5($inputnewsenha['admin_senha']);
						$updatebanco->ExeUpdate("ws_admin", $inputnewsenha, "WHERE admin_email = :admail", "admail={$_SESSION['administrador']['admin_email']}");
						if ($updatebanco->getResult()):
							echo "<br /><div class=\"alert alert-success alert-dismissable\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">x</button>
							<b class=\"alert-link\">SUCESSO!</b> Seus dados foram alterados. saindo...
							</div>";
							header("Refresh: 5; url={$site}admin/painel.php?logoff=true");							
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
