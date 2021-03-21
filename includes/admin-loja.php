<?php

$login = new Login(3);

if(!$login->CheckLogin()):
	unset($_SESSION['userlogin']);
	header("Location: {$site}");
else:
	$userlogin = $_SESSION['userlogin'];
endif;

$logoff = filter_input(INPUT_GET, 'logoff', FILTER_VALIDATE_BOOLEAN);

$dataFomatadarenovacao = explode('-', $empresa_data_renovacao);
$dataFomatadarenovacao = array_reverse($dataFomatadarenovacao);
$dataFomatadarenovacao = implode('/', $dataFomatadarenovacao);

if(!empty($_GET['statusmp'])):

	$statusMP = strip_tags(trim($_GET['statusmp']));

	if(!empty($statusMP) && $statusMP == "approved"):
		echo "<script>x0p('Sucesso!', 
		'Recebemos seu pagamento! Plano ativo até {$dataFomatadarenovacao}', 
		'ok', false);</script>";
	elseif(!empty($statusMP) && $statusMP == "rejected"):
		echo "<script>x0p('Ocorreu um Erro', 
		'Seu cartão foi recusado! Entre em contato conosco.',
		'error', false);</script>";
	endif;

endif;

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
<div style="background-color:#ffffff;" class="container margin_60">
	<div id="sendempresa"></div>


	<section id="section-1">
		<div class="indent_title_in">
			<i class="icon_house_alt"></i>
			<h3>Descrição geral do seu negócio</h3>
			<p>Insira no formulario abaixo detalhes do seu negócio e informações de contato.</p>
		</div>				

		<form method="post" action="#sendempresa" enctype="multipart/form-data">
			<div class="wrapper_indent">
				<?php

				$getdelldate = filter_input(INPUT_GET, 'dellDate', FILTER_VALIDATE_INT);

				if(!empty($getdelldate) && !isset($_POST['sendempresa'])):

					$lerbanco->ExeRead('ws_datas_close', "WHERE user_id = :userid AND id = :v", "userid={$userlogin['user_id']}&v={$getdelldate}");
				if ($lerbanco->getResult()):
					$deletbanco->ExeDelete("ws_datas_close", "WHERE user_id = :userid AND id = :k", "userid={$userlogin['user_id']}&k={$getdelldate}");
					if ($deletbanco->getResult()):
						echo "<div class=\"alert alert-success alert-dismissable\">
						<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
						<b class=\"alert-link\">SUCESSO!</b> A data de exceção foi deletada do sistema.
						</div>";
						header("Refresh: 5; url={$site}{$Url[0]}/admin-loja");
					else:
						echo "<div class=\"alert alert-danger alert-dismissable\">
						<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
						<b class=\"alert-link\">OCORREU UM ERRO DE CONEXÃO!</b> Tente novamente.
						</div>";
						header("Refresh: 5; url={$site}{$Url[0]}/admin-loja");
					endif;
				endif;
			endif;


			if(isset($_POST['sendempresa']) && $_POST['sendempresa'] == true):
				if(!empty($_POST['data_close'])):

					$dataClose1 = strip_tags(trim($_POST['data_close']));

					$data_c['data'] = $dataClose1;
					$data_c['user_id'] = $userlogin['user_id'];

					if(strlen($dataClose1) == 10):
						$lerbanco->ExeRead("ws_datas_close", "WHERE user_id = :userid AND data = :dat", "userid={$userlogin['user_id']}&dat={$dataClose1}");
						if($lerbanco->getResult()):
							//NÃO FAZ NADA
						else:
							$addbanco->ExeCreate("ws_datas_close", $data_c);
						endif;
					endif;						
				endif;
			endif;


			

			$inputdadosempresa = filter_input_array(INPUT_POST, FILTER_DEFAULT);

			if ($inputdadosempresa && !empty($inputdadosempresa['sendempresa'])):					

				unset($inputdadosempresa['sendempresa']);
				unset($inputdadosempresa['_wysihtml5_mode']);
				unset($inputdadosempresa['data_close']);
				$inputdadosempresa['end_bairro_empresa'] = tratar_nome($inputdadosempresa['end_bairro_empresa']);

				if(!empty($inputdadosempresa['minimo_delivery'])):					
					$inputdadosempresa['minimo_delivery'] = Check::Valor($inputdadosempresa['minimo_delivery']);
				else:
					$inputdadosempresa['minimo_delivery'] = '0.00';
				endif;



						// LIMPA OS CAMPOS RETIRANDO TAGS E ESPAÇOS DESNECESSÁRIOS
				$inputdadosempresa = array_map('strip_tags', $inputdadosempresa);
				$inputdadosempresa = array_map('trim', $inputdadosempresa);

				if(!empty($inputdadosempresa['confirm_delivery'])):
					$inputdadosempresa['confirm_delivery'] = "true";
				else:
					$inputdadosempresa['confirm_delivery'] = "false";
				endif;
				if(!empty($inputdadosempresa['confirm_balcao'])):
					$inputdadosempresa['confirm_balcao'] = "true";
				else:
					$inputdadosempresa['confirm_balcao'] = "false";
				endif;
				if(!empty($inputdadosempresa['confirm_mesa'])):
					$inputdadosempresa['confirm_mesa'] = "true";
				else:
					$inputdadosempresa['confirm_mesa'] = "false";
				endif;	


						// COMO NÃO EXISTE UM INPUT PARA IMAGEM TEMOS QUE FAZER VALIDAÇÃO VIA $_FILE MESMO

			// INICIO DA VALIDAÇÃO DA IMAGEM DE FUNDO
				if (isset($_FILES['img_header']['tmp_name']) && $_FILES['img_header']['tmp_name'] != ""):
					$inputdadosempresa['img_header'] = $_FILES['img_header'];
				else:
					unset($inputdadosempresa['img_header']);
				endif;


				if(!empty($inputdadosempresa['img_header'])):                        
					$upload = new Upload("uploads/");
					$upload->Image($inputdadosempresa['img_header']);

					if(isset($upload) && $upload->getResult()):
						$inputdadosempresa['img_header'] = $upload->getResult();
					if(!empty($inputdadosempresa['img_header']) && !empty($img_logo) && file_exists("uploads/{$img_header}") && !is_dir("uploads/{$img_header}")):
						unlink("uploads/{$img_header}");
				endif;
			elseif(is_array($inputdadosempresa['img_header'])):
				unset($inputdadosempresa['img_header']);
			endif;



		endif;
			// FIM DA VALIDAÇÃO DA IMAGEM DE FUNDO


						// INICIO DA VALIDAÇÃO DA IMAGEM PERFIL
		if (isset($_FILES['img_logo']['tmp_name']) && $_FILES['img_logo']['tmp_name'] != ""):
			$inputdadosempresa['img_logo'] = $_FILES['img_logo'];
		else:
			unset($inputdadosempresa['img_logo']);
		endif;


		if(!empty($inputdadosempresa['img_logo'])):                        
			$upload = new Upload("uploads/");
			$upload->Image($inputdadosempresa['img_logo']);

			if (isset($upload) && $upload->getResult()):	

				$inputdadosempresa['img_logo'] = $upload->getResult();

		elseif(is_array($inputdadosempresa['img_logo'])):
			unset($inputdadosempresa['img_logo']);
		endif;

		if(!empty($inputdadosempresa['img_logo']) && !empty($img_logo) && file_exists("uploads/{$img_logo}") && !is_dir("uploads/{$img_logo}")):
			unlink("uploads/{$img_logo}");
	endif;						

