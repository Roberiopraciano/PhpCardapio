<?php
ob_start();
session_cache_expire(60);
session_start();
require('../_app/Config.inc.php');
require('../_app/Mobile_Detect.php');
$detect = new Mobile_Detect;
$site = HOME;
$login = new Login(3);
if($login->CheckLogin()):
	$idusuar = $_SESSION['userlogin']['user_id'];
	$lerbanco->ExeRead('ws_empresa', "WHERE user_id = :idcliente", "idcliente={$idusuar}");
	if (!$lerbanco->getResult()):       
	else:
		foreach ($lerbanco->getResult() as $i):
			extract($i);
		endforeach;
		header("Location: {$site}{$nome_empresa_link}/estatisticas");
	endif;
else:
endif;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Fazer login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<!--===============================================================================================-->
	  <link href="<?=$site;?>css/suportewats.css" rel="stylesheet">
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
				<form method="post" class="login100-form validate-form flex-sb flex-w">
				
					<!-- <img style="margin: 0 auto; max-width: 70%;" src="images/logo.png"/> -->
					<span  class="login100-form-title p-b-32" style="margin-top: 15px;font-size: 20px;">

						<center>Fazer Login</center>
					</span>
					<?php
					

					$dataLogin = filter_input_array(INPUT_POST, FILTER_DEFAULT);

					if(!empty($_GET['register']) && $_GET['register'] == 'true' && empty($dataLogin)):
						echo "<p class=\"login100-form-title p-b-32\" style='color: green;font-size:25px;'><b>Sucesso!</b> Agora você pode fazer login.</p>";
				endif;

				if(!empty($dataLogin)):
					if(in_array("", $dataLogin)):
						echo "
						<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">
						<strong>Opss... </strong>Preencha os Campos Login e Senha!
						<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
						<span aria-hidden=\"true\">&times;</span>
						</button>
						</div>";
					else:
						$login = new Login(3);
						$login->ExeLogin($dataLogin);
						if (!$login->getResult()):								
							echo "
							<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">
							<strong>Opss... </strong>{$login->getError()[0]}
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
							<span aria-hidden=\"true\">&times;</span>
							</button>
							</div>";
						else:
							if($login->CheckLogin()):
								$idusuar = $_SESSION['userlogin']['user_id'];
								$lerbanco->ExeRead('ws_empresa', "WHERE user_id = :idcliente", "idcliente={$idusuar}");
								if (!$lerbanco->getResult()):

									echo "
									<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">
									<strong>Opss... </strong>Ocorreu um erro entre em contato conosco!
									<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
									<span aria-hidden=\"true\">&times;</span>
									</button>
									</div>";
								else:
									foreach ($lerbanco->getResult() as $i):
										extract($i);
									endforeach;
									header("Location: {$site}{$nome_empresa_link}/estatisticas");
								endif;
							endif;	
						endif;
					endif;
				endif;
				?>

				<span class="txt1 p-b-11">
					E-mail
				</span>
				<div class="wrap-input100 validate-input m-b-36" data-validate = "O e-mail e obrigatório">
					<input class="input100" type="text" name="user" >
					<span class="focus-input100"></span>
				</div>

				<span class="txt1 p-b-11">
					Senha
				</span>
				<div class="wrap-input100 validate-input m-b-12" data-validate = "A senha e obrigatória">
					<span class="btn-show-pass">
						<i class="fa fa-eye"></i>
					</span>
					<input class="input100" type="password" name="pass" >
					<span class="focus-input100"></span>
				</div>

				<div class="flex-sb-m w-full p-b-48">
					<div class="contact100-form-checkbox">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
						<label class="label-checkbox100" for="ckb1">
							Lembrar senha
						</label>
					</div>						
				</div>

				<div class="container-login100-form-btn">
					<button class="login100-form-btn" style="background-color: #43b533;">
						Entrar
					</button>
				</div>

			</form>
			<style type="text/css">
				#social_footer{
	text-align:center;
	border-top:1px solid #ededed;
	padding-top:30px;
	margin-top:30px;
}
#social_footer p{
	font-size:12px;
	color:#8c8c8c;
}
#social_footer ul{
	margin:0;
	padding:0 0 10px 0;
	text-align:center;
}
#social_footer ul li{
	display:inline-block;
	margin:0 5px 10px 5px;
}
#social_footer ul li a{
	color:#666;
	text-align:center;
	line-height:34px;
	display:block;
	font-size:16px;
	width:35px;
	height:35px;
	background-color:#f2f2f2;
	-webkit-border-radius: 50%;
	-moz-border-radius: 50%;
	border-radius: 50%;
}
#social_footer ul li a:hover{
	background:#fff;
	color:#111;
}
			</style>
			<div id="social_footer">
        <ul>
          <li><a target="_blank" href="<?=(!empty($texto['link_do_face']) ? $texto['link_do_face'] : "");?>"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></li>
          <!--<li><a href="#0"><i class="icon-twitter"></i></a></li>-->
          <!--<li><a href="#0"><i class="icon-google"></i></a></li>-->
          <li><a target="_blank" href="<?=(!empty($texto['link_do_insta']) ? $texto['link_do_insta'] : "");?>"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
          <!--<li><a href="#0"><i class="icon-pinterest"></i></a></li>-->
          <!--<li><a href="#0"><i class="icon-vimeo"></i></a></li>-->
          <li><a target="_blank" href="<?=(!empty($texto['link_do_insta']) ? $texto['link_do_insta'] : "");?>"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
        </ul>    
      </div>
		</div>
	</div>

