<?php 
ob_start();
session_start();
require('../_app/Config.inc.php');
require('../_app/Mobile_Detect.php');
$detect = new Mobile_Detect;
$site = HOME;
?>


<style type="text/css">
	.btnbackgroundcolor{
		background-color: #EC008C;
		font-weight: bold;
		color: #ffffff;
		border-color:  #EC008C;
	}
</style>
<?php
$lerbanco->FullRead("SELECT * FROM ws_tipo_produto WHERE user_tipo_produto = :userid ORDER BY id_tipo_produto DESC", "userid={$_POST['user_id']}");
if($lerbanco->getResult()):				

	foreach ($lerbanco->getResult() as $extrairtipos):
		extract($extrairtipos);
		echo "<button id=\"botao_{$id_tipo_produto}\" data-idtipo=\"{$id_tipo_produto}\" class=\"btn btn-dark btn-xs btngettipo\">{$nome_tipo_produto}</button>&nbsp;&nbsp;";
	endforeach;
endif;
?>

<script type="text/javascript">
	$(document).ready(function(){
		$('.btngettipo').click(function(){
			$('.btngettipo').removeClass('btnbackgroundcolor');
			var getidtipo = $(this).data('idtipo');
			$(this).prop('disabled', true);

			$.ajax({
				url: '<?=$site?>includes/loadtamanhos.php',
				method: 'post',
				data: {'user_id' : '<?=$_POST['user_id'];?>', 'tipo_id' : getidtipo},
				success: function(data){								
					$('.table-responsive').html(data);
					$('.btngettipo').prop('disabled', false);
					$('#botao_' + getidtipo).addClass('btnbackgroundcolor');
				}
			});

		});
	});
</script>
<?php
ob_end_flush();
?>