endif;

if(empty($inputdadosempresa['facebook_empresa'])):
	unset($inputdadosempresa['facebook_empresa']);
endif;

if(empty($inputdadosempresa['instagram_empresa'])):
	unset($inputdadosempresa['instagram_empresa']);
endif;

if(empty($inputdadosempresa['twitter_empresa'])):
	unset($inputdadosempresa['twitter_empresa']);
endif;

						// FIM DA VALIDAÇÃO DA IMAGEM DE PERFIL 
						//---------------------------				

if (in_array('', $inputdadosempresa) || in_array('null', $inputdadosempresa)):
	echo "<div class=\"alert alert-info alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
Preencha todos os campos!
</div>";
header("Refresh: 5; url={$site}{$Url[0]}/admin-loja");
elseif (!Check::Email($inputdadosempresa['email_empresa'])):
	echo "<div class=\"alert alert-warning alert-dismissable\">
	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
	O EMAIL informado não e valido!
	</div>";
	header("Refresh: 5; url={$site}{$Url[0]}/admin-loja");
else:						
	$inputdadosempresa['telefone_empresa'] = preg_replace("/[^0-9]/", "", $inputdadosempresa['telefone_empresa']);
	$inputdadosempresa['user_id'] = $userlogin['user_id'];	

	$inputdadosempresa['config_delivery'] = Check::Valor($inputdadosempresa['config_delivery']);

	$inputdadosempresa['config_segunda'] = (!empty($inputdadosempresa['config_segunda']) && $inputdadosempresa['config_segunda'] == "true" ? $inputdadosempresa['config_segunda'] : "false");	

	$inputdadosempresa['config_terca'] = (!empty($inputdadosempresa['config_terca']) && $inputdadosempresa['config_terca'] == "true" ? $inputdadosempresa['config_terca'] : "false");		

	$inputdadosempresa['config_quarta'] = (!empty($inputdadosempresa['config_quarta']) && $inputdadosempresa['config_quarta'] == "true" ? $inputdadosempresa['config_quarta'] : "false");

	$inputdadosempresa['config_quinta'] = (!empty($inputdadosempresa['config_quinta']) && $inputdadosempresa['config_quinta'] == "true" ? $inputdadosempresa['config_quinta'] : "false");

	$inputdadosempresa['config_sexta'] = (!empty($inputdadosempresa['config_sexta']) && $inputdadosempresa['config_sexta'] == "true" ? $inputdadosempresa['config_sexta'] : "false");

	$inputdadosempresa['config_sabado'] = (!empty($inputdadosempresa['config_sabado']) && $inputdadosempresa['config_sabado'] == "true" ? $inputdadosempresa['config_sabado'] : "false");

	$inputdadosempresa['config_domingo'] = (!empty($inputdadosempresa['config_domingo']) && $inputdadosempresa['config_domingo'] == "true" ? $inputdadosempresa['config_domingo'] : "false");


	$inputdadosempresa['config_segundaa'] = (!empty($inputdadosempresa['config_segundaa']) && $inputdadosempresa['config_segundaa'] == "true" ? $inputdadosempresa['config_segundaa'] : "false");	

	$inputdadosempresa['config_tercaa'] = (!empty($inputdadosempresa['config_tercaa']) && $inputdadosempresa['config_tercaa'] == "true" ? $inputdadosempresa['config_tercaa'] : "false");		

	$inputdadosempresa['config_quartaa'] = (!empty($inputdadosempresa['config_quartaa']) && $inputdadosempresa['config_quartaa'] == "true" ? $inputdadosempresa['config_quartaa'] : "false");

	$inputdadosempresa['config_quintaa'] = (!empty($inputdadosempresa['config_quintaa']) && $inputdadosempresa['config_quintaa'] == "true" ? $inputdadosempresa['config_quintaa'] : "false");

	$inputdadosempresa['config_sextaa'] = (!empty($inputdadosempresa['config_sextaa']) && $inputdadosempresa['config_sextaa'] == "true" ? $inputdadosempresa['config_sextaa'] : "false");

	$inputdadosempresa['config_sabadoo'] = (!empty($inputdadosempresa['config_sabadoo']) && $inputdadosempresa['config_sabadoo'] == "true" ? $inputdadosempresa['config_sabadoo'] : "false");

	$inputdadosempresa['config_domingoo'] = (!empty($inputdadosempresa['config_domingoo']) && $inputdadosempresa['config_domingoo'] == "true" ? $inputdadosempresa['config_domingoo'] : "false");


							//COMEÇO A FAZER A GRAVAÇÃO DOS DADOS::::::::::::::::::::::::::::::::::::::::::::::::::
	$lerbanco->ExeRead('ws_empresa', "WHERE user_id = :v", "v={$userlogin['user_id']}");
	if (!$lerbanco->getResult()):		
		$addbanco->ExeCreate("ws_empresa", $inputdadosempresa);
		if ($addbanco->getResult()):												
			echo "<div class=\"alert alert-success alert-dismissable\">
			<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
			<b class=\"alert-link\">SUCESSO!</b> Seus dados foram Inseridos no sistema.
			</div>";
			header("Refresh: 5; url={$site}{$Url[0]}/admin-loja");
		else:
			echo "<div class=\"alert alert-danger alert-dismissable\">
			<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
			<b class=\"alert-link\">OCORREU UM ERRO!</b> Tente novamente.
			</div>";
			header("Refresh: 5; url={$site}{$Url[0]}/admin-loja");
		endif;

	else:
		$updatebanco->ExeUpdate("ws_empresa", $inputdadosempresa, "WHERE user_id = :up", "up={$userlogin['user_id']}");
		if ($updatebanco->getResult()):
			echo "<div class=\"alert alert-success alert-dismissable\">
			<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
			<b class=\"alert-link\">SUCESSO!</b> Seus dados foram Atualizados no sistema.
			</div>";
			header("Refresh: 5; url={$site}{$Url[0]}/admin-loja");
		else:
			echo "<div class=\"alert alert-danger alert-dismissable\">
			<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
			<b class=\"alert-link\">OCORREU UM ERRO!</b> Tente novamente.
			</div>";
			header("Refresh: 5; url={$site}{$Url[0]}/admin-loja");
		endif;
	endif;					