</div>


<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/bootstrap/js/popper.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/daterangepicker/moment.min.js"></script>
<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script src="js/main.js"></script>
<script src="<?=$site;?>js/suportewats.js"></script>






<div id='whatsapp-chat' class='hide'>
  <div class='header-chat'>
    <div class='head-home'>
      <h3 style="color: #ffffff;">    
        <?php
        $hr = date(" H ");
        if($hr >= 12 && $hr<18) {
          $resp = "Boa tarde!";}
          else if ($hr >= 0 && $hr <12 ){
            $resp = "Bom dia!";}
            else {
              $resp = "Boa noite!";}
              echo "$resp";
              ?>
            </h3>
            <p style="color:#ffffff;">Clique em um de nossos representantes abaixo para conversar no WhatsApp ou envie um email para <?=$texto['emailSuporteSite'];?></p></div>
            <div class='get-new hide'><div id='get-label'></div><div id='get-nama'></div></div></div>
            <div class='home-chat'>
              <!-- Info Contact Start -->
              <a class='informasi' href='javascript:void' title='Chat Whatsapp'>
                <div class='info-avatar'><img src='<?=$site?>img/supportmale.png'/></div>
                <div class='info-chat'>
                  <span class='chat-label'>Suporte Técnico</span>
                  <span class='chat-nama'>Atendimento ao Cliente 1</span>
                </div><span class='my-number'><?=$texto['telefoneAdministracaoTecnica'];?></span>
              </a>
              <!-- Info Contact End -->
              <!-- Info Contact Start -->
              <a class='informasi' href='javascript:void' title='Chat Whatsapp'>
                <div class='info-avatar'><img src='<?=$site?>img/supportfemale.png'/></div>
                <div class='info-chat'>
                  <span class='chat-label'>Suporte Vendas</span>
                  <span class='chat-nama'>Atendimento ao Cliente 2</span>
                </div><span class='my-number'><?=$texto['telefoneAdministracaoVendas'];?></span>
              </a>
              <!-- Info Contact End -->
              <div class='blanter-msg'><b>HORÁRIOS: </b> de <i><?=$texto['horariosSuporteSite']?></i></div></div>
              <div class='start-chat hide'>
                <div class='first-msg'><span>Olá, Como posso te ajudar?</span></div>
                <div class='blanter-msg'>
                  <input type="text" id='chat-input2' maxlength='120' class="form-control" placeholder='Escreva uma pergunta...' />
                  <a href='javascript:void;' id='send-it'><i class="fa fa-paper-plane" aria-hidden="true"></i></a></div></div>
                  <div id='get-number'></div><a class='close-chat' href='javascript:void'>×</a>
                </div>
                <a class='blantershow-chat' href='javascript:void' title='Show Chat'><i class='fab fa-whatsapp'></i>Precisa de ajuda?</a>
                <!-- partial -->

</body>
</html>

<?php
ob_end_flush();
?>