<?php
$login = new Login(3);
if($login->CheckLogin()):
  $idusuar = $_SESSION['userlogin']['user_id'];
  $lerbanco->ExeRead('ws_empresa', "WHERE user_id = :idcliente", "idcliente={$idusuar}");
  if (!$lerbanco->getResult()):       
  else:
    foreach ($lerbanco->getResult() as $i):
      extract($i);
    endforeach;
    header("Location: {$site}{$nome_empresa_link}/pedidos");
  endif;
else:
endif;
?>
<!DOCTYPE html>
<!--[if IE 9]><html class="ie ie9"> <![endif]-->
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title><?=$texto['titulo_site_landing'];?></title>
  <meta name="robots" content="index, fallow" />
  <link rel="canonical" href="<?=$site;?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">    
  <meta name="keywords" content="<?=$texto['keywords_landing'];?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="author" content="<?=$texto['autor_site_landing'];?>">
  <meta property="og:site_name" content="<?=$texto['nome_site_landing'];?>"/>
  <meta property="og:url" content="<?=$site;?>"/>
  <meta name="description" content="<?=$texto['descricao_site_landing'];?>" />
  <meta property="og:description" content="<?=$texto['descricao_site_landing'];?>" />
  


  <!-- Favicons-->
  <link rel="shortcut icon" href="<?= $site; ?>img/favicon.png" type="image/x-icon">

  <!-- GOOGLE WEB FONT -->
  <link href='https://fonts.googleapis.com/css?family=Lato:400,700,900,400italic,700italic,300,300italic' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Gochi+Hand' rel='stylesheet' type='text/css'>

  <!-- BASE CSS -->
  <link href="<?=$site;?>css/base.css" rel="stylesheet">
  <link href="<?=$site;?>css/suportewats.css" rel="stylesheet">
  <link href="<?= $site; ?>notificacao/light-theme.min.css" rel="stylesheet">
  <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.8.2/css/all.css'>
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Lato'><link rel="stylesheet" href="./style.css">

    <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->

    <!-- INCLUDE JQUARY -->
    <script src="<?=$site;?>js/jquery-2.2.4.min.js"></script>

    <link href="<?= $site; ?>css/x0popup-master/dist/x0popup.min.css" rel="stylesheet">
    <script src="<?= $site; ?>css/x0popup-master/dist/x0popup.min.js"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-72237051-9"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-72237051-9');
    </script>

  </head>

  <body>
<!--[if lte IE 8]>
    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a>.</p>
  <![endif]-->

  <div id="preloader">
    <div class="sk-spinner sk-spinner-wave" id="status">
      <div class="sk-rect1"></div>
      <div class="sk-rect2"></div>
      <div class="sk-rect3"></div>
      <div class="sk-rect4"></div>
      <div class="sk-rect5"></div>
    </div>
  </div><!-- End Preload -->

  <!-- Header ================================================== -->
  <header>
    <div class="container-fluid">
      <div class="row" style="padding-bottom: 8px;">
        <div class="col--md-4 col-sm-4 col-xs-4">
         <a href="<?=$site;?>" id="logo">
          <img src="<?= $site; ?>img/home.png" height="30" width="40" alt="" data-retina="true" class="hidden-xs">
          <img src="<?= $site; ?>img/home.png" height="30" width="40" alt="" data-retina="true" class="hidden-lg hidden-md hidden-sm">
        </a>
        </div>
        <nav class="col--md-8 col-sm-8 col-xs-8">
          <a href="#0" data-toggle="modal" data-target="#login_2" style="float: right;color:#000000;margin-top:5px;"><b style="color:#000000;background-color: #e5a44e;padding:5px;border-radius: 4px;">Fazer Login</b></a>
        </nav>
      </div><!-- End row -->
    </div><!-- End container -->
  </header>
  <!-- End Header =============================================== -->

  <!-- SubHeader =============================================== -->
  <section class="parallax-window" id="short" data-parallax="scroll" data-image-src="img/sub_header_cart.jpg" data-natural-width="1400" data-natural-height="350">
    <div id="subheader">
      <div id="sub_content">
       <h1>Crie um cardápio atraente</h1>
       <a target="_blank" style="color: #ffffff;" href="<?=$site;?>Demo"><button class="btn" style="font-size: 25px; background-color: #1bc138; border-radius: 50px; width: 250px; height: 50px;">DEMONSTRAÇÃO</button></a>
       <p></p>
     </div><!-- End sub_content -->
   </div><!-- End subheader -->
   <?php
   $totalCliente = 0;
   $lerbanco->ExeRead("ws_users");
   if( $lerbanco->getResult()):
    $totalCliente = $totalCliente + $lerbanco->getRowCount();
  endif;

  $totalItens = 0;
  $lerbanco->ExeRead("ws_itens");
  if( $lerbanco->getResult()):
    $totalItens = $totalItens + $lerbanco->getRowCount();
  endif;

  $totalPedidos = 0;
  $lerbanco->ExeRead("ws_pedidos");
  if( $lerbanco->getResult()):
    $totalPedidos = $totalPedidos + $lerbanco->getRowCount();
  endif;
  ?>
  <div id="count" class="hidden-xs">
    <ul>
      <li><span class="number"><?=$totalCliente;?></span> Restaurantes</li>
      <li><span class="number"><?=$totalItens;?></span> Itens cadastrados</li>
      <li><span class="number"><?=$totalPedidos;?></span> Pedidos Realizados</li>
    </ul>
  </div>