endif;
endif;
?>

<div class="form-group">
	<label for="nome_empresa">Nome do seu negócio:</label>
	<input class="form-control" required value="<?=(!empty($nome_empresa) ? $nome_empresa : '');?>" name="nome_empresa" id="nome_empresa" type="text">
</div>
<div class="form-group">
	<label for="descricao_empresa">Breve descrição do seu negócio:</label>
	<input type="text" required maxlength="297" name="descricao_empresa" class="form-control" placeholder="Digite uma descrição..." value="<?=(!empty($descricao_empresa) ? $descricao_empresa : '');?>" />
</div>
<div class="row">
	<div class="col-sm-6">
		<div class="form-group">
			<label for="telefone_empresa">Suporte WhatsApp:</label>
			<input required type="tel" placeholder="(99) 99999-9999" data-mask="(00) 00000-0000" maxlength="15" id="telefone_empresa" name="telefone_empresa" value="<?=(!empty($telefone_empresa) ? $telefone_empresa : '');?>" class="form-control">
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			<label for="email_empresa">E-mail:</label>
			<input required type="email" id="email_empresa" value="<?=(!empty($email_empresa) ? $email_empresa : '');?>" name="email_empresa" class="form-control">
		</div>
	</div>
</div>
</div><!-- End wrapper_indent -->

<hr />

<div class="indent_title_in">
	<i class="icon_pin_alt"></i>
	<h3>Endereço</h3>
	<p>
		Defina o endereço do seu negócio!
	</p>
</div>
<div class="wrapper_indent">
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
				<label for="estados">ESTADO:</label>
				<select required class="form-control" name="end_uf_empresa" id="estados">
					
				</select>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="cidade_empresa">CIDADE:</label>
				<select required class="form-control" name="cidade_empresa" id="cidades">

				</select>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
				<label required for="end_rua_n_empresa">RUA / Nº:</label>
				<input type="text" id="end_rua_n_empresa" value="<?=(!empty($end_rua_n_empresa) ? $end_rua_n_empresa : '');?>" name="end_rua_n_empresa" class="form-control">
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label for="end_bairro_empresa">BAIRRO:</label>
				<input required type="text" id="end_bairro_empresa" value="<?=(!empty($end_bairro_empresa) ? $end_bairro_empresa : '');?>" name="end_bairro_empresa" class="form-control">
			</div>
		</div>
	</div>
