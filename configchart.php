<?php
$ano = Date('Y');
$mesum = Date('Y-01');
$mesdois = Date('Y-m', strtotime("+1 months", strtotime("{$ano}-01")));
$mestres = Date('Y-m', strtotime("+2 months", strtotime("{$ano}-01")));
$mesquatro = Date('Y-m', strtotime("+3 months", strtotime("{$ano}-01")));
$mescinco = Date('Y-m', strtotime("+4 months", strtotime("{$ano}-01")));
$messeis = Date('Y-m', strtotime("+5 months", strtotime("{$ano}-01")));
$messete = Date('Y-m', strtotime("+6 months", strtotime("{$ano}-01")));
$mesoito = Date('Y-m', strtotime("+7 months", strtotime("{$ano}-01")));
$mesnove = Date('Y-m', strtotime("+8 months", strtotime("{$ano}-01")));
$mesdez = Date('Y-m', strtotime("+9 months", strtotime("{$ano}-01")));
$mesonze = Date('Y-m', strtotime("+10 months", strtotime("{$ano}-01")));
$mesdoze = Date('Y-m', strtotime("+11 months", strtotime("{$ano}-01")));

$sAberto = 'Aberto';
$sFinalizado = 'Finalizado';
$sCancelado = 'Cancelado';



//######## - PRIMEIRO MES DO ANO - ###########################################################################################
$lerbanco->ExeRead("ws_pedidos", "WHERE user_id = :useid AND (status = :b AND data_chart = :v)", "useid={$userlogin['user_id']}&b={$sAberto}&v={$mesum}");
if ($lerbanco->getResult()):
  $abS1 = $lerbanco->getRowCount();
endif;
$lerbanco->ExeRead("ws_pedidos", "WHERE user_id = :useid AND (status = :b AND data_chart = :v)", "useid={$userlogin['user_id']}&b={$sFinalizado}&v={$mesum}");
if ($lerbanco->getResult()):
  $feS1 = $lerbanco->getRowCount();
endif;
$lerbanco->ExeRead("ws_pedidos", "WHERE user_id = :useid AND (status = :b AND data_chart = :v)", "useid={$userlogin['user_id']}&b={$sCancelado}&v={$mesum}");
if ($lerbanco->getResult()):
  $caS1 = $lerbanco->getRowCount();
endif;
//######## - SEGUNDO MES DO ANO - ###########################################################################################
$lerbanco->ExeRead("ws_pedidos", "WHERE user_id = :useid AND (status = :b AND data_chart = :v)", "useid={$userlogin['user_id']}&b={$sAberto}&v={$mesdois}");
if ($lerbanco->getResult()):
  $abS2 = $lerbanco->getRowCount();
endif;
$lerbanco->ExeRead("ws_pedidos", "WHERE user_id = :useid AND (status = :b AND data_chart = :v)", "useid={$userlogin['user_id']}&b={$sFinalizado}&v={$mesdois}");
if ($lerbanco->getResult()):
  $feS2 = $lerbanco->getRowCount();
endif;
$lerbanco->ExeRead("ws_pedidos", "WHERE user_id = :useid AND (status = :b AND data_chart = :v)", "useid={$userlogin['user_id']}&b={$sCancelado}&v={$mesdois}");
if ($lerbanco->getResult()):
  $caS2 = $lerbanco->getRowCount();
endif;
//######## - TERCEIRO MES DO ANO - ###########################################################################################
$lerbanco->ExeRead("ws_pedidos", "WHERE user_id = :useid AND (status = :b AND data_chart = :v)", "useid={$userlogin['user_id']}&b={$sAberto}&v={$mestres}");
if ($lerbanco->getResult()):
  $abS3 = $lerbanco->getRowCount();
endif;
$lerbanco->ExeRead("ws_pedidos", "WHERE user_id = :useid AND (status = :b AND data_chart = :v)", "useid={$userlogin['user_id']}&b={$sFinalizado}&v={$mestres}");
if ($lerbanco->getResult()):
  $feS3 = $lerbanco->getRowCount();
endif;
$lerbanco->ExeRead("ws_pedidos", "WHERE user_id = :useid AND (status = :b AND data_chart = :v)", "useid={$userlogin['user_id']}&b={$sCancelado}&v={$mestres}");
if ($lerbanco->getResult()):
  $caS3 = $lerbanco->getRowCount();