</section><!-- End section -->
<!-- End SubHeader ============================================ -->

<div id="position">
  <div class="container">
    <ul>
      <li><a href="#0"><?=$texto['nome_site_landing'];?></a></li>
      <li><a href="#0">Sobre</a></li>
    </ul>

  </div>
</div><!-- Position -->



<!-- Content ================================================== -->
<div id="sobre" class="container margin_60_35">
  <div class="row">
    <div class="col-md-4">
      <h3 class="nomargin_top">Sobre o <strong><?=$texto['nome_site_landing'];?></strong></h3>
      <p>
       Somos um portal desenvolvido para você pode cadastrar seu menu online e receber pedidos via <strong>WhatsApp.</strong> 
     </p>
     <p>
       Nosso sistema e um aplicativo web totalmente responsivo e não possui necessidade de instalação por parte dos clientes, portanto, apenas divulgando o seu link nas redes sociais, o seu cliente pode visualizar seu menu e fazer o pedido pelo smartphone ou computador com muita comodidade.
     </p>
     <h4>Por que o Whatsapp?</h4>
     <p>
     O brasil e o terceiros pais que mais usa o Whatsapp! Segundo o site estatista  mais de 120 milhões da população brasileira usa o aplicativo, ficando somente atrás da Malásia e da Alemanha. </p>

     <p>Além disso, uma pesquisa recente realizada pelo Grupo Croma revelou que 59% dos brasileiros deixam o app na tela inicial do smartphone – mais uma prova de que, para a maioria dos brasileiros, o WhatsApp já virou o principal canal de comunicação móvel.</p>

     <p>Sem dúvida nenhuma o aplicativo oferece muita comodidade para o cliente, já que ele está habituado a fazer chamadas e participar de grupos. Porque não fazer pedidos também? Afinal, quem não tem WhatsApp?</p>


     <p>
       O cliente entra no site e visualiza o menu, preenche o carrinho com os itens do pedido, escolhe o método de entrega e pagamento e realiza o pedido via Whatsapp. Prontinho e sem estresse!
     </p>
   </div>
   <div class="col-md-7 col-md-offset-1 text-right">
    <img src="img/dispositivos.png" alt="" class="img-responsive">
  </div>
</div><!-- End row -->


<hr class="more_margin">

<!-- Content ================================================== -->
<div class="container margin_60">

 <div class="main_title">
  <h2 class="nomargin_top" style="padding-top:0">Como Funciona?</h2>
  <p>
    Veja como é simples o processo do momento que você envia o link do seu menu até a venda.
  </p>
</div>
<div class="row">

  <div class="col-md-3">
    <div class="box_home" id="two">
      <span>1</span>
      <h3>Seu negócio online</h3>
      <p>
        Seu cliente preenche o carrinho com os itens do seu menu!
      </p>
    </div>
  </div>
  <div class="col-md-3">
    <div class="box_home" id="one">
      <span>2</span>
      <h3>Endereço de entrega</h3>
      <p>
       Seu cliente informa o endereço ou se vai retirar no local!
     </p>
   </div>
 </div>
 <div class="col-md-3">
  <div class="box_home" id="three">
    <span>3</span>
    <h3>Forma de pagamento</h3>
    <p>
      Seu cliente informa como vai pagar e observações!
    </p>
  </div>
</div>
<div class="col-md-3">
  <div class="box_home" id="four">
    <span>4</span>
    <h3>E por fim, Delivery</h3>
    <p>
      Depois de receber o pedido, basta preparar e fazer a entrega.
    </p>
  </div>
</div>
</div><!-- End row -->
</div><!-- End container -->


<div class="main_title">
  <h2 class="nomargin_top">Somos a melhor plataforma de pedidos<br />online integrada com <strong>WhatsApp.</strong>
  </h2>
  <br />
  <p>
    Tenha seu próprio canal de vendas e tenha um maior relacionamento com seus clientes, sem intermediários.
  </p>
</div>