</div><!-- End wrapper_indent -->

<hr />

<div class="indent_title_in">
	<i class="fa fa-motorcycle" aria-hidden="true"></i>
	<h3>Opções de entrega</h3>
	<div class="form-group">	

		<div class="icheck-material-green">
			<input <?=(!empty($confirm_delivery) && $confirm_delivery == "true" ? "checked" : "");?> type="checkbox" name="confirm_delivery" value="true" id="confirm_delivery" />
			<label for="confirm_delivery"><strong>Permitir delivery</strong></label>
		</div>
		<div class="icheck-material-green">
			<input <?=(!empty($confirm_balcao) && $confirm_balcao == "true" ? "checked" : "");?> type="checkbox" name="confirm_balcao" value="true" id="confirm_balcao" />
			<label for="confirm_balcao"><strong>Permitir retirada no balcão</strong></label>
		</div>
		<div class="icheck-material-green">
			<input <?=(!empty($confirm_mesa) && $confirm_mesa == "true" ? "checked" : "");?> type="checkbox" name="confirm_mesa" value="true" id="confirm_mesa" />
			<label for="confirm_mesa"><strong>Permitir pedido na mesa</strong></label>
		</div>
	</div>

	<p>
		<span style="color: red;">O valor inserido em "Custo padrão de entrega", será universal se não for adicionando nenhum bairro com taxas diferentes.</span>
		
	</p>
</div>

<div class="wrapper_indent">
	<div class="row">
		<div class="col-md-6 col-sm-6">
			<div class="form-group">
				<label for="config_delivery">Custo padrão de entrega:</label>
				<input type="text" required maxlength="11" onkeypress="return formatar_moeda(this, '.', ',', event);" data-mask="#.##0,00" data-mask-reverse="true" class="form-control" id="config_delivery" name="config_delivery" value="<?=(!empty($config_delivery) ? Check::Real($config_delivery) : '0,00');?>" />
			</div>
		</div>

		<div class="col-md-6 col-sm-6">
			<div class="form-group">
				<label for="minimo_delivery">Valor Mínimo do Delivery: <small style="color: red;">Opcional</small></label>
				<input type="text" required maxlength="11" onkeypress="return formatar_moeda(this, '.', ',', event);" data-mask="#.##0,00" data-mask-reverse="true" class="form-control" id="minimo_delivery" name="minimo_delivery" value="<?=(!empty($minimo_delivery) ? Check::Real($minimo_delivery) : '0,00');?>" />
			</div>
		</div>
	</div>	
	<div class="row">
		<div class="col-md-6 col-sm-6">
			<div class="form-group">
				<label>Mensagem sobre tempo de Delivery:</label>
				<input type="text" required class="form-control" id="msg_tempo_delivery" name="msg_tempo_delivery" value="<?=(!empty($msg_tempo_delivery) ? $msg_tempo_delivery : "Entre 30 e 60 minutos.");?>" />
			</div>
		</div>
		<div class="col-md-6 col-sm-6">
			<div class="form-group">
				<label>Mensagem sobre retirar no local:</label>
				<input type="text" required class="form-control" id="msg_tempo_buscar" name="msg_tempo_buscar" value="<?=(!empty($msg_tempo_buscar) ? $msg_tempo_buscar : "Em 30 minutos.");?>" />
			</div>
		</div>
	</div>
</div>

<hr />

<div class="indent_title_in">
	<i class="fa fa-clock-o" aria-hidden="true"></i>
	<h3>Horários de funcionamento</h3>
	<p>
		Defina o seu horário de atendimento para que seus clientes saibam quando seus serviços estiverem disponíveis.
	</p>
</div>