endif;
//######## - QUARTO MES DO ANO - ###########################################################################################
$lerbanco->ExeRead("ws_pedidos", "WHERE user_id = :useid AND (status = :b AND data_chart = :v)", "useid={$userlogin['user_id']}&b={$sAberto}&v={$mesquatro}");
if ($lerbanco->getResult()):
  $abS4 = $lerbanco->getRowCount();
endif;
$lerbanco->ExeRead("ws_pedidos", "WHERE user_id = :useid AND (status = :b AND data_chart = :v)", "useid={$userlogin['user_id']}&b={$sFinalizado}&v={$mesquatro}");
if ($lerbanco->getResult()):
  $feS4 = $lerbanco->getRowCount();
endif;
$lerbanco->ExeRead("ws_pedidos", "WHERE user_id = :useid AND (status = :b AND data_chart = :v)", "useid={$userlogin['user_id']}&b={$sCancelado}&v={$mesquatro}");
if ($lerbanco->getResult()):
  $caS4 = $lerbanco->getRowCount();
endif;
//######## - QUINTO MES DO ANO - ###########################################################################################
$lerbanco->ExeRead("ws_pedidos", "WHERE user_id = :useid AND (status = :b AND data_chart = :v)", "useid={$userlogin['user_id']}&b={$sAberto}&v={$mescinco}");
if ($lerbanco->getResult()):
  $abS5 = $lerbanco->getRowCount();
endif;
$lerbanco->ExeRead("ws_pedidos", "WHERE user_id = :useid AND (status = :b AND data_chart = :v)", "useid={$userlogin['user_id']}&b={$sFinalizado}&v={$mescinco}");
if ($lerbanco->getResult()):
  $feS5 = $lerbanco->getRowCount();
endif;
$lerbanco->ExeRead("ws_pedidos", "WHERE user_id = :useid AND (status = :b AND data_chart = :v)", "useid={$userlogin['user_id']}&b={$sCancelado}&v={$mescinco}");
if ($lerbanco->getResult()):
  $caS5 = $lerbanco->getRowCount();
endif;
//######## - SEXTO MES DO ANO - ###########################################################################################
$lerbanco->ExeRead("ws_pedidos", "WHERE user_id = :useid AND (status = :b AND data_chart = :v)", "useid={$userlogin['user_id']}&b={$sAberto}&v={$messeis}");
if ($lerbanco->getResult()):
  $abS6 = $lerbanco->getRowCount();
endif;
$lerbanco->ExeRead("ws_pedidos", "WHERE user_id = :useid AND (status = :b AND data_chart = :v)", "useid={$userlogin['user_id']}&b={$sFinalizado}&v={$messeis}");
if ($lerbanco->getResult()):
  $feS6 = $lerbanco->getRowCount();
endif;
$lerbanco->ExeRead("ws_pedidos", "WHERE user_id = :useid AND (status = :b AND data_chart = :v)", "useid={$userlogin['user_id']}&b={$sCancelado}&v={$messeis}");
if ($lerbanco->getResult()):
  $caS6 = $lerbanco->getRowCount();
endif;
//######## - SETIMO MES DO ANO - ###########################################################################################
$lerbanco->ExeRead("ws_pedidos", "WHERE user_id = :useid AND (status = :b AND data_chart = :v)", "useid={$userlogin['user_id']}&b={$sAberto}&v={$messete}");
if ($lerbanco->getResult()):
  $abS7 = $lerbanco->getRowCount();
endif;
$lerbanco->ExeRead("ws_pedidos", "WHERE user_id = :useid AND (status = :b AND data_chart = :v)", "useid={$userlogin['user_id']}&b={$sFinalizado}&v={$messete}");
if ($lerbanco->getResult()):
  $feS7 = $lerbanco->getRowCount();
endif;
$lerbanco->ExeRead("ws_pedidos", "WHERE user_id = :useid AND (status = :b AND data_chart = :v)", "useid={$userlogin['user_id']}&b={$sCancelado}&v={$messete}");
if ($lerbanco->getResult()):
  $caS7 = $lerbanco->getRowCount();
endif;
//######## - OITAVO MES DO ANO - ###########################################################################################
$lerbanco->ExeRead("ws_pedidos", "WHERE user_id = :useid AND (status = :b AND data_chart = :v)", "useid={$userlogin['user_id']}&b={$sAberto}&v={$mesoito}");
if ($lerbanco->getResult()):
  $abS8 = $lerbanco->getRowCount();
