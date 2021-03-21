<?php
ob_start();
session_start();
require('../_app/Config.inc.php');
require('../_app/Mobile_Detect.php');
$detect = new Mobile_Detect;

$site = HOME;

$login = new AdministradorLogin(1);

$logoff = filter_input(INPUT_GET, 'logoff', FILTER_VALIDATE_BOOLEAN);

if(!$login->CheckLogin()):
    unset($dataLogin['administrador']);
    header("Location: {$site}");
else:
    $adminlogin =  $_SESSION['administrador'];
endif;

if(!empty($logoff) && $logoff == 'true'):
    unset($_SESSION['administrador']);
    header("Location: {$site}admin");
endif;

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
    <title><?=$texto['nome_site_landing'];?> - Administrar</title>
    <!-- Bootstrap Core CSS -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- chartist CSS -->
    <link href="../plugins/bower_components/chartist-js/dist/chartist.min.css" rel="stylesheet">
    <link href="../plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    <!-- Vector CSS -->
    <link href="../plugins/bower_components/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <!-- animation CSS -->
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="css/colors/blue-dark.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<link href="../css/x0popup-master/dist/x0popup.min.css" rel="stylesheet">
   <!-- jQuery -->
    <script src="../plugins/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="../css/x0popup-master/dist/x0popup.min.js"></script>

</head>

<body class="fix-header">
    <!-- ============================================================== -->
    <!-- Preloader -->
    <!-- ============================================================== -->
   
    <!-- ============================================================== -->
    <!-- Wrapper -->
    <!-- ============================================================== -->
    <div id="wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header">
                <div class="top-left-part">

                </div>
                <!-- /Logo -->
                <!-- Search input and Toggle icon -->
                <ul class="nav navbar-top-links navbar-left">
                    <li><a href="javascript:void(0)" class="open-close waves-effect waves-light visible-xs"><i class="ti-close ti-menu"></i></a></li>

                </ul>
                <ul class="nav navbar-top-links navbar-right pull-right">

                    <li class="dropdown">
                        <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"><b class="hidden-xs"><?=$_SESSION['administrador']['admin_email']; ?></b><span class="caret"></span> </a>
                        <ul class="dropdown-menu dropdown-user animated flipInY">

                            <li><a href="<?=$site.'admin/painel.php'?>?logoff=true"><i class="fa fa-power-off"></i> Sair</a></li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <!-- /.dropdown -->
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>
        <!-- End Top Navigation -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav slimscrollsidebar">
                <div class="sidebar-head">
                    <h3><span class="fa-fw open-close"><i class="ti-menu hidden-xs"></i><i class="ti-close visible-xs"></i></span> <span class="hide-menu">MENU</span></h3>
                </div>
                <ul class="nav" id="side-menu">

                    <li class="devider"></li>
                    <li> <a href="<?=$site?>admin/painel.php" class="waves-effect"><i class="icon-home"></i> <span class="hide-menu">Painel</span></a> </li>
                    <li> <a href="<?=$site;?>admin/painel.php?exe=configuracoes" class="waves-effect"><i  class="mdi mdi-settings fa-fw"></i> <span class="hide-menu">Configurações</span></a> </li>
                    <li> <a href="<?=$site;?>admin/painel.php?exe=mudar-login" class="waves-effect"><i  class="mdi mdi-settings fa-fw"></i> <span class="hide-menu">Alterar dados de login</span></a> </li>
                      <li> <a href="<?=$site;?>admin/painel.php?exe=todos-os-clientes"><i  class="mdi mdi-account-multiple"></i> <span class="hide-menu">Todos os clientes</span></a> </li>
                </ul>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Left Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">BEM VINDO</h4>
                    </div>                   
                </div>


                <?php
                $getexe = filter_input(INPUT_GET, 'exe', FILTER_DEFAULT);
                $url = (isset($getexe) ? strip_tags(trim($getexe)) : 'home');
                $url = ($url == null ? 'home' : $url);                            
                if(file_exists('./includes/'.$url.'.php')):
                    require_once('includes/'.$url.'.php');
                else:
                    require_once('includes/home.php');
                endif;
                ?>



                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> <?=date('Y')?> &copy; <?=$texto['nome_site_landing'];?></footer>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
 
    <!-- Bootstrap Core JavaScript -->
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--Counter js -->
    <script src="../plugins/bower_components/waypoints/lib/jquery.waypoints.js"></script>
    <script src="../plugins/bower_components/counterup/jquery.counterup.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!-- Vector map JavaScript -->
    <script src="../plugins/bower_components/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="../plugins/bower_components/vectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="../plugins/bower_components/vectormap/jquery-jvectormap-in-mill.js"></script>
    <script src="../plugins/bower_components/vectormap/jquery-jvectormap-us-aea-en.js"></script>
    <!-- chartist chart -->
    <script src="../plugins/bower_components/chartist-js/dist/chartist.min.js"></script>
    <script src="../plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>
    <!-- sparkline chart JavaScript -->
    <script src="../plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
    <script src="../plugins/bower_components/jquery-sparkline/jquery.charts-sparkline.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="js/custom.min.js"></script>
    <script src="js/dashboard3.js"></script>
    <!--Style Switcher -->
    <script src="../plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>

    <script src="../js/jquery.mask.js"></script>
    <script>
        $('#dinheiro').mask('#.##0,00', {reverse: true});
        $('.telefone').mask('(00) 0 0000-0000');
        $('.estado').mask('AA');
        $('.cpf').mask('000-000.000-00');
        $('.cnpj').mask('00.000.000/0000-00');
        $('.rg').mask('00.000.000-0');
        $('.cep').mask('00000-000');
        $('.dataNascimento').mask('00/00/0000');
        $('.placaCarro').mask('AAA-0000');
        $('.horasMinutos').mask('00:00');
        $('.cartaoCredito').mask('0000 0000 0000 0000');
        $('.numero').mask('#########0');
        $('.descontoporcentagem').mask('##0');
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('.salvarnovadata').click(function(){
                var pegaiddocliente = $(this).data('iddaloja');

                $.ajax({
                    url: 'controlers/novadatarenovacao.php',
                    method: 'post',
                    data: $('#formRenovar_'+pegaiddocliente).serialize(),
                    success: function(data){
                        if(data == "erro1"){
                            $('#modalRenovar_'+pegaiddocliente).modal('hide');
                            x0p('Opss...', 
                                'Informe a nova data!',
                                'error', false);

                        }else if(data == "erro2"){
                         $('#modalRenovar_'+pegaiddocliente).modal('hide');
                         x0p('Opss...', 
                            'o formato da data e inválido!',
                            'error', false);
                     }else if(data == "erro3"){
                         $('#modalRenovar_'+pegaiddocliente).modal('hide');
                         x0p('Opss...', 
                            'Ocorreu um erro!',
                            'error', false);
                     }else if(data == "erro0"){
                         window.location.reload(1);
                     }
                 }
             });

            });
        });
    </script>
</body>

</html>