<div class="panel panel-default">
	<div style="background-color: #85c99d;color: #ffffff;" class="panel-heading">
		<h4 data-toggle="collapse" data-parent="#accordion" href="#collapse1" class="panel-title expand">
			<div class="right-arrow pull-right"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></div>
			<center><a style="color: #ffffff;" href="#">Cique aqui para Configurar Horários.</a></center>
		</h4>
	</div>
	<div id="collapse1" class="panel-collapse collapse">
		<div class="panel-body">
			
			<div class="wrapper_indent">
				 <label>SEGUNDA FEIRA</label>
				<br />
				<input id="config_segunda" name="config_segunda" type="checkbox" <?=(!empty($config_segunda) && $config_segunda == 'true' ? 'checked' : '');?> value="true" /> <label for="config_segunda"><strong style="color:#85c99d;"> PERIODO DA MANHÃ </strong></label>
				<div class="row">						
					<div class="col-sm-6">
						<div class="form-group">
							<label for="segunda_manha_de">de:</label>									
							<input required type="time" name="segunda_manha_de" id="segunda_manha_de" data-mask="00:00" value="<?=(!empty($segunda_manha_de) && $segunda_manha_de != "00:00" ? $segunda_manha_de : "00:00");?>" class="form-control"/>									
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="segunda_manha_ate">até:</label>
							<input required type="time" name="segunda_manha_ate" id="segunda_manha_ate" data-mask="00:00" value="<?=(!empty($segunda_manha_ate) && $segunda_manha_ate != "00:00" ? $segunda_manha_ate : "00:00");?>" class="form-control"/> 
						</div>
					</div>
				</div>
				<input id="config_segundaa" name="config_segundaa" type="checkbox" <?=(!empty($config_segundaa) && $config_segundaa == 'true' ? 'checked' : '');?> value="true" /> <label for="config_segundaa"><strong style="color:#85c99d;"> PERIODO DA TARDE</strong></label>
				<div class="row">						
					<div class="col-sm-6">
						<div class="form-group">
							<label for="segunda_tarde_de">de:</label>									
							<input required type="time" name="segunda_tarde_de" id="segunda_tarde_de" data-mask="00:00" value="<?=(!empty($segunda_tarde_de) && $segunda_tarde_de != "00:00" ? $segunda_tarde_de : '00:00');?>" class="form-control"/>									
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="segunda_tarde_ate">até:</label>
							<input required type="time" name="segunda_tarde_ate" id="segunda_tarde_ate" data-mask="00:00" value="<?=(!empty($segunda_tarde_ate) && $segunda_tarde_ate != "00:00" ? $segunda_tarde_ate : '00:00');?>" class="form-control"/> 
						</div>
					</div>
				</div>
			</div><!-- End wrapper_indent -->	
			<hr />
			
			<div class="wrapper_indent">
				<label>TERÇA FEIRA</label>
				<br />
				<input <?=(!empty($config_terca) && $config_terca == 'true' ? 'checked' : '');?> id="config_terca" name="config_terca" value="true" type="checkbox"> <label for="config_terca"><strong style="color:#85c99d;"> PERIODO DA MANHÃ</strong></label>
				<div class="row">						
					<div class="col-sm-6">
						<div class="form-group">
							<label for="terca_manha_de">de:</label>									
							<input required type="time" name="terca_manha_de" id="segunda_manha_de" data-mask="00:00" value="<?=(!empty($terca_manha_de) && $terca_manha_de != "00:00" ? $terca_manha_de : "00:00");?>" class="form-control"/>									
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="terca_manha_ate">até:</label>
							<input required type="time" name="terca_manha_ate" id="terca_manha_ate" data-mask="00:00" value="<?=(!empty($terca_manha_ate) && $terca_manha_ate != "00:00" ? $terca_manha_ate : "00:00");?>" class="form-control"/> 
						</div>
					</div>
				</div>
				<input <?=(!empty($config_tercaa) && $config_tercaa == 'true' ? 'checked' : '');?> id="config_tercaa" name="config_tercaa" value="true" type="checkbox"><label for="config_tercaa"><strong style="color:#85c99d;"> PERIODO DA TARDE</strong></label>
				<div class="row">						
					<div class="col-sm-6">
						<div class="form-group">
							<label for="terca_tarde_de">de:</label>									
							<input required type="time" name="terca_tarde_de" id="terca_tarde_de" data-mask="00:00" value="<?=(!empty($terca_tarde_de) && $terca_tarde_de != "00:00" ? $terca_tarde_de : '00:00');?>" class="form-control"/>									
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="terca_tarde_ate">até:</label>
							<input required type="time" name="terca_tarde_ate" id="terca_tarde_ate" data-mask="00:00" value="<?=(!empty($terca_tarde_ate) && $terca_tarde_ate != "00:00" ? $terca_tarde_ate : '00:00');?>" class="form-control"/> 
						</div>
					</div>
				</div>
			</div><!-- End wrapper_indent -->
			<hr />
			
			<div class="wrapper_indent">
				<label>QUARTA FEIRA</label>
				<br />
				<input <?=(!empty($config_quarta) && $config_quarta == 'true' ? 'checked' : '');?> id="config_quarta" name="config_quarta" value="true" type="checkbox"> <label for="config_quarta"><strong style="color:#85c99d;"> PERIODO DA MANHÃ</strong></label>
				<div class="row">						
					<div class="col-sm-6">
						<div class="form-group">
							<label for="quarta_manha_de">de:</label>									
							<input required type="time" name="quarta_manha_de" id="quarta_manha_de" data-mask="00:00" value="<?=(!empty($quarta_manha_de) && $quarta_manha_de != "00:00" ? $quarta_manha_de : "00:00");?>" class="form-control"/>									
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="quarta_manha_ate">até:</label>
							<input required type="time" name="quarta_manha_ate" id="quarta_manha_ate" data-mask="00:00" value="<?=(!empty($quarta_manha_ate) && $quarta_manha_ate != "00:00" ? $quarta_manha_ate : "00:00");?>" class="form-control"/> 
						</div>
					</div>
				</div>
				<input <?=(!empty($config_quartaa) && $config_quartaa == 'true' ? 'checked' : '');?> id="config_quartaa" name="config_quartaa" value="true" type="checkbox"><label for="config_quartaa"><strong style="color:#85c99d;"> PERIODO DA TARDE</strong></label>
				<div class="row">						
					<div class="col-sm-6">
						<div class="form-group">
							<label for="quarta_tarde_de">de:</label>									
							<input required type="time" name="quarta_tarde_de" id="quarta_tarde_de" data-mask="00:00" value="<?=(!empty($quarta_tarde_de) && $quarta_tarde_de != "00:00" ? $quarta_tarde_de : '00:00');?>" class="form-control"/>									
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="quarta_tarde_ate">até:</label>
							<input required type="time" name="quarta_tarde_ate" id="quarta_tarde_ate" data-mask="00:00" value="<?=(!empty($quarta_tarde_ate) && $quarta_tarde_ate != "00:00" ? $quarta_tarde_ate : '00:00');?>" class="form-control"/> 
						</div>
					</div>
				</div>
			</div><!-- End wrapper_indent -->
			<hr />
			<div class="wrapper_indent">
				<label>QUINTA FEIRA</label>
				<br />
				<input <?=(!empty($config_quinta) && $config_quinta == 'true' ? 'checked' : '');?> id="config_quinta" name="config_quinta" value="true" type="checkbox"> <label for="config_quinta"><strong style="color:#85c99d;"> PERIODO DA MANHÃ</strong></label>
				<div class="row">						
					<div class="col-sm-6">
						<div class="form-group">
							<label for="quinta_manha_de">de:</label>									
							<input required type="time" name="quinta_manha_de" id="quinta_manha_de" data-mask="00:00" value="<?=(!empty($quinta_manha_de) && $quinta_manha_de != "00:00" ? $quinta_manha_de : "00:00");?>" class="form-control"/>									
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="quinta_manha_ate">até:</label>
							<input required type="time" name="quinta_manha_ate" id="quinta_manha_ate" data-mask="00:00" value="<?=(!empty($quinta_manha_ate) && $quinta_manha_ate != "00:00" ? $quinta_manha_ate : "00:00");?>" class="form-control"/> 
						</div>
					</div>
				</div>
				<input <?=(!empty($config_quintaa) && $config_quintaa == 'true' ? 'checked' : '');?> id="config_quintaa" name="config_quintaa" value="true" type="checkbox"><label for="config_quintaa"><strong style="color:#85c99d;"> PERIODO DA TARDE</strong></label>
				<div class="row">						
					<div class="col-sm-6">
						<div class="form-group">
							<label for="quinta_tarde_de">de:</label>									
							<input required type="time" name="quinta_tarde_de" id="quinta_tarde_de" data-mask="00:00" value="<?=(!empty($quinta_tarde_de) && $quinta_tarde_de != "00:00" ? $quinta_tarde_de : '00:00');?>" class="form-control"/>									
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="quinta_tarde_ate">até:</label>
							<input required type="time" name="quinta_tarde_ate" id="quinta_tarde_ate" data-mask="00:00" value="<?=(!empty($quinta_tarde_ate) && $quinta_tarde_ate != "00:00" ? $quinta_tarde_ate : '00:00');?>" class="form-control"/> 
						</div>
					</div>
				</div>
			</div><!-- End wrapper_indent -->
			<hr />

			<div class="wrapper_indent">
				<label>SEXTA FEIRA</label>
				<br />
				<input <?=(!empty($config_sexta) && $config_sexta == 'true' ? 'checked' : '');?> id="config_sexta" name="config_sexta" value="true" type="checkbox"> <label for="config_sexta"><strong style="color:#85c99d;"> PERIODO DA MANHÃ</strong></label>
				<div class="row">						
					<div class="col-sm-6">
						<div class="form-group">
							<label for="sexta_manha_de">de:</label>									
							<input required type="time" name="sexta_manha_de" id="sexta_manha_de" data-mask="00:00" value="<?=(!empty($sexta_manha_de) && $sexta_manha_de != "00:00" ? $sexta_manha_de : "00:00");?>" class="form-control"/>									
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="sexta_manha_ate">até:</label>
							<input required type="time" name="sexta_manha_ate" id="sexta_manha_ate" data-mask="00:00" value="<?=(!empty($sexta_manha_ate) && $sexta_manha_ate != "00:00" ? $sexta_manha_ate : "00:00");?>" class="form-control"/> 
						</div>
					</div>
				</div>
				<input <?=(!empty($config_sextaa) && $config_sextaa == 'true' ? 'checked' : '');?> id="config_sextaa" name="config_sextaa" value="true" type="checkbox"> <label for="config_sextaa"><strong style="color:#85c99d;"> PERIODO DA TARDE</strong></label>
				<div class="row">						
					<div class="col-sm-6">
						<div class="form-group">
							<label for="sexta_tarde_de">de:</label>									
							<input required type="time" name="sexta_tarde_de" id="sexta_tarde_de" data-mask="00:00" value="<?=(!empty($sexta_tarde_de) && $sexta_tarde_de != "00:00" ? $sexta_tarde_de : '00:00');?>" class="form-control"/>									
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="sexta_tarde_ate">até:</label>
							<input required type="time" name="sexta_tarde_ate" id="sexta_tarde_ate" data-mask="00:00" value="<?=(!empty($sexta_tarde_ate) && $sexta_tarde_ate != "00:00" ? $sexta_tarde_ate : '00:00');?>" class="form-control"/> 
						</div>
					</div>
				</div>
			</div><!-- End wrapper_indent -->
			<hr />
			
			<div class="wrapper_indent">
				<label>SABADO</label>
				<br />
				<input <?=(!empty($config_sabado) && $config_sabado == 'true' ? 'checked' : '');?> id="config_sabado" name="config_sabado" value="true" type="checkbox"> <label for="config_sabado"><strong style="color:#85c99d;"> PERIODO DA MANHÃ</strong></label>
				<div class="row">						
					<div class="col-sm-6">
						<div class="form-group">
							<label for="sabado_manha_de">de:</label>									
							<input required type="time" name="sabado_manha_de" id="sabado_manha_de" data-mask="00:00" value="<?=(!empty($sabado_manha_de) && $sabado_manha_de != "00:00" ? $sabado_manha_de : "00:00");?>" class="form-control"/>									
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="sabado_manha_ate">até:</label>
							<input required type="time" name="sabado_manha_ate" id="sabado_manha_ate" data-mask="00:00" value="<?=(!empty($sabado_manha_ate) && $sabado_manha_ate != "00:00" ? $sabado_manha_ate : "00:00");?>" class="form-control"/> 
						</div>
					</div>
				</div>
				<input <?=(!empty($config_sabadoo) && $config_sabadoo == 'true' ? 'checked' : '');?> id="config_sabadoo" name="config_sabadoo" value="true" type="checkbox"> <label for="config_sabadoo"><strong style="color:#85c99d;"> PERIODO DA TARDE</strong></label>
				<div class="row">						
					<div class="col-sm-6">
						<div class="form-group">
							<label for="sabado_tarde_de">de:</label>									
							<input required type="time" name="sabado_tarde_de" id="sabado_tarde_de" data-mask="00:00" value="<?=(!empty($sabado_tarde_de) && $sabado_tarde_de != "00:00" ? $sabado_tarde_de : '00:00');?>" class="form-control"/>									
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="sabado_tarde_ate">até:</label>
							<input required type="time" name="sabado_tarde_ate" id="sabado_tarde_ate" data-mask="00:00" value="<?=(!empty($sabado_tarde_ate) && $sabado_tarde_ate != "00:00" ? $sabado_tarde_ate : '00:00');?>" class="form-control"/> 
						</div>
					</div>
				</div>
			</div><!-- End wrapper_indent -->
			<hr />
			
			<div class="wrapper_indent">
				<label>DOMINGO</label>
				<br />
				<input <?=(!empty($config_domingo) && $config_domingo == 'true' ? 'checked' : '');?> id="config_domingo" name="config_domingo" value="true" type="checkbox"> <label for="config_domingo"><strong style="color:#85c99d;"> PERIODO DA MANHÃ</strong></label>
				<div class="row">						
					<div class="col-sm-6">
						<div class="form-group">
							<label for="domingo_manha_de">de:</label>									
							<input required type="time" name="domingo_manha_de" id="domingo_manha_de" data-mask="00:00" value="<?=(!empty($domingo_manha_de) && $domingo_manha_de != "00:00" ? $domingo_manha_de : "00:00");?>" class="form-control"/>									
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="domingo_manha_ate">até:</label>
							<input required type="time" name="domingo_manha_ate" id="domingo_manha_ate" data-mask="00:00" value="<?=(!empty($domingo_manha_ate) && $domingo_manha_ate != "00:00" ? $domingo_manha_ate : "00:00");?>" class="form-control"/> 
						</div>
					</div>
				</div>
				<input <?=(!empty($config_domingoo) && $config_domingoo == 'true' ? 'checked' : '');?> id="config_domingoo" name="config_domingoo" value="true" type="checkbox"><label for="config_domingoo"><strong style="color:#85c99d;"> PERIODO DA TARDE</strong></label>
				<div class="row">						
					<div class="col-sm-6">
						<div class="form-group">
							<label for="domingo_tarde_de">de:</label>									
							<input required type="time" name="domingo_tarde_de" id="domingo_tarde_de" data-mask="00:00" value="<?=(!empty($domingo_tarde_de) && $domingo_tarde_de != "00:00" ? $domingo_tarde_de : '00:00');?>" class="form-control"/>									
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="domingo_tarde_ate">até:</label>
							<input required type="time" name="domingo_tarde_ate" id="domingo_tarde_ate" data-mask="00:00" value="<?=(!empty($domingo_tarde_ate) && $domingo_tarde_ate != "00:00" ? $domingo_tarde_ate : '00:00');?>" class="form-control"/> 
						</div>
					</div>
				</div>
			</div><!-- End wrapper_indent -->
		</div>
	</div>