endif;
$lerbanco->ExeRead("ws_pedidos", "WHERE user_id = :useid AND (status = :b AND data_chart = :v)", "useid={$userlogin['user_id']}&b={$sFinalizado}&v={$mesoito}");
if ($lerbanco->getResult()):
  $feS8 = $lerbanco->getRowCount();
endif;
$lerbanco->ExeRead("ws_pedidos", "WHERE user_id = :useid AND (status = :b AND data_chart = :v)", "useid={$userlogin['user_id']}&b={$sCancelado}&v={$mesoito}");
if ($lerbanco->getResult()):
  $caS8 = $lerbanco->getRowCount();
endif;
//######## - NONO MES DO ANO - ###########################################################################################
$lerbanco->ExeRead("ws_pedidos", "WHERE user_id = :useid AND (status = :b AND data_chart = :v)", "useid={$userlogin['user_id']}&b={$sAberto}&v={$mesnove}");
if ($lerbanco->getResult()):
  $abS9 = $lerbanco->getRowCount();
endif;
$lerbanco->ExeRead("ws_pedidos", "WHERE user_id = :useid AND (status = :b AND data_chart = :v)", "useid={$userlogin['user_id']}&b={$sFinalizado}&v={$mesnove}");
if ($lerbanco->getResult()):
  $feS9 = $lerbanco->getRowCount();
endif;
$lerbanco->ExeRead("ws_pedidos", "WHERE user_id = :useid AND (status = :b AND data_chart = :v)", "useid={$userlogin['user_id']}&b={$sCancelado}&v={$mesnove}");
if ($lerbanco->getResult()):
  $caS9 = $lerbanco->getRowCount();
endif;
//######## - DÉCIMO MES DO ANO - ###########################################################################################
$lerbanco->ExeRead("ws_pedidos", "WHERE user_id = :useid AND (status = :b AND data_chart = :v)", "useid={$userlogin['user_id']}&b={$sAberto}&v={$mesdez}");
if ($lerbanco->getResult()):
  $abS10 = $lerbanco->getRowCount();
endif;
$lerbanco->ExeRead("ws_pedidos", "WHERE user_id = :useid AND (status = :b AND data_chart = :v)", "useid={$userlogin['user_id']}&b={$sFinalizado}&v={$mesdez}");
if ($lerbanco->getResult()):
  $feS10 = $lerbanco->getRowCount();
endif;
$lerbanco->ExeRead("ws_pedidos", "WHERE user_id = :useid AND (status = :b AND data_chart = :v)", "useid={$userlogin['user_id']}&b={$sCancelado}&v={$mesdez}");
if ($lerbanco->getResult()):
  $caS10 = $lerbanco->getRowCount();
endif;
//######## - DÉCIMO PRIMEIRO MES DO ANO - ###########################################################################################
$lerbanco->ExeRead("ws_pedidos", "WHERE user_id = :useid AND (status = :b AND data_chart = :v)", "useid={$userlogin['user_id']}&b={$sAberto}&v={$mesonze}");
if ($lerbanco->getResult()):
  $abS11 = $lerbanco->getRowCount();
endif;
$lerbanco->ExeRead("ws_pedidos", "WHERE user_id = :useid AND (status = :b AND data_chart = :v)", "useid={$userlogin['user_id']}&b={$sFinalizado}&v={$mesonze}");
if ($lerbanco->getResult()):
  $feS11 = $lerbanco->getRowCount();
endif;
$lerbanco->ExeRead("ws_pedidos", "WHERE user_id = :useid AND (status = :b AND data_chart = :v)", "useid={$userlogin['user_id']}&b={$sCancelado}&v={$mesonze}");
if ($lerbanco->getResult()):
  $caS11 = $lerbanco->getRowCount();
endif;
//######## - DÉCIMO SEGUNDO MES DO ANO - ###########################################################################################
$lerbanco->ExeRead("ws_pedidos", "WHERE user_id = :useid AND (status = :b AND data_chart = :v)", "useid={$userlogin['user_id']}&b={$sAberto}&v={$mesdoze}");
if ($lerbanco->getResult()):
  $abS12 = $lerbanco->getRowCount();