<div class="row">
  <div class="col-md-6 wow fadeIn" data-wow-delay="0.3s">
    <div class="feature">
      <i class="icon_mobile"></i>
      <h3><span>suporte</span> em Smartphones</h3>
      <p>
       Nosso cardápio digital roda em qualquer disposítivo.
     </p>
   </div>
 </div>
 <div class="col-md-6 wow fadeIn" data-wow-delay="0.4s">
  <div class="feature">
    <i class=" icon-link"></i>
    <h3><span>Link</span> amigável</h3>
    <p>
     Link amigável para você divulgar e enviar para seus clientes.
   </p>
 </div>
</div>
</div><!-- End row -->
<div class="row">
  <div class="col-md-6 wow fadeIn" data-wow-delay="0.5s">
    <div class="feature">
      <i class="icon-volume-up"></i>
      <h3><span>Notificação </span>de pedidos</h3>
      <p>
        Através do painel o sistema te notifica sobre um novo pedido. 
      </p>
    </div>
  </div>
  <div class="col-md-6 wow fadeIn" data-wow-delay="0.6s">
    <div class="feature">
      <i class="icon-chart-outline"></i>
      <h3><span>Estatística</span> do seu negócio</h3>
      <p>
        Gráficos sobre seus pedidos em um ambiente agradável!
      </p>
    </div>
  </div>
</div><!-- End row -->

<div class="row">
  <div class="col-md-6 wow fadeIn" data-wow-delay="0.7s">
    <div class="feature">
      <i class="icon-ticket-1"></i>
      <h3><span>Cupons </span>de desconto</h3>
      <p>
        Use cupons de descontos para fidelizar clientes. 
      </p>
    </div>
  </div>
  <div class="col-md-6 wow fadeIn" data-wow-delay="0.8s">
    <div class="feature">
      <i class="icon-print-2"></i>
      <h3><span>Impressão</span> de Pedidos.</h3>
      <p>
       Imprima os pedidos para agilizar na cozinha.
     </p>
   </div>
 </div>
</div><!-- End row -->

<div class="row">
  <div class="col-md-6 wow fadeIn" data-wow-delay="0.9s">
    <div class="feature">
      <i class="icon-money-1"></i>
      <h3><span>Fácil </span>de usar.</h3>
      <p>
        Não perca tempo, cadastre os produtos e comece a usar hoje. 
      </p>
    </div>
  </div>
  <div class="col-md-6 wow fadeIn" data-wow-delay="1.0s">
    <div class="feature">
      <i class="icon-arrows-cw-2"></i>
      <h3><span>Atualizações</span> constantes.</h3>
      <p>
       Estamos sempre evoluindo e melhorando ainda mais o sistema.
     </p>
   </div>
 </div>
</div><!-- End row -->
</div><!-- End container -->
<!-- Content ================================================== -->

<div class="container-fluid">
  <div class="row">
    <div class="col-md-6 nopadding features-intro-img">
      <div class="features-bg img_2">
        <div class="features-img">
        </div>
      </div>
    </div>
    <div class="col-md-6 nopadding">
      <div class="features-content">
        <h3>"Controle dos itens!"</h3>
        <ul class="list_ok">
          <li> Imagem, descriçao e valor do item,</li>
          <li> Visibilidade no menu,</li>
          <li> Disponibilidade do item,</li>
          <li> Opções únicas e Adicionais.</li>
        </ul>
      </div>
    </div>
  </div>
</div><!-- End container-fluid  -->

<div class="high_light">
  <div class="container">
    <h3>E ai, vai continuar <strong>perdendo</strong> vendas?</h3>
    <p>Super fácil para seu cliente, compatível com todos os dispositivos e também dispensa a instalação.</p>
    <a href="<?=$texto['linkVideosLanding'];?>" target="_blank"> ASSISTIR OS VÍDEOS</a>
  </div><!-- End container -->
</div><!-- End hight_light -->

<section class="parallax-window-2">
  <div class="parallax-content-2">
    <div class="sub_content">
      <i class="icon-bicycle"></i>
      <h3 style="font-weight: bold;color: #ffffff;">Tenha controle sobre seus pedidos!</h3>
      <p><strong>Abertos, Em Andamento, Disponível para Retirada, Saiu para Entrega, Finalizados e cancelados.</strong>   
      </p>
    </div><!-- End sub_content -->
  </div><!-- End parallax-content-2-->
</section><!-- End section -->
<!-- End Content =============================================== -->