</div>

<hr />

<div class="indent_title_in">
	<i class="fa fa-calendar" aria-hidden="true"></i>
	<h3>Fechado na Data</h3>
	<p>
		Adicione exceções (ótimo para feriados etc.)
	</p>
</div>

<div class="panel-group" id="accordion">
	<div class="panel panel-default">
		<div style="background-color: #85c99d;color: #ffffff;" class="panel-heading">
			<h4 data-toggle="collapse" data-parent="#accordion" href="#collapse2" class="panel-title expand">
				<div class="right-arrow pull-right"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></div>
				<center><a style="color: #ffffff;" href="#">Clique aqui para adicionar uma data</a></center>
			</h4>
		</div>

		<div id="collapse2" class="panel-collapse collapse">
			<div class="panel-body">
				<div class="col-md-12 col-sm-12">
					<div class="form-group">
						<label for="datepicker">Inserir Data:</label>
						<input type="text" class="form-control" name='data_close' id="datepicker" data-mask="00/00/0000" placeholder="00/00/0000" />
					</div>					
					<label for="datepicker">Fechado nas Datas:</label><br />
					<?php
					$lerbanco->ExeRead("ws_datas_close", "WHERE user_id = :userid ORDER BY id ASC", "userid={$userlogin['user_id']}");
					if($lerbanco->getResult()):						
						foreach ($lerbanco->getResult() as $dadosC):
							extract($dadosC);		

							$i = explode('/', $data);
							$i = array_reverse($i);
							$i = implode("-", $i);							

							if(isDateExpired($i, 1)):
								?>

								<a title="Deletar" href="<?=$site.$Url[0].'/admin-loja&dellDate='.$id.'#sendempresa';?>">
									<button type="button" class="btn btn-danger">
										<strong><?=$data;?> = </strong> <span class="glyphicon glyphicon-trash"></span>
									</button>
								</a>
								<?php
							endif;
						endforeach;
					else:								
					endif;
					?>				
				</div>
			</div>


		</div>
	</div>

	<hr />

	<div class="indent_title_in">
		<i class="fa fa-share-square-o" aria-hidden="true"></i>
		<h3>Redes Sociais</h3>
		<p>
			Insira as urls de suas redes sociais!
		</p>
	</div>

	<div class="wrapper_indent">
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label for="facebook_status">Facebook Status:</label>
					<select required class="form-control" name="facebook_status">
						<?php 
						if(!empty($facebook_status) && $facebook_status == 2):
							echo "
							<option value=\"2\">Mostrar no Site</option>
							<option value=\"1\">Não Mostrar no Site</option>			
							";

						else:
							echo "
							<option value=\"1\">Não Mostrar no Site</option>
							<option value=\"2\">Mostrar no Site</option>	
							";
						endif;
						?>					
					</select>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="facebook_empresa">Facebook URL:</label>
					<input type="text" placeholder="https://www.facebook.com/Meu_Perfil" class="form-control" value="<?=(!empty($facebook_empresa) ? $facebook_empresa : "");?>" name="facebook_empresa" >
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label for="instagram_status">Instgram Status:</label>
					<select required class="form-control" name="instagram_status">
						<?php 
						if(!empty($instagram_status) && $instagram_status == 2):
							echo "
							<option value=\"2\">Mostrar no Site</option>
							<option value=\"1\">Não Mostrar no Site</option>			
							";

						else:
							echo "
							<option value=\"1\">Não Mostrar no Site</option>
							<option value=\"2\">Mostrar no Site</option>	
							";
						endif;
						?>
					</select>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="instagram_empresa">Instgram URL:</label>
					<input type="text" placeholder="https://www.instagram.com/Meu_Perfil" class="form-control" value="<?=(!empty($instagram_empresa) ? $instagram_empresa : "");?>" name="instagram_empresa" >
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label for="twitter_status">Twitter Status:</label>
					<select required class="form-control" name="twitter_status">
						<?php 
						if(!empty($twitter_status) && $twitter_status == 2):
							echo "
							<option value=\"2\">Mostrar no Site</option>
							<option value=\"1\">Não Mostrar no Site</option>			
							";

						else:
							echo "
							<option value=\"1\">Não Mostrar no Site</option>
							<option value=\"2\">Mostrar no Site</option>	
							";
						endif;
						?>
					</select>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="twitter_empresa">Twitter URL:</label>
					<input type="text" placeholder="https://twitter.com/Meu_Perfil" class="form-control" value="<?=(!empty($twitter_empresa) ? $twitter_empresa : "");?>" name="twitter_empresa" >
				</div>
			</div>
		</div>
	</div><!-- End wrapper_indent -->

	<div class="indent_title_in">
		<i class="icon_images"></i>
		<h3>Imagens de fundo e de Perfil</h3>
		<p>
			Imagens que serão usadas na página inicial do site!
		</p>
	</div>

	<div class="wrapper_indent add_bottom_45">

		<div class="form-group">
			<label>Imagem utilizada como banner de fundo no site:</label>
			<div class="input-file-container">  
				<input name="img_header" class="input-file" id="my-file" type="file" />
				<label tabindex="0" for="my-file" class="input-file-trigger">Enviar Imagem...</label>
			</div>
			<p class="file-return"></p>
			<br />
			<?=(!empty($img_header) ? "<spa style=\"color:#70bb0f;\">VOCÊ JÁ ENVIOU UMA IMAGEM!</span>" : "");?>
		</div>	

		<div class="form-group">
			<label>Imagem de perfil, será redimensionada em 240 X 240:</label>
			<div class="input-file-container">  
				<input name="img_logo" class="input-file" id="my-file" type="file" />
				<label tabindex="0" for="my-file" class="input-file-trigger">Enviar Imagem...</label>
			</div>
			<p class="file-return"></p>
			<br />
			<?=(!empty($img_logo) ? "<spa style=\"color:#70bb0f;\">VOCÊ JÁ ENVIOU UMA IMAGEM!</span>" : "");?>
		</div>
	</div><!-- End wrapper_indent -->
	<div class="wrapper_indent add_bottom_45">
	</div><!-- End wrapper_indent -->
	<hr />
	<div class="wrapper_indent">
		<input type="hidden" name="user_id" value="<?=$userlogin['user_id'];?>" />
		<input type="hidden" name="sendempresa" value="true" />
		<button type="input" class="btn_1">SALVAR ALTERAÇOES</button>
		<b style="float: right;color: green;font-weight: bold;">Data de Renovação: 
			<?php
			echo $dataFomatadarenovacao;
			?></b>
		</div><!-- End wrapper_indent -->
		<div class="panel-group" id="accordion">

		</form>

	</section><!-- End section 1 -->

</div>