endif;
$lerbanco->ExeRead("ws_pedidos", "WHERE user_id = :useid AND (status = :b AND data_chart = :v)", "useid={$userlogin['user_id']}&b={$sFinalizado}&v={$mesdoze}");
if ($lerbanco->getResult()):
  $feS12 = $lerbanco->getRowCount();
endif;
$lerbanco->ExeRead("ws_pedidos", "WHERE user_id = :useid AND (status = :b AND data_chart = :v)", "useid={$userlogin['user_id']}&b={$sCancelado}&v={$mesdoze}");
if ($lerbanco->getResult()):
  $caS12 = $lerbanco->getRowCount();
endif;

?>
<script type="text/javascript">

 new Morris.Line({
  // ID of the element in which to draw the chart.
  element: 'myfirstchart',
  // Chart data records -- each entry in this array corresponds to a point on
  // the chart.
  data: [
  { "period": "<?php echo $mesum; ?>", "a": <?php echo (!empty($abS1) ? $abS1 : 0); ?>, "f": <?php echo (!empty($feS1) ? $feS1 : 0); ?>, "c": <?php echo (!empty($caS1) ? $caS1 : 0); ?>},
  { "period": "<?php echo $mesdois; ?>", "a": <?php echo (!empty($abS2) ? $abS2 : 0); ?>, "f": <?php echo (!empty($feS2) ? $feS2 : 0); ?>, "c": <?php echo (!empty($caS2) ? $caS2 : 0); ?>},
  { "period": "<?php echo $mestres; ?>", "a": <?php echo (!empty($abS3) ? $abS3 : 0); ?>, "f": <?php echo (!empty($feS3) ? $feS3 : 0); ?>, "c": <?php echo (!empty($caS3) ? $caS3 : 0); ?>},
  { "period": "<?php echo $mesquatro; ?>", "a": <?php echo (!empty($abS4) ? $abS4 : 0); ?>, "f": <?php echo (!empty($feS4) ? $feS4 : 0); ?>, "c": <?php echo (!empty($caS4) ? $caS4 : 0); ?>},
  { "period": "<?php echo $mescinco; ?>", "a": <?php echo (!empty($abS5) ? $abS5 : 0); ?>, "f": <?php echo (!empty($feS5) ? $feS5 : 0); ?>, "c": <?php echo (!empty($caS5) ? $caS5 : 0); ?>},
  { "period": "<?php echo $messeis; ?>", "a": <?php echo (!empty($abS6) ? $abS6 : 0); ?>, "f": <?php echo (!empty($feS6) ? $feS6 : 0); ?>, "c": <?php echo (!empty($caS6) ? $caS6 : 0); ?>},
  { "period": "<?php echo $messete; ?>", "a": <?php echo (!empty($abS7) ? $abS7 : 0); ?>, "f": <?php echo (!empty($feS7) ? $feS7 : 0); ?>, "c": <?php echo (!empty($caS7) ? $caS7 : 0); ?>},
  { "period": "<?php echo $mesoito; ?>", "a": <?php echo (!empty($abS8) ? $abS8 : 0); ?>, "f": <?php echo (!empty($feS8) ? $feS8 : 0); ?>, "c": <?php echo (!empty($caS8) ? $caS8 : 0); ?>},
  { "period": "<?php echo $mesnove; ?>", "a": <?php echo (!empty($abS9) ? $abS9 : 0); ?>, "f": <?php echo (!empty($feS9) ? $feS9 : 0); ?>, "c": <?php echo (!empty($caS9) ? $caS9 : 0); ?>},
  { "period": "<?php echo $mesdez; ?>", "a": <?php echo (!empty($abS10) ? $abS10 : 0); ?>, "f": <?php echo (!empty($feS10) ? $feS10 : 0); ?>, "c": <?php echo (!empty($caS10) ? $caS10 : 0); ?>},
  { "period": "<?php echo $mesonze; ?>", "a": <?php echo (!empty($abS11) ? $abS11 : 0); ?>, "f": <?php echo (!empty($feS11) ? $feS11 : 0); ?>, "c": <?php echo (!empty($caS11) ? $caS11 : 0); ?>},
  { "period": "<?php echo $mesdoze; ?>", "a": <?php echo (!empty($abS12) ? $abS12 : 0); ?>, "f": <?php echo (!empty($feS12) ? $feS12 : 0); ?>, "c": <?php echo (!empty($caS12) ? $caS12 : 0); ?>},

  ],
  // The name of the data record attribute that contains x-values.
  xkey: 'period',
  // A list of names of data record attributes that contain y-values.
  ykeys: ['a', 'f', 'c'],
  // Labels for the ykeys -- will be displayed when you hover over the
  // chart.
  labels: ['Abertos', 'Finalizados', 'Cancelados'],
  redraw: true,
  padding: 20,
  behaveLikeLine: true,
  gridEnabled: false,
  gridLineColor: '#dddddd',
  axes: true,
  resize: true,
  smooth: false,
  pointSize: 3,
  lineWidth: 2,
  fillOpacity: 0.85,
  hideHover: 'auto',
  resize: true,
  lineColors: ['#f0ad4e', '#5cb85c', '#c40f09'],
});
</script>

