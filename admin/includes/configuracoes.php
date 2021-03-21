	<?php
	$lerbanco->ExeRead("configuracoes_site");
	if($lerbanco->getResult()):
		$getEmpresa = $lerbanco->getResult();
	endif;
	?>
	<div class="row">
		<div class="col-md-12">
			<div class="panel">
				<div class="panel-heading">CONFIGURAÇÕES</div>

				<?php
				$formupdateempresa = filter_input_array(INPUT_POST, FILTER_DEFAULT);
				if(!empty($formupdateempresa)):

					$formupdateempresa = array_map('strip_tags', $formupdateempresa);
					$formupdateempresa = array_map('trim', $formupdateempresa);

					if(in_array('', $formupdateempresa) || in_array('null', $formupdateempresa)):
						echo "<br /><div class=\"alert alert-info alert-dismissable\">
					<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
					Preencha todos os campos!
					</div>";
				elseif(strlen(preg_replace("/[^0-9]/", "", $formupdateempresa['tel_adm'])) < 11):
					echo "<br /><div class=\"alert alert-info alert-dismissable\">
					<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
					O telefone de administração esta em formato inválido!
					</div>";
				elseif(strlen(preg_replace("/[^0-9]/", "", $formupdateempresa['tel_financeiro'])) < 11):
					echo "<br /><div class=\"alert alert-info alert-dismissable\">
					<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
					O telefone do financeiro esta em formato inválido!
					</div>";
				elseif(!Check::Email($formupdateempresa['email_suporte'])):
					echo "<br /><div class=\"alert alert-info alert-dismissable\">
					<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
					O email informado e inválido!
					</div>";
				else:

					$formupdateempresa['tel_adm'] = preg_replace("/[^0-9]/", "", $formupdateempresa['tel_adm']);
					$formupdateempresa['tel_financeiro'] = preg_replace("/[^0-9]/", "", $formupdateempresa['tel_financeiro']);

					$updatebanco->ExeUpdate("configuracoes_site", $formupdateempresa, "WHERE id_config = :up", "up=1");
					if ($updatebanco->getResult()):
						header("Location: {$site}admin/painel.php?exe=configuracoes");
					else:
						echo "<br /><div class=\"alert alert-danger alert-dismissable\">
						<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">x</button>
						<b class=\"alert-link\">OCORREU UM ERRO!</b> Tente novamente.
						</div>";
					endif;

				endif;
			endif;
			?>
			<div style="width: 95%;margin: 0 auto;padding-bottom: 100px;">

				<form method="post" autocomplete="off">

					<div class="form-group">
						<label for="nome_site">Nome do site</label>
						<input type="text" name="nome_site" id="nome_site" value="<?=(!empty($getEmpresa[0]['nome_site']) ? $getEmpresa[0]['nome_site'] : "")?>" class="form-control" placeholder="">
					</div>
					<div class="form-group">
						<label for="titulo_site">Titulo do site</label>
						<input type="text" name="titulo_site" value="<?=(!empty($getEmpresa[0]['titulo_site']) ? $getEmpresa[0]['titulo_site'] : "")?>" id="titulo_site" class="form-control" placeholder="">
					</div>
					<div class="form-group">
						<label for="descricao_site">Descrição do site</label>
						<input type="text" name="descricao_site" value="<?=(!empty($getEmpresa[0]['descricao_site']) ? $getEmpresa[0]['descricao_site'] : "")?>" id="descricao_site" class="form-control" placeholder="">
					</div>
					<div class="form-group">
						<label for="palavas_chaves">Palavas chaves </label><span style="color: red;">*separado por vírgula</span>
						<input type="text" name="palavas_chaves" value="<?=(!empty($getEmpresa[0]['palavas_chaves']) ? $getEmpresa[0]['palavas_chaves'] : "")?>" id="palavas_chaves" class="form-control" placeholder="">
					</div>

					<br />
					<hr />
					<br />

					<div class="form-group">
						<label for="tel_adm">Telefone administração</label> <span style="color: red;">Whatsapp</span>
						<input type="tel" name="tel_adm" value="<?=(!empty($getEmpresa[0]['tel_adm']) ? $getEmpresa[0]['tel_adm'] : "")?>" id="descricao_site" class="form-control telefone" placeholder="">
					</div>
					<div class="form-group">
						<label for="tel_financeiro">Telefone financeiro</label> <span style="color: red;">Whatsapp</span>
						<input type="tel" name="tel_financeiro" value="<?=(!empty($getEmpresa[0]['tel_financeiro']) ? $getEmpresa[0]['tel_financeiro'] : "")?>" id="tel_financeiro" class="form-control telefone" placeholder="">
					</div>
					<div class="form-group">
						<label for="email_suporte">E-mail de suporte</label> 
						<input type="tel" name="email_suporte" value="<?=(!empty($getEmpresa[0]['email_suporte']) ? $getEmpresa[0]['email_suporte'] : "")?>" id="email_suporte" class="form-control" placeholder="">
					</div>
					<div class="form-group">
						<label for="h_suporte">Informe no site o horario de suporte</label>
						<input type="text" name="h_suporte" value="<?=(!empty($getEmpresa[0]['h_suporte']) ? $getEmpresa[0]['h_suporte'] : "")?>" id="h_suporte" class="form-control" placeholder="09:00hs ás 18:00hs">
					</div>
					<div class="form-group">
						<label for="btn_link_youtube">Link do video no youtube para o botão da pagina de vendas</label>
						<input type="text" value="<?=(!empty($getEmpresa[0]['btn_link_youtube']) ? $getEmpresa[0]['btn_link_youtube'] : "")?>" name="btn_link_youtube" id="btn_link_youtube" class="form-control" placeholder="">
					</div>
					<br />
					<hr />
					<br />
					<div class="form-group">
						<label for="link_do_face">Rede social facebook</label>
						<input type="text" name="link_do_face" value="<?=(!empty($getEmpresa[0]['link_do_face']) ? $getEmpresa[0]['link_do_face'] : "")?>" id="link_do_face" class="form-control" placeholder="">
					</div>
					<div class="form-group">
						<label for="link_do_insta">Rede social Instagram</label>
						<input type="text" name="link_do_insta" value="<?=(!empty($getEmpresa[0]['link_do_insta']) ? $getEmpresa[0]['link_do_insta'] : "")?>" id="link_do_insta" class="form-control" placeholder="">
					</div>
					<div class="form-group">
						<label for="link_do_youtube">Rede social Youtube</label>
						<input type="text" name="link_do_youtube" value="<?=(!empty($getEmpresa[0]['link_do_youtube']) ? $getEmpresa[0]['link_do_youtube'] : "")?>" id="link_do_youtube" class="form-control" placeholder="">
					</div>
					<br />
					<hr />
					<br />
					<h2>PLANOS DE ASSINATURA</h2>
					<div class="form-group">
						<label>PRIMEIRO PLANO</label>
						<input type="text" name="nome_plano_um" id="nome_plano_um" value="<?=(!empty($getEmpresa[0]['nome_plano_um']) ? $getEmpresa[0]['nome_plano_um'] : "")?>" class="form-control" placeholder="NOME PRIMEIRO PLANO">
						<label style="color: red;"> *valor inteiro</label>
						<input type="text" name="v_plano_um" value="<?=(!empty($getEmpresa[0]['v_plano_um']) ? $getEmpresa[0]['v_plano_um'] : "")?>" id="v_plano_um" class="form-control numero" placeholder="VALOR DO PRIMEIRO PLANO">
						<input type="text" name="dias_plano_um" value="<?=(!empty($getEmpresa[0]['dias_plano_um']) ? $getEmpresa[0]['dias_plano_um'] : "")?>" id="dias_plano_um" class="form-control" placeholder="DIAS DO PRIMEIRO PLANO">
					</div>

					<div class="form-group">
						<label>SEGUNDO PLANO</label>
						<input type="text" name="nome_plano_dois" id="nome_plano_dois" value="<?=(!empty($getEmpresa[0]['nome_plano_dois']) ? $getEmpresa[0]['nome_plano_dois'] : "")?>" class="form-control" placeholder="NOME SEGUNDO PLANO">
						<label style="color: red;"> *valor inteiro</label>
						<input type="text" name="v_plano_dois" id="v_plano_dois" value="<?=(!empty($getEmpresa[0]['v_plano_dois']) ? $getEmpresa[0]['v_plano_dois'] : "")?>" class="form-control numero" placeholder="VALOR DO SEGUNDO PLANO">

						<input type="text" name="dias_plano_dois" value="<?=(!empty($getEmpresa[0]['dias_plano_dois']) ? $getEmpresa[0]['dias_plano_dois'] : "")?>" id="dias_plano_dois" class="form-control" placeholder="DIAS DO SEGUNDO PLANO">
					</div>

					<div class="form-group">
						<label>TERCEIRO PLANO</label>
						<input type="text" name="nome_plano_tres" id="nome_plano_tres" value="<?=(!empty($getEmpresa[0]['nome_plano_tres']) ? $getEmpresa[0]['nome_plano_tres'] : "")?>"  class="form-control" placeholder="NOME TERCEIRO PLANO">
						<label style="color: red;"> *valor inteiro</label>
						<input type="text" name="v_plano_tres" id="v_plano_tres" value="<?=(!empty($getEmpresa[0]['v_plano_tres']) ? $getEmpresa[0]['v_plano_tres'] : "")?>" class="form-control numero" placeholder="VALOR DO TERCEIRO PLANO">
						<input type="text" name="dias_plano_tres" value="<?=(!empty($getEmpresa[0]['dias_plano_tres']) ? $getEmpresa[0]['dias_plano_tres'] : "")?>" id="dias_plano_tres" class="form-control" placeholder="DIAS DO TERCEIRO PLANO">
					</div>

					<div class="form-group">
						<label for="dias_testes">DIAS PARA O CLIENTE TESTAR</label> <span style="color: red;">Valor mínimo 1</span>
						<input type="text" name="dias_testes" value="<?=(!empty($getEmpresa[0]['dias_testes']) ? $getEmpresa[0]['dias_testes'] : "")?>" id="dias_testes" class="form-control numero" placeholder="">
					</div>

					<br />
					<hr />
					<br />
					<h2>DADOS DE PAGAMENTO</h2>
					<div class="form-group">
						<label>*****************************************************************<br />
							DEPOIS DE CRIAR SUA CONTA NO MERCADO PAGO VOCÊ DEVE <br />
							TERMINAR DE PREENCHER ALGUNS DADOS E PEGAR ESSAS 2 INFORMAÇÕES NO LINK E SUBISTITUIR ABAIXO:<br />
							https://www.mercadopago.com.br/developers/panel/credentials<br />
							Entre em " credenciais de produção ":<br />
						******************************************************************</label>
						<br />
						<br />
						<label>Public Key:
						</label>
						<input type="text" name="public_key_mp" value="<?=(!empty($getEmpresa[0]['public_key_mp']) ? $getEmpresa[0]['public_key_mp'] : "")?>" id="public_key_mp" class="form-control" placeholder="">
					</div>

					<label>Access Token:
					</label>
					<input type="text" name="access_token_mp" value="<?=(!empty($getEmpresa[0]['access_token_mp']) ? $getEmpresa[0]['access_token_mp'] : "")?>" id="access_token_mp" class="form-control" placeholder="">
					<br />
					<br />
					<button class="btn btn-success" type="submit">Alterar dados</button>
				</div>


			</form>

		</div>
	</div>
</div>
</div>
