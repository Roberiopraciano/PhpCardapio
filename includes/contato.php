<div id="contato_do_site">
	<div style="background-color:#ffffff;" class="container margin_60">
		<div class="main_title margin_mobile">
			<h2 class="nomargin_top"><b><?=$texto['texto_contato_head'];?></b></h2>
			<br />
			<p>
				<?=$texto['texto_contato_paragrafo'];?>            
			</p>
			
		</div>
		<?php
		$datadadosmsg = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		
		if (isset($datadadosmsg['enviarmsg'])):
			unset($datadadosmsg['enviarmsg']);
			$datadadosmsg = array_map('strip_tags', $datadadosmsg);
			$datadadosmsg = array_map('trim', $datadadosmsg);
			
			if (in_array('', $datadadosmsg) || in_array('null', $datadadosmsg)):
				echo "<div class=\"alert alert-info alert-dismissable\">
			<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">X</button>
			<center>{$texto['texto_contato_erro_vazio']}</center>
			</div><br />";
		elseif (!Check::Email($datadadosmsg['email'])):
			echo "<div class=\"alert alert-warning alert-dismissable\">
			<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">X</button>
			<center>{$texto['texto_contato_erro_email']}</center>
			</div><br />";
		else:
			$link = "https://api.whatsapp.com/send?phone=55{$telefone_empresa}&text=‼ *-----NOVO CONTATO-----* ‼%0A%0ACliente: *{$datadadosmsg['nome']}*%0AAssunto: *{$datadadosmsg['assunto']}*.%0A%0A📨 E-mail: {$datadadosmsg['email']}%0A%0A*Mensagem:*%0A{$datadadosmsg['msg']}%0A%0A🍔🍟🌭🍕🍰🥤🍨🥧🍛🍩%0A";
			
			header("Location: {$link}"); 
			    
			endif;
			endif;
			?>

<div class="row"> 
	<div class="col-md-8 col-md-offset-2">

		<form action="<?=$site.$Url[0].'/';?>contato#contato_do_site" method="post">
			<div class="row">
				<div class="col-md-6 col-sm-6">
					<div class="form-group">
						<label><?=$texto['texto_contato_nome'];?></label>
						<input type="text" class="form-control" id="nome" name="nome" placeholder="<?=$texto['texto_contato_nome'];?>">
					</div>
				</div>
				<div class="col-md-6 col-sm-6">
					<div class="form-group">
						<label><?=$texto['texto_contato_assunto'];?></label>
						<input type="text" class="form-control" id="assunto" name="assunto" placeholder="<?=$texto['texto_contato_assunto'];?>">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 col-sm-6">
					<div class="form-group">
						<label><?=$texto['texto_contato_email'];?></label>
						<input type="email" id="email" name="email" class="form-control" placeholder="seuemail@email.com">
					</div>
				</div>
				<div class="col-md-6 col-sm-6">
					<div class="form-group">
						<label>Seu WhatsApp:</label>
						<input type="tel" placeholder="(99) 99999-9999" data-mask="(00) 00000-0000" maxlength="15" id="telefone" name="telefone" value="" class="form-control">
					</div>
				</div>
				<div class="col-md-12 col-sm-12">
					<div class="form-group">
						<label><?=$texto['texto_contato_msg'];?></label>
						<textarea class="form-control" type='text' name='msg' id='msg' placeholder='Escrever mensagem...'></textarea>
					</div>
				</div>
			</div>

			<input type='tel' name='tel' id='tel' value='<?=(!empty($telefone_empresa) ? '55'.$telefone_empresa : '');?>' hidden>
			<hr style="border-color:#ddd;">
			<div class="text-center"><button type="submit" name="enviarmsg" class="btn_full_outline"><i class="fa fa-whatsapp" aria-hidden="true"></i> <?=$texto['texto_contato_bt'];?></button></div>
		</form><br />
	</div><!-- End col  -->

</div><!-- End row  -->
</div>
</div><!-- End container  -->