<div id="planos" class="white_bg">
  <div class="container margin_60_35">
    <div class="main_title margin_mobile">
      <h2 class="nomargin_top">Nossos Planos</h2>
      <p>
        Escolha seu plano:
      </p>
    </div>
    <div class="row text-center plans">
      <div class="plan col-md-4">
        <h2 class="plan-title"><?=$texto['nomePlanoUm'];?></h2>
        <p class="plan-price">R$<?=$texto['valorPlanoUm'];?><span>/00</span></p>
        <ul class="plan-features">
          <li>Assinatura de <strong><?=$texto['DiasPlanoUm'];?> dias.</strong></li>
          <li>Pedidos <strong>Ilimitados</strong></li>
          <li>Itens <strong>Ilimitados</strong></li>
          <li>Fotos nos itens</li>
          <li>Adicione Logo Marca</li>
          <li>Adicione Plano de Fundo</li>
          <li>Página de Contato</li>
          <li>Imagens nos itens</li>
          <li>Cupom de desconto</li>
        </ul>
      </div> <!-- End col-md-4 -->

      <div class="plan plan-tall col-md-4">
        <span class="ribbon"></span>
        <span class="ribbon_table"></span>
        <h2 class="plan-title"><?=$texto['nomePlanoDois'];?></h2>
        <p class="plan-price">R$<?=$texto['valorPlanoDois'];?><span>/00</span></p>
        <ul class="plan-features">
          <li>Assinatura de <strong><?=$texto['DiasPlanoDois'];?> dias.</strong></li>
          <li>Pedidos <strong>Ilimitados</strong></li>
          <li>Itens <strong>Ilimitados</strong></li>
          <li>Fotos nos itens</li>
          <li>Adicione Logo Marca</li>
          <li>Adicione Plano de Fundo</li>
          <li>Página de Contato</li>
          <li>Imagens nos itens</li>
          <li>Cupom de desconto</li>
        </ul>
      </div><!-- End col-md-4 -->

      <div class="plan col-md-4">
        <h2 class="plan-title"><?=$texto['nomePlanoTres'];?></h2>
        <p class="plan-price">R$<?=$texto['valorPlanoTres'];?><span>/00</span></p>
        <ul class="plan-features">
         <li>Assinatura de <strong><?=$texto['DiasPlanoTres'];?> dias.</strong></li>
         <li>Pedidos <strong>Ilimitados</strong></li>
         <li>Itens <strong>Ilimitados</strong></li>
         <li>Fotos nos itens</li>
         <li>Adicione Logo Marca</li>
         <li>Adicione Plano de Fundo</li>
         <li>Página de Contato</li>
         <li>Imagens nos itens</li>
         <li>Cupom de desconto</li>
       </ul>
     </div><!-- End col-md-4 -->
   </div><!-- End row plans-->
 </div><!-- End container -->
</div><!-- End white_bg -->

<div id="cadastrar" class="container margin_60">
  <div class="main_title margin_mobile">
    <h2 class="nomargin_top">NUNCA FOI TÃO FÁCIL <strong>VENDER</strong> ONLINE</h2>
    <br />
    <p>
     Garantia total de satisfação! Crie agora seu menu online e comece a vender. Você tem <b style="font-size: 25px;"><?=$texto['DiasDeTeste'];?></b> dias para testar.
   </p>
 </div>
 <div class="row">
   <div class="col-md-8 col-md-offset-2">
     <form id="formCadastro" autocomplete="off" method="post"> 

      <div class="row">
       <div class="col-md-6">
        <div class="form-group">
         <label for="nome_empresa">Nome da Loja</label>
         <input type="text" autocomplete="off" id="nome_empresa" name="nome_empresa" class="form-control" required placeholder="Nome da Loja">
       </div>
     </div>
     <div class="col-md-6">
      <div class="form-group">
       <label for="nome_empresa_link"><?=$site;?></label>
       <input type="text" autocomplete="off"  id="nome_empresa_link" name="nome_empresa_link" class="form-control" required placeholder="/ Use maiúsculas, minúsculas e underline.">
       <a class="btn btn-success btn-xs" id="verificarDisponibilidadeLink" style="color: #ffffff;cursor: pointer;margin-top: 5px;"><strong> verificar Disponibilidade </strong></a>
     </div>
   </div>
 </div><!-- End row  -->
 <div class="row">
   <div class="col-md-6">
    <div class="form-group">
     <label for="estados">Estado</label>
     <select required class="form-control" name="end_uf_empresa" id="estados">     
     </select>    
   </div>
 </div>
 <div class="col-md-6">
  <div class="form-group">
   <label for="cidades">Cidade</label>
   <select required class="form-control" name="cidade_empresa" id="cidades">    
   </select>
 </div>
</div>
</div><!-- End row  -->
<div class="row">
 <div class="col-md-6">
  <div class="form-group">
   <label for="end_bairro_empresa">Bairro</label>
   <input type="text" autocomplete="off" id="end_bairro_empresa" required name="end_bairro_empresa" class="form-control" placeholder="Bairro...">
 </div>
</div>
<div class="col-md-6">
  <div class="form-group">
   <label for="end_rua_n_empresa">Rua / Nº</label>
   <input type="text" autocomplete="off" id="end_rua_n_empresa" required name="end_rua_n_empresa" class="form-control" placeholder="Rua e Nº">
 </div>