<?php
$colocarM = (!empty($pegaMesGet) && ($pegaMesGet == '01' || $pegaMesGet == '02' || $pegaMesGet == '03' || $pegaMesGet == '04' || $pegaMesGet == '05' || $pegaMesGet == '06' || $pegaMesGet == '07' || $pegaMesGet == '08' || $pegaMesGet == '09' || $pegaMesGet == '10' || $pegaMesGet == '11' || $pegaMesGet == '12') ? $mesgett : date('m'));

$TotalDiasMesAtual = cal_days_in_month(CAL_GREGORIAN, date($colocarM), date('Y'));
$anoEmes = date('Y').'-'.$colocarM;
$dias = "";

for ($i=1; $i <= $TotalDiasMesAtual; $i++):
  $vDosDias = $anoEmes.'-'.$i;

  $lerbanco->FullRead("SELECT SUM(total) AS vTotal FROM ws_pedidos WHERE user_id = :userid AND (status = :uaa AND data_chart2 = :faa)", "userid={$userlogin['user_id']}&uaa={$sFinalizado}&faa={$vDosDias}");
  if ($lerbanco->getResult()):
    foreach ($lerbanco->getResult() as $r):
      extract($r);
    endforeach;     
  endif;

  $lerbanco->FullRead("SELECT SUM(total) AS vTotal2 FROM ws_pedidos WHERE user_id = :userid AND (status = :uaa AND data_chart2 = :faa)", "userid={$userlogin['user_id']}&uaa={$sAberto}&faa={$vDosDias}");
  if ($lerbanco->getResult()):
    foreach ($lerbanco->getResult() as $r):
      extract($r);
    endforeach;     
  endif;

  $lerbanco->FullRead("SELECT SUM(total) AS vTotal3 FROM ws_pedidos WHERE user_id = :userid AND (status = :uaa AND data_chart2 = :faa)", "userid={$userlogin['user_id']}&uaa={$sCancelado}&faa={$vDosDias}");
  if ($lerbanco->getResult()):
    foreach ($lerbanco->getResult() as $r):
      extract($r);
    endforeach;     
  endif;

  $valorrTD = (!empty($vTotal) && $vTotal != "0.00" ? $vTotal : '0');
  $valorrTD2 = (!empty($vTotal2) && $vTotal2 != "0.00" ? $vTotal2 : '0');
  $valorrTD3 = (!empty($vTotal3) && $vTotal3 != "0.00" ? $vTotal3 : '0');

  $dias = $dias . " { \"period\": \"{$vDosDias}\", \"a\": {$valorrTD}, \"b\": {$valorrTD2}, \"c\": {$valorrTD3}},";
endfor;
?>
<script type="text/javascript">

 new Morris.Area({
  // ID of the element in which to draw the chart.
  element: 'myfirstchart2',
  // Chart data records -- each entry in this array corresponds to a point on
  // the chart.
  data: [
  <?=$dias;?>    
  ],
  // The name of the data record attribute that contains x-values.
  xkey: 'period',
  // A list of names of data record attributes that contain y-values.
  ykeys: ['a', 'b', 'c'],
  // Labels for the ykeys -- will be displayed when you hover over the
  // chart.
  labels: ['Total Finalizados R$', 'Total Abertos R$', 'Total Cancelados R$'],
  redraw: true,
  padding: 20,
  behaveLikeLine: true,
  gridEnabled: false,
  gridLineColor: '#dddddd',
  axes: true,
  resize: true,
  smooth: false,
  pointSize: 3,
  lineWidth: 2,
  fillOpacity: 0.85,
  hideHover: 'auto',
  resize: true,
  lineColors: ['#007bff', '#f0ad4e', '#ef4540'],
});
</script>