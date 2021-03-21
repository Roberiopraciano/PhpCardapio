<?php
ob_start();
session_start();
require('../_app/Config.inc.php');
require('../_app/Mobile_Detect.php');
$site = HOME;

$getdadosGetOptions = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$lerbanco->ExeRead("ws_opcoes_itens", "WHERE id_option = :idoption AND user_id = :userid", "idoption={$getdadosGetOptions['idoption']}&userid={$getdadosGetOptions['userid']}");
if($lerbanco->getResult()):
	$resultadodapesquisaarray = $lerbanco->getResult();



if($resultadodapesquisaarray[0]['meio_a_meio'] == 'true' && $resultadodapesquisaarray[0]['total_qtd_itens'] != 'null'):


$lerbanco->ExeRead('ws_itens', "WHERE user_id = :useridrr AND id_cat = :nnnn", "useridrr={$getdadosGetOptions['userid']}&nnnn={$getdadosGetOptions['idcat']}");

if($lerbanco->getResult()):

	$valorumjaadicionado = $resultadodapesquisaarray[0]['total_qtd_itens'];

	echo "<script type='text/javascript'>
		var vdataiditem = {$getdadosGetOptions['iditem']};
					var maximopermitido = {$valorumjaadicionado};


					if({$valorumjaadicionado} > 0){
						$('#valortotalint_'+vdataiditem).text(maximopermitido);
						$(\"#mostrarmeioameio_\"+vdataiditem).show();
						
						$('#cf_group_meioameio'+vdataiditem+' input[type=checkbox]').click(function(){
							
							var controle = $('#cf_group_meioameio' + vdataiditem + ' input[type=checkbox]:checked').length;
							
							
							if(controle > maximopermitido){
								$(this).prop('checked', '');
								$(this).addClass(\"tremer\");
								$('.hcinco').addClass(\"tremer\");

								setTimeout(function() {
									$('input[type=checkbox]').removeClass(\"tremer\");
									$('.hcinco').removeClass(\"tremer\");
								}, 1000);

							}

						});		

					}else{
						$(\"#mostrarmeioameio_\"+vdataiditem).hide();
					}
</script>";

else:
	echo 0;


endif;


	endif;
endif;
?>



<?php
ob_end_flush();
?>