</div>
</div><!-- End row  -->
<hr />
<div class="row">
 <div class="col-md-6 col-sm-6">
  <div class="form-group">
   <label for="user_name">Nome</label>
   <input type="text" required autocomplete="off" class="form-control" id="user_name" name="user_name" placeholder="Seu Nome">
 </div>
</div>
<div class="col-md-6 col-sm-6">
  <div class="form-group">
   <label for="user_lastname">Sobrenome</label>
   <input type="text" required autocomplete="off"  class="form-control" id="user_lastname" name="user_lastname" placeholder="Seu Sobrenome">
 </div>
</div>
</div>
<div class="row">
 <div class="col-md-6 col-sm-6">
  <div class="form-group">
   <label for="user_email">E-mail:</label>
   <input type="email" required autocomplete="off" id="user_email" name="user_email" class="form-control " placeholder="E-mail">
 </div>
</div>
<div class="col-md-6 col-sm-6">
  <div class="form-group">
   <label for="user_telefone">Telefone para contato:</label>
   <input type="tel" required autocomplete="off"  id="user_telefone" name="user_telefone" class="form-control" placeholder="(99) 99999-9999" data-mask="(00) 00000-0000" maxlength="15">
 </div>
</div>
</div>
<div class="row">
 <div class="col-md-6">
  <div class="form-group">
   <label for="user_password">Senha</label>
   <input type="password" required autocomplete="off" class="form-control" placeholder="*******" name="user_password"  id="user_password" />
 </div>
</div>
<div class="col-md-6">
  <div class="form-group">
   <label for="user_password2">Repita a Senha</label>
   <input type="password" required autocomplete="off"  class="form-control" placeholder="*******" name="user_password2"  id="user_password2" />
 </div>
</div>
</div><!-- End row  -->
<div class="form-group">
  <label>Escolha seu plano</label>
  <select name="user_plano" class="form-control" >
    <option value="">Selecione um Plano</option>
    <option value="1"><?=$texto['nomePlanoUm'];?></option>
    <option value="2"><?=$texto['nomePlanoDois'];?></option>
    <option value="3"><?=$texto['nomePlanoTres'];?></option>
  </select>
</div>

<div id="pass-info" class="clearfix"></div>
<!--
<div class="row">
 <div class="col-md-6">
   <label>Leia os <a href="#0">termos e condições.</a></label>
 </div>
</div>End row  -->
<hr style="border-color:#ddd;">

<div class="text-center">
  <input type="hidden" name=" empresa_status" value="true">
  <button type="button" id="cadastrarUser" class="btn_full_outline">Cadastrar Minha Loja</button>
</div>
</form>
</div><!-- End col  -->
</div><!-- End row  -->
</div><!-- End container  -->
<!-- End Content =============================================== -->

