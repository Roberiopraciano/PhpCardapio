<?php
ob_start();
session_start();

require('../_app/Config.inc.php');
require('../_app/Mobile_Detect.php');
$detect = new Mobile_Detect;

$site = HOME;

?>
<!DOCTYPE html>  
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png">
  <title><?=$texto['nome_site_landing'];?> - Login</title>
  <!-- Bootstrap Core CSS -->
  <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- animation CSS -->
  <link href="css/animate.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link href="css/style.css" rel="stylesheet">
  <!-- color CSS -->
  <link href="css/colors/default.css" id="theme"  rel="stylesheet">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>
<body>
  <!-- Preloader -->
  <div class="preloader">
    <div class="cssload-speeding-wheel"></div>
  </div>
  <section id="wrapper" class="new-login-register">
    <div class="lg-info-panel">
      <div class="inner-panel">
        <a href="javascript:void(0)" class="p-20 di"><img src="../plugins/images/admin-logo.png"></a>
        <div class="lg-content">
          <h2><?=$texto['nome_site_landing'];?> </h2>
          <p class="text-muted"><?=$texto['descricao_site_landing'];?></p>
          <a href="<?=$site;?>" class="btn btn-rounded btn-danger p-l-20 p-r-20"> Voltar ao site</a>
        </div>
      </div>
    </div>
    <div class="new-login-box">
      <div class="white-box">
        <h3 class="box-title m-b-0">Login do Administrador</h3>
        <small>Preencha os campos abaixo:</small>
        <form class="form-horizontal new-lg-form" method="post">
          <div class="form-group">
           <div class="col-xs-12">
            <?php
           
            $dataLogin = filter_input_array(INPUT_POST, FILTER_DEFAULT);


            if(isset($_SESSION['userlogin'])):
              header("Location: {$site}");
            endif;

            if(isset($_SESSION['administrador'])):
              header("Location: {$site}admin/painel.php");
            endif;
            
            if (!empty($dataLogin) && empty($_SESSION['administrador'])):
              $login = new AdministradorLogin(1);
              $login->ExeLogin($dataLogin);
              if (!$login->getResult()):                                  
                echo "<div class=\"alert alert-info alert-dismissable\">
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">X</button>
                <center>{$login->getError()[0]}</center>
                </div>";
              else:
               header("Location: {$site}admin/painel.php");
             endif;
           endif;

           $get = filter_input(INPUT_GET, 'exe', FILTER_DEFAULT);

           if (!empty($get)):
            if ($get == 'restrito'):
             echo "<div class=\"alert alert-info alert-dismissable\">
             <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">X</button>
             <center><b>OOOPS!</b> Acesso Negado, favor efetue login para acessar o painel.</center>
             </div>";
             header("Refresh: 5; url={$site}admin/");
           elseif ($get == 'logoff'):              
             echo "<div class=\"alert alert-info alert-dismissable\">
             <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">X</button>
             <center><b>DESLOGADO:</b> Você saiu de sua conta!</center>
             </div>";
             header("Refresh: 5; url={$site}admin/");
           endif;
         endif;

         ?>
       </div>
     </div>
     <div class="form-group  m-t-20">
      <div class="col-xs-12">
        <label>Seu E-mail</label>
        <input class="form-control" type="text" name="admin_email" required placeholder="E-mail">
      </div>
    </div>
    <div class="form-group">
      <div class="col-xs-12">
        <label>Sua Senha</label>
        <input class="form-control" type="password" name="admin_senha" required placeholder="********">
      </div>
    </div>
    <div class="form-group text-center m-t-20">
      <div class="col-xs-12">
        <button class="btn btn-info btn-lg btn-block btn-rounded text-uppercase waves-effect waves-light" type="submit">Entrar</button>
      </div>
    </div>
  </form>
</div>
</div>            


</section>
<!-- jQuery -->
<script src="../plugins/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Menu Plugin JavaScript -->
<script src="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>

<!--slimscroll JavaScript -->
<script src="js/jquery.slimscroll.js"></script>
<!--Wave Effects -->
<script src="js/waves.js"></script>
<!-- Custom Theme JavaScript -->
<script src="js/custom.min.js"></script>
<!--Style Switcher -->
<script src="../plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
</body>
</html>
