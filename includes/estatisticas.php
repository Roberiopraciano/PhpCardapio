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

$meses = array(
  '01'=>'Janeiro',
  '02'=>'Fevereiro',
  '03'=>'Março',
  '04'=>'Abril',
  '05'=>'Maio',
  '06'=>'Junho',
  '07'=>'Julho',
  '08'=>'Agosto',
  '09'=>'Setembro',
  '10'=>'Outubro',
  '11'=>'Novembro',
  '12'=>'Dezembro'
);


$pegaMesGet = filter_input(INPUT_GET, 'm', FILTER_VALIDATE_INT);
$mesgett = '';
if(!empty($pegaMesGet) && ($pegaMesGet == '01' || $pegaMesGet == '02' || $pegaMesGet == '03' || $pegaMesGet == '04' || $pegaMesGet == '05' || $pegaMesGet == '06' || $pegaMesGet == '07' || $pegaMesGet == '08' || $pegaMesGet == '09' || $pegaMesGet == '10' || $pegaMesGet == '11' || $pegaMesGet == '12')):
  $mesgett = $pegaMesGet;
else:
 $mesgett = date('m');
endif;
?>
<div style="background-color:#ffffff;" class="container margin_60"> 

  <div class="indent_title_in">
    <i class="icon-chart-line"></i>
    <h3>Estatísticas</h3>
    <p>Gráficos com detalhes do seu negócio.</p>
  </div>
  
  <style type="text/css">
    .card-counter{
      box-shadow: 2px 2px 10px #DADADA;
      margin: 5px;
      padding: 10px 10px;
      background-color: #fff;
      height: 100px;
      border-radius: 5px;
      transition: .3s linear all;
    }

    .card-counter:hover{
      box-shadow: 4px 4px 20px #DADADA;
      transition: .3s linear all;
    }

    .card-counter.primary{
      background-color: #007bff;
      color: #FFF;
    }

    .card-counter.danger{
      background-color: #ef5350;
      color: #FFF;
    }  

    .card-counter.success{
      background-color: #66bb6a;
      color: #FFF;
    }  

    .card-counter.info{
      background-color: #f0ad4e;
      color: #FFF;
    }  

    .card-counter i{
      font-size: 5em;
      opacity: 0.2;
    }

    .card-counter .count-numbers{
      position: absolute;
      right: 35px;
      top: 20px;
      font-size: 32px;
      display: block;
    }

    .card-counter .count-name{
      position: absolute;
      right: 35px;
      top: 65px;
      font-style: italic;
      text-transform: capitalize;
      opacity: 0.5;
      display: block;
      font-size: 18px;
    }


    .cardviews{
      display: flex;
      flex-direction: column;
      background-color: #252b43;
      flex: 1;
      align-items: center;
      justify-content: space-between;
      padding: 15px 0;
      border-radius: 3px;
      position: relative;
      margin-bottom: 30px;
    }
    .card::after{
      content: "";
      border-top: 5px solid #1ba2f4;
      border-radius: 3px;
      position: absolute;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
    }
    .card__ig{
      display: flex;
      flex-direction: column;
      background-color: #252b43;
      flex: 1;
      align-items: center;
      justify-content: space-between;
      padding: 15px 0;
      border-top-left-radius: 0;
      border-top-right-radius: 0;
      border-bottom-left-radius: 3px;
      border-bottom-right-radius: 3px;
      position: relative;
      margin-bottom: 30px;
      margin-top: 5px;
    }
    .card__ig::after {
      content: "";
      border-top: none;
      border-top-left-radius: 3px;
      border-top-right-radius: 3px;
      border-bottom-left-radius: 0;
      border-bottom-right-radius: 0;
      position: absolute;
      width: 100%;
      height: 5px;
      top: 0;
      left: 0;
      background: linear-gradient(90deg,#fac06c,#db4e93);
    }
    .card__yt::after{
      position: absolute;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      border-top: 5px solid #c2042a;
    }
    .fa-facebook-official, .fa-twitter{
      color: #1ba2f4;
    }
    .fa-youtube-play{
      color: #c2042a;
    }
    .icon{
      font-size: 22px !important;
    }
    .fa-instagram{
      color: red;
      display: block;
      background: linear-gradient(0deg,#fac06c,#db4e93);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }
    .card__name{
      padding: 15px 0;
      color: #8a91bd;
      display: flex;
    }
    .card__number{
      font-size: 56px;
      font-weight: 700;
      color:#ffffff;
    }
    .card__followers{
      font-size: 12px;
      text-transform: uppercase;
      color: #8a91bd;
      letter-spacing: 5px;
    }
    .card__change{
      padding: 15px 0;
      color: #079076;
      display: flex;
    }
    span{
      margin-left: 5px;
    }
    .card__triangle-up {
      width: 0;
      height: 0;
      position: relative;
      top: 3px;
      border-right: 5px solid transparent;
      border-top: 5px solid transparent;
      border-left: 5px solid transparent;
      border-bottom: 5px solid #079076;
    }
    .card__change-down{
      padding: 15px 0;
      color: #da4e5b;
      display: flex;
    }
    .card__triangle-down {
      width: 0;
      height: 0;
      position: relative;
      top: 9px;
      border-right: 5px solid transparent;
      border-top: 5px solid #da4e5b;
      border-left: 5px solid transparent;
      border-bottom: 5px solid transparent;
    }
    .card-small{
      display: flex;
      flex-direction: row;
      flex-wrap: wrap;
      background-color: #252b43;
      flex: 1;
      align-items: stretch;
      justify-content: space-between;
      padding: 30px 30px;
      border-radius: 3px;
      position: relative;
      margin-bottom: 30px;
    }
    .card-small .card__name{
      flex:0 50%;
    }
    .card-small .fa{
      flex:0 50%;
      display: flex;
      align-items: center;
      justify-content: flex-end;
    }
    .card-small .card__number{
      flex:0 50%;
      font-size: 36px;
    }
    .card-small .card__change{
      flex:0 50%;
      position: relative;
      right: 0;
      display: flex;
      align-items: center;
      justify-content: flex-end;
    }
    .card-small .card__triangle-up {
      width: 0;
      height: 0;
      position: relative;
      top: -3px;
    }
    @media only screen and (min-width: 600px) {

      .cardviews, .card__ig, .card__yt{
        margin:15px;
        flex: 0 41% ;
      } 
      .card-small{
        margin:15px;
        flex: 0 41%;
        padding: 15px 30px;
      }
      .title, .subtitle{
        padding-left: 10px;
      }
    }
    @media only screen and (min-width: 900px) {

      .cardviews, .card__ig, .card__yt{
        margin:15px;
        flex: 0 21%;
      } 
      .card-small{
        margin:15px;
        flex: 0 21%;
        padding: 5px 15px;
      }
      .title, .subtitle{
        padding-left: 0px;
      }
    }
    @media only screen and (min-width: 1200px) {

      .cardviews, .card__ig, .card__yt{
        margin:15px;
        flex: 0 21%;
      } 
      .card-small{
        margin:15px;
        flex: 0 21%;
      }
      .title, .subtitle{
        padding-left: 20px;
      }
    }
  </style>

  <div class="box_style_2" id="help">
            <h4>COMPARTILHE SEU LINK NAS REDES SOCIAIS</h4>
            <!-- AddToAny BEGIN -->
            <div style="margin: 0 auto;align-items: center;display: flex;flex-direction: row;flex-wrap: wrap;justify-content: center;" class="a2a_kit a2a_kit_size_32 a2a_default_style" data-a2a-url="<?=$site.$nome_empresa_link;?>">        
                <a class="a2a_button_facebook"></a>
    			<a class="a2a_button_facebook_messenger"></a>
    			<a class="a2a_button_twitter"></a>
    			<a class="a2a_button_google_plus"></a>
    			<a class="a2a_button_whatsapp"></a>
                <a class="a2a_button_telegram"></a>
                <a class="a2a_button_link"></a> 
            </div>
            <script async src="https://static.addtoany.com/menu/page.js"></script>
            <!-- AddToAny END -->
          </div>

  <div class="cardviews">
    <?php
      $numerodeviews = 0;
      $lerbanco->ExeRead("views", "WHERE user_id = :userid", "userid={$userlogin['user_id']}");
      if ($lerbanco->getResult()):
        $dadosview = $lerbanco->getResult();
        $numerodeviews = $dadosview[0]['contar'];
      endif;
      ?>
    <p class="card__number"><?=$numerodeviews;?></p>
    <p style="text-align: center;" class="card__followers">Visualizações de seus Itens</p>
  </div><!-- CARD-->
  <?php
  $statusComoAberto = 'Aberto';
  $statusComoFinalizado = 'Finalizado';
  $statusComoCancelado = 'Cancelado';
  $mesAtual = date('Y-m');
  $mesPassado = Date('Y-m', strtotime("-1 months", strtotime(date('Y-m'))));
// -----------mês passado ---------------------
  $lerbanco->FullRead("SELECT SUM(total) AS valorTotalAtras FROM ws_pedidos WHERE user_id = :userid1 AND (status = :ua AND data_chart = :fa)", "userid1={$userlogin['user_id']}&ua={$statusComoFinalizado}&fa={$mesPassado}");
  if($lerbanco->getResult()):
    foreach ($lerbanco->getResult() as $r):
      extract($r);
    endforeach;  
  endif;
// -----------mês Atual ---------------------
  $lerbanco->FullRead("SELECT SUM(total) AS valorTotalAtual FROM ws_pedidos WHERE user_id = :userid2 AND (status = :ua AND data_chart = :fa)", "userid2={$userlogin['user_id']}&ua={$statusComoFinalizado}&fa={$mesAtual}");
  if($lerbanco->getResult()):
    foreach ($lerbanco->getResult() as $r):
      extract($r);
    endforeach;  
  endif;
// -----------Total Abertas ---------------------
  $lerbanco->FullRead("SELECT SUM(total) AS valorTotalAbertos FROM ws_pedidos WHERE user_id = :userid3 AND status = :ua", "userid3={$userlogin['user_id']}&ua={$statusComoAberto}");
  if($lerbanco->getResult()):
    foreach ($lerbanco->getResult() as $r):
      extract($r);
    endforeach;  
  endif;
// -----------Total Cancelados ---------------------
  $lerbanco->FullRead("SELECT SUM(total) AS valorTotalCancelados FROM ws_pedidos WHERE user_id = :userid4 AND status = :ua", "userid4={$userlogin['user_id']}&ua={$statusComoCancelado}");
  if($lerbanco->getResult()):
    foreach ($lerbanco->getResult() as $r):
      extract($r);
    endforeach;  
  endif;
  ?>



  <div class="col-md-3">
    <div class="card-counter success">
      <i class="fa fa-money" aria-hidden="true"></i>
      <span class="count-numbers">R$ <?=(!empty($valorTotalAtras) ? Check::Real($valorTotalAtras) : Check::Real(0));?></span>
      <span class="count-name">Total Mês Anterior</span>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card-counter primary">
      <i class="fa fa-money" aria-hidden="true"></i>
      <span class="count-numbers">R$ <?=(!empty($valorTotalAtual) ? Check::Real($valorTotalAtual) : Check::Real(0));?></span>
      <span class="count-name">Total Mês Atual</span>

    </div>
  </div>
  <div class="col-md-3">
    <div class="card-counter info">
      <i class="fa fa-money" aria-hidden="true"></i>
      <span class="count-numbers">R$ <?=(!empty($valorTotalAbertos) ? Check::Real($valorTotalAbertos) : Check::Real(0));?></span>
      <span class="count-name">Total Abertos</span>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card-counter danger">
      <i class="fa fa-money" aria-hidden="true"></i>
      <span class="count-numbers">R$ <?=(!empty($valorTotalCancelados) ? Check::Real($valorTotalCancelados) : Check::Real(0));?></span>
      <span class="count-name">Total Cancelados</span>
    </div>
  </div> 
  
  
  
  <hr />
  

  <style type="text/css">
    .select,
    .download-target {

    }
    .select {
      position: relative;
      display: block;
      height: 3em;
      line-height: 3;
      background: #2c3e50;
      overflow: hidden;
      border-radius: .25em;
      display: inline-block;
      display: -webkit-inline-box;
      border: 1px solid #667780;
      margin: 1em 0;
    }
    select {
      width: 100%;
      height: 100%;
      margin: 0;
      padding: 0 0 0 .5em;
      color: #fff;
      cursor: pointer;
    }
    select::-ms-expand {
      display: none;
    }
    .select::after {
      content: '\25BC';
      position: absolute;
      top: 0;
      right: 0;
      bottom: 0;
      padding: 0 1em;
      background: #34495e;
      pointer-events: none;
    }
    .select:hover::after {
      color: #f39c12;
    }
    .select::after {
      -webkit-transition: .25s all ease;
      -o-transition: .25s all ease;
      transition: .25s all ease;
    }
  </style>
  <center>
    <div id="verM"></div>    
    <form>
      <div class="dropdown">
        <select class="dropdown-select-version select" name="options">
         <option>Selecione o mês ...</option>
         <?php
         for ($i=1; $i <= 12; $i++):
          if($i < 10):
            $i = '0'.$i;
          endif;
          echo "<option value=\"{$i}\">{$meses[$i]}</option>";
        endfor;
        ?>
      </select>
      <!--       <a class="btn btn-block btn-success download-target" title="Visualizar" alt="Visualizar">Visualizar</a> -->
    </div>

  </form>

  <script type="text/javascript">
    $('.dropdown-select-version').on('change', function() {
      if (this.value == '01') {
        location.href="<?=$site.$Url[0].'/estatisticas&m=1#verM';?>";
      }else if (this.value == '02') {
       location.href="<?=$site.$Url[0].'/estatisticas&m=2#verM';?>";
     }else if (this.value == '03') {
      location.href="<?=$site.$Url[0].'/estatisticas&m=3#verM';?>";
    }else if (this.value == '04') {
     location.href="<?=$site.$Url[0].'/estatisticas&m=4#verM';?>";
   }else if (this.value == '05') {
     location.href="<?=$site.$Url[0].'/estatisticas&m=5#verM';?>";
   }else if (this.value == '06') {
     location.href="<?=$site.$Url[0].'/estatisticas&m=6#verM';?>";
   }else if (this.value == '07') {
     location.href="<?=$site.$Url[0].'/estatisticas&m=7#verM';?>";
   }else if (this.value == '08') {
     location.href="<?=$site.$Url[0].'/estatisticas&m=8#verM';?>";
   }else if (this.value == '09') {
     location.href="<?=$site.$Url[0].'/estatisticas&m=9#verM';?>";
   }else if (this.value == '10') {
     location.href="<?=$site.$Url[0].'/estatisticas&m=10#verM';?>";
   }else if (this.value == '11') {
     location.href="<?=$site.$Url[0].'/estatisticas&m=11#verM';?>";
   }else if (this.value == '12') {
     location.href="<?=$site.$Url[0].'/estatisticas&m=12#verM';?>";
   }else {
     location.href="<?=$site.$Url[0].'/estatisticas#verM';?>";      
   } 
 });
</script>
</center>

<div class="row">  
  <div class="col-lg-12">
    <div id="website-statistics1" class="widget">
      <div class="widget-header transparent">
        <?php
        $verAgoraM = $mesgett;          
        if(!empty($pegaMesGet) && $verAgoraM < 10):
          $verAgoraM = '0'.$verAgoraM;
        endif;
        ?>

        <h4><i class="icon-chart-line"></i> <strong>Resumo: <?=$meses[date($verAgoraM)].' de '.date('Y');?></strong></h4>                
      </div>
      <div class="widget-content">
        <div id="website-statistic" class="statistic-chart">    
          <div class="row stacked">
            <div class="col-sm-12">
             <div class="toolbar">
              <div class="clearfix"></div>
            </div>
            <div id="myfirstchart2" style="height: 300px;"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<hr />
<div class="row">
  <div class="col-lg-12">
    <div id="website-statistics1" class="widget">
      <div class="widget-header transparent">
        <h4><i class="icon-chart-line"></i> <strong>Statísticas -</strong> Pedidos <?= date('Y'); ?></h4>                
      </div>
      <div class="widget-content">
        <div id="website-statistic" class="statistic-chart">    
          <div class="row stacked">
            <div class="col-sm-12">
              <div class="toolbar">
                <div class="clearfix"></div>
              </div>
              <div class="clearfix"></div>
              <div id="myfirstchart" style="height: 250px;"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>


<?php
require('configchart.php');
?>