<div id="planos" class="white_bg">
  <div class="container margin_60_35">
    <div class="main_title margin_mobile">
      <i style="font-size: 50px;" class="icon-question"></i>
      <h2 class="nomargin_top"><strong>Perguntas frequentes</strong></h2>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a class="accordion-toggle" data-toggle="collapse" data-parent="#payment" href="#collapsezero">Posso usar minha impressora térmica?<i class="indicator icon_plus_alt2 pull-right"></i></a>
        </h4>
      </div>
      <div id="collapsezero" class="panel-collapse collapse">
        <div class="panel-body">
          <b>SIM! Abaixo alguns dos modelos usados por clientes.</b><br />
          3nStar RPT-008
          Approx APPPOS80AM
          AURES ODP-333
          AURES ODP-500
          Bematech-4200-TH
          Bematech LR2000E
          Birch PRP-085III
          Bixolon SRP-350III
          Bixolon SRP-350Plus
          Black Copper BC-85AC
          CHD TH-305N
          Citizen CBM1000-II
          Citizen CT-S310II
          Dapper-Geyi Q583P
          Daruma DR800
          DR-MP200 (manufacturer unknown)
          EPOS TEP 220M
          Elgin i9
          Epson EU-T332C
          Epson FX-890
          Epson TM-T20
          Epson TM-T20II
          Epson TM-T70
          Epson TM-T70II
          Epson TM-T81
          Epson TM-T82II
          Epson TM-T88II
          Epson TM-T88III
          Epson TM-T88IV
          Epson TM-T88V
          Epson TM-U220
          Epson TM-U295
          Epson TM-U590 and TM-U590P
          Equal (EQ-IT-001) POS-58
          Everycom EC-58
          Excelvan HOP-E200
          Excelvan HOP-E58
          Excelvan HOP-E801
          Gainscha GP-2120TF
          Gainscha GP-5890x
          Gainscha GP-U80300I
          gprinter GP-U80160I
          HOIN HOP-H58
          Ithaca iTherm 28
          Hasar HTP 250
          Metapace T-1
          Metapace T-25
          Nexa PX700
          Nyear NP100
          OKI RT322
          OKI 80 Plus III
          Orient BTP-R580
          P-822D
          P85A-401 
          Partner Tech RP320
          POSLIGNE ODP200H-III-G
          QPOS Q58M
          Rongta RP326US
          Rongta RP58-U
          Rongta RP80USE
          SAM4S GIANT-100DB
          Senor TP-100
          Sewoo SLK-TS400
          SEYPOS PRP-96
          SEYPOS PRP-300
          SNBC BTP-R880NPIII
          Solux SX-TP-88300
          Sicar POS-80
          Silicon SP-201 / RP80USE
          SPRT SP-POS88V
          Star BSC10
          Star TSP100 ECO
          Star TSP100III FuturePRNT
          Star TSP-650
          Star TUP-592
          TVS RP45 Shoppe
          Venus V248T
          Xeumior SM-8330
          Xprinter F-900
          Xprinter XP-365B
          Xprinter XP-58 Series
          Xprinter XP-80C
          Xprinter XP-90
          XPrinter XP-Q20011
          Xprinter XP-Q800
          Zjiang NT-58H
          Zjiang ZJ-5870
          Zjiang ZJ-5890 
          Zjiang ZJ-8220
          Zjiang ZJ-8250
        </div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a class="accordion-toggle" data-toggle="collapse" data-parent="#payment" href="#collapseOne">Quem pode usar essa ferramenta?<i class="indicator icon_plus_alt2 pull-right"></i></a>
        </h4>
      </div>
      <div id="collapseOne" class="panel-collapse collapse">
        <div class="panel-body">
          É indicada para todos os negócios que atendam com delivery ou retirada no local, principalmente nichos do Foodservice. Basta realizar o cadastro em nossa plataforma para ter acesso ao painel e poder usar a ferramenta em seguida.
        </div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a class="accordion-toggle" data-toggle="collapse" data-parent="#payment" href="#collapseTwo">Vocês realizam a entrega dos produtos?<i class="indicator icon_plus_alt2 pull-right"></i></a>
        </h4>
      </div>
      <div id="collapseTwo" class="panel-collapse collapse">
        <div class="panel-body">
          Não! Nesse momento a ferramenta apoia no recebimento dos pedidos, tornando o processo de produção mais prático e organizado. <!--No entanto, alguns usuários reforçam a opção de retirada no local ao consumidor, o que reduz os custos para o negócio.-->
        </div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a class="accordion-toggle" data-toggle="collapse" data-parent="#payment" href="#collapseThree">Quem fica responsável pela divulgação?<i class="indicator icon_plus_alt2 pull-right"></i></a>
        </h4>
      </div>
      <div id="collapseThree" class="panel-collapse collapse">
             <div class="panel-body">
          O próprio estabelecimento é responsável pela divulgação, afinal, ninguém melhor que você para saber onde estão seus clientes. Mas, você pode, por exemplo, enviar o seu link público do <b><?=$texto['nome_site_landing'];?></b> por e-mail, Whatsapp e disponibilizar nas redes sociais. Além disso, criar uma lista de transmissão no Whatsapp e divulgar aos seus contatos pode ser uma ótima ideia! Estamos também preparando um blog para ajudar com dicas para seu negócio evoluir cada vez mais.
        </div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a class="accordion-toggle" data-toggle="collapse" data-parent="#payment" href="#collapsefor">Tem algum meio de pagamento integrado?<i class="indicator icon_plus_alt2 pull-right"></i></a>
        </h4>
      </div>
      <div id="collapsefor" class="panel-collapse collapse">
        <div class="panel-body">
          Por enquanto não, mas em breve teremos novidades nesse sentido. Inclusive, suas sugestões e feedbacks são muito bem vindos! Faça um comentário escrevendo para <a href="mailto:<?=$texto['emailSuporteSite'];?>"><?=$texto['emailSuporteSite'];?></a>
        </div>
      </div>
    </div>



  </div><!-- End container -->
</div><!-- End white_bg -->

<!-- Footer ================================================== -->
<footer>
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-sm-3">
       <h3>Aceitamos</h3>
       <p><img width="250px;" height="70px;" src="img/cards.png" alt="" class="img-responsive"></p>

     </div>
     <div class="col-md-3 col-sm-3">
      <h3>Sobre</h3>
      <ul>
        <li><a href="#0" data-toggle="modal" data-target="#login_2">Fazer Login</a></li>
        <!-- <li><a href="#0">Termos e condições</a></li> -->
      </ul>
    </div>
    <div class="col-md-3 col-sm-3"  id="newsletter">
      <h3>Newsletter</h3>
      <p>Fique por dentro das atualizações.</p>
      <div id="message-newsletter_2"></div>
      <form method="post" action="assets/newsletter.php" name="newsletter_2" id="newsletter_2">
        <div class="form-group">
          <input name="email_newsletter_2" id="email_newsletter_2"  type="email" value=""  placeholder="Seu E-mail" class="form-control">
        </div>
        <button type="button" class="btn_1">Me infome sobre as novidades</button>
      </form> 
    </div>

  </div><!-- End row -->
  <div class="row">
    <div class="col-md-12">
      <div id="social_footer">
        <ul>
          <li><a target="_blank" href="<?=(!empty($texto['link_do_face']) ? $texto['link_do_face'] : "");?>"><i class="icon-facebook"></i></a></li>
          <!--<li><a href="#0"><i class="icon-twitter"></i></a></li>-->
          <!--<li><a href="#0"><i class="icon-google"></i></a></li>-->
          <li><a target="_blank" href="<?=(!empty($texto['link_do_insta']) ? $texto['link_do_insta'] : "");?>"><i class="icon-instagram"></i></a></li>
          <!--<li><a href="#0"><i class="icon-pinterest"></i></a></li>-->
          <!--<li><a href="#0"><i class="icon-vimeo"></i></a></li>-->
          <li><a target="_blank" href="<?=(!empty($texto['link_do_insta']) ? $texto['link_do_insta'] : "");?>"><i class="icon-youtube-play"></i></a></li>
        </ul>
        <p>© <?=$texto['nome_site_landing'];?></p>
      </div>
    </div>
  </div><!-- End row -->
</div><!-- End container -->
</footer>
<!-- End Footer =============================================== -->

<div class="layer"></div><!-- Mobile menu overlay mask -->

<!-- Login modal -->   
<div style="margin-top: 50px;" class="modal fade" id="login_2" tabindex="-1" role="dialog" aria-labelledby="myLogin" aria-hidden="true">
  <div class="modal-dialog">
   <div method="post" class="modal-content modal-popup">
    <a style="cursor: pointer;" id="fecharmodallogin" class="close-link"><i class="icon_close_alt2"></i></a>
    <form class="popup-form" method="post" id="UsuarioLogin">
     <div class="login_icon"><i class="icon_lock_alt"></i></div>
     <input name="user" type="email" autocomplete="off" class="form-control form-white" placeholder="Login">
     <input name="pass" type="password" autocomplete="off" class="form-control form-white" placeholder="Senha">
     <div class="text-left">
      <a target="_blank" href="https://api.whatsapp.com/send?phone=<?=$texto['telefoneAdministracaoTecnica'];?>">Esqueceu a senha?</a>
    </div>
    <a id="Entraruser" class="btn btn-submit" style="text-decoration: none;">Entrar</a>
    <small style="color: #ffffff" id="resultadoLogin"></small>
  </form>
  <script type="text/javascript">
    $(document).ready(function(){
      $('#fecharmodallogin').click(function(){
        $("#login_2").modal('hide');
      });
    });
  </script>

  <script type="text/javascript">
    $(document).ready(function(){
      $('#Entraruser').click(function(){
        $('#Entraruser').prop('disabled', true);
        $('#Entraruser').html('Fazendo Login...');

        $.ajax({
          url: '<?=$site?>controlers/login_User.php',
          method: 'post',
          data: $('#UsuarioLogin').serialize(),
          success: function(data){
            $('#Entraruser').prop('disabled', false);
            $('#Entraruser').html('Entrar');
            $('#resultadoLogin').html(data);

          }


        });

      });
    });
  </script>
</div>
</div>
</div><!-- End modal -->   

<!-- COMMON SCRIPTS -->

<script src="<?=$site;?>js/common_scripts_min.js"></script>
<script src="<?=$site;?>js/functions.js"></script>
<script src="<?=$site;?>assets/validate.js"></script>
<script src="<?=$site; ?>notificacao/growl-notification.min.js"></script> 
<script src="<?=$site;?>assets/sweetalert.min.js"></script>
<script src="<?=$site;?>js/jquery.mask.js"></script>
<script src="<?=$site;?>js/suportewats.js"></script>

<script type="text/javascript">
  // LOGIN
  $(document).ready(function(){
   $("#cadastrarUser").click(function(){
    //formCadastro
    $(this).html('<i class="icon-spin5 animate-spin"></i> AGUARDE...');
    $(this).prop('disabled', true);

    $.ajax({
      url: '<?=$site;?>controlers/processaCadastroUser.php',
      method: 'post',
      data: $('#formCadastro').serialize(),
      success: function(data){
        if(data == "erro1"){
          x0p('Opsss', 
            'Preencha todos os campos!',
            'error', false);
          $('#cadastrarUser').html('Cadastrar Minha Loja');
          $('#cadastrarUser').prop('disabled', false);
        }else if(data == "erro2"){
          x0p('Opsss', 
            'O E-mail informado e inválido!',
            'error', false);
          $('#cadastrarUser').html('Cadastrar Minha Loja');
          $('#cadastrarUser').prop('disabled', false);
        }else if(data == "erro3"){
          x0p('Opsss', 
            'A senha informada deve ter no mínimo 8 caracteres!',
            'error', false);
          $('#cadastrarUser').html('Cadastrar Minha Loja');
          $('#cadastrarUser').prop('disabled', false);
        }else if(data == "erro4"){
          x0p('Opsss', 
            'As senhas não coincidem!',
            'error', false);
          $('#cadastrarUser').html('Cadastrar Minha Loja');
          $('#cadastrarUser').prop('disabled', false);
        }else if(data == "erro5"){
          x0p('Opsss', 
            'Esse link não está disponível!',
            'error', false);
          $('#cadastrarUser').html('Cadastrar Minha Loja');
          $('#cadastrarUser').prop('disabled', false);
        }else if(data == "erro6"){
          x0p('Opsss', 
            'Já existe uma conta com esses dados!',
            'error', false);
          $('#cadastrarUser').html('Cadastrar Minha Loja');
          $('#cadastrarUser').prop('disabled', false);
        }else if(data == "erro0"){
          x0p('Opsss', 
            'OCORREU UM ERRO AO CADASTRAR!',
            'error', false);
          $('#cadastrarUser').html('Cadastrar Minha Loja');
          $('#cadastrarUser').prop('disabled', false);
        }else{
         x0p('Sucesso!', 
          'Agora você pode fazer login.', 
          'ok', false);
         $('#cadastrarUser').html('Cadastrar Minha Loja');
         $('#cadastrarUser').prop('disabled', false);
       }
       
     }
   });

  }); 
 });
</script>


<script type="text/javascript">
  $(document).ready(function(){
    $('#verificarDisponibilidadeLink').click(function(){
      var linkuser = $('#nome_empresa_link').val();

      if(linkuser == ''){
        x0p('Opss...', 
          'Antes preencha o campo!',
          'error', false);
      }else{

        $.ajax({
          url: '<?=$site?>controlers/processaverificadisponibilidadelink.php',
          method: 'post',
          data: {'linkuser' : linkuser},
          success: function(data){

            if(data == 'true'){
              x0p('Que pena! 😔', 
                'Esse link não está disponível!',
                'error', false);
            }else{
              $('#nome_empresa_link').val(data);
              x0p('Muito bom! 😍', 
                '<?=$site;?>'+data+' está disponível!', 
                'ok', false);
            }          
          }
        });

      }
    });
  });
</script>



<script language="JavaScript">
  window.onload = function() {
    document.addEventListener("contextmenu", function(e){
      e.preventDefault();
    }, false);
    document.addEventListener("keydown", function(e) {
            //document.onkeydown = function(e) {
              // "I" key
              if (e.ctrlKey && e.shiftKey && e.keyCode == 73) {
                disabledEvent(e);
              }
              // "J" key
              if (e.ctrlKey && e.shiftKey && e.keyCode == 74) {
                disabledEvent(e);
              }
              // "S" key + macOS
              if (e.keyCode == 83 && (navigator.platform.match("Mac") ? e.metaKey : e.ctrlKey)) {
                disabledEvent(e);
              }
              // "U" key
              if (e.ctrlKey && e.keyCode == 85) {
                disabledEvent(e);
              }
              // "F12" key
              if (event.keyCode == 123) {
                disabledEvent(e);
              }
            }, false);
    function disabledEvent(e){
      if (e.stopPropagation){
        e.stopPropagation();
      } else if (window.event){
        window.event.cancelBubble = true;
      }
      e.preventDefault();
      return false;
    }
  };
</script>


<script type="text/javascript"> 

  $(document).ready(function () {

    $.getJSON('<?=$site;?>estados_cidades.json', function (data) {

      var items = [];
      var options = '<option value="<?=(!empty($end_uf_empresa) ? $end_uf_empresa : "");?>"><?=(!empty($end_uf_empresa) ? $end_uf_empresa : "Escolha um estado");?></option>';  

      $.each(data, function (key, val) {
        options += '<option value="' + val.sigla + '">' + val.sigla + '</option>';
      });         
      $("#estados").html(options);        

      $("#estados").change(function () {        

        var options_cidades = '<option value="<?=(!empty($cidade_empresa) ? $cidade_empresa : "");?>"><?=(!empty($cidade_empresa) ? $cidade_empresa : "Escolha uma Cidade");?></option>';
        var str = "";         

        $("#estados option:selected").each(function () {
          str += $(this).text();
        });

        $.each(data, function (key, val) {
          if(val.sigla == str) {              
            $.each(val.cidades, function (key_city, val_city) {
              options_cidades += '<option value="' + val_city + '">' + val_city + '</option>';
            });             
          }
        });

        $("#cidades").html(options_cidades);

      }).change();    

    });

  });

</script>

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
            <p>Clique em um de nossos representantes abaixo para conversar no WhatsApp ou envie um email para <?=$texto['emailSuporteSite'];?></p></div>
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
