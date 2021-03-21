<?php 
ob_start();
session_start();
require('../_app/Config.inc.php');
require('../_app/Mobile_Detect.php');
$detect = new Mobile_Detect;
$site = HOME;

$getnomeloja = $_POST['nomeloja'];

$cart = new Cart([
	//Total de item que pode ser adicionado ao carrinho 0 = Ilimitado
	'cartMaxItem' => 0,

	// A quantidade máxima de um item que pode ser adicionada ao carrinho, 0 = Ilimitado
	'itemMaxQuantity' => 0,

	// Não usar cookies, os itens do carrinho desaparecerão depois que o navegador for fechado
	'useCookie' => false,
]);

// adiciona ao carrinho:
if(isset($_POST['add-Item']) && $_POST['add-Item'] == 'true'):
	if($_POST['quantidade'] < 1):
		$text_erro0 ="A quantidade escolhida e inválida!";
		echo '<script type="text/javascript">alert("'.$text_erro0.'")</script>'; 			
	elseif(!isset($_POST['valor']) || empty($_POST['valor'])): 
		echo "<script>
	x0p('Opss...', 
	'Escolha uma opção!',
	'error', false);

	var sound = new Howl({
		src: ['{$site}ops.mp3'],
		volume: 1.0,
		autoplay: true,
		});
		sound.play();

		$(\"#popuppedido_{$_POST['id-item']}\").modal('hide');
		</script>";		
	else:
		$lerbanco->ExeRead('ws_itens', "where user_id = :userid", "userid={$_POST['userid']}");

		foreach ($lerbanco->getResult() as $product):
			extract($product);
			if ($_POST['id-item'] == $id) {
				break;
			}
		endforeach;

		//----------------------------------------------------------------------
		$valorfinalsabores = 0;
		$nomesfinalsabores = "";
		if(!empty($_POST['sabormeioameio']) && !empty($_POST['meio_a_meio_tipo']) && $_POST['meio_a_meio_tipo'] == 1):
	
			$adicioaisEsplode = array();
			for($i=0; $i < count($_POST['sabormeioameio']); $i++):
				$adicioaisEsplode[$i] = explode("-_-", $_POST['sabormeioameio'][$i]);
				$valorsabores[$i] =  $adicioaisEsplode[$i][1];
				$nomesabores[$i] =  $adicioaisEsplode[$i][0];
			endfor;

			$maiorvalor = max($valorsabores);

			$valorfinalsabores = (!empty($maiorvalor) ? $maiorvalor : 0);
			$nomesfinalsabores = implode(" + ", $nomesabores);
			$nomesfinalsabores = $nomesfinalsabores;

		elseif(!empty($_POST['sabormeioameio']) && !empty($_POST['meio_a_meio_tipo']) && $_POST['meio_a_meio_tipo'] == 2):

			$adicioaisEsplode = array();
			for($i=0; $i < count($_POST['sabormeioameio']); $i++):
				$adicioaisEsplode[$i] = explode("-_-", $_POST['sabormeioameio'][$i]);
				$valorsabores[$i] =  $adicioaisEsplode[$i][1];
				$nomesabores[$i] =  $adicioaisEsplode[$i][0];
			endfor;

			$nomesfinalsabores = implode(" + ", $nomesabores);
			$nomesfinalsabores = $nomesfinalsabores;

		endif;

//-----------------------------------------------------------------------



		$ifcondicaotamanhos = '';
		if(strpos($_POST['valor'], '-_-')):
			$ifcondicaotamanhos = explode('-_-', $_POST['valor']);
			$_POST['valor'] = ($ifcondicaotamanhos[1] < $valorfinalsabores ? $valorfinalsabores : $ifcondicaotamanhos[1]);
			$_POST['nome_item'] = (!empty($nomesfinalsabores) ? $nomesfinalsabores : $_POST['nome_item']).' >> '.$ifcondicaotamanhos[0];
		endif;



		$detalhes_pedido = array(
			'preco'  => $_POST['valor'],
			'nome'  => $_POST['nome_item'],  
			'observacao'  => (!empty($_POST['observacao']) ? $_POST['observacao'] : 'Não'),  
		);


	// começa verificação dos adicionais para incluir no carrinho!!!

		if(!empty($_POST['adicional'])):
			$detalhes_pedido['totalAdicionais'] = count($_POST['adicional']);


			$meioaMeioexplode = array();
			for ($i=0; $i < count($_POST['adicional']); $i++):
				$meioaMeioexplode[$i] = explode("-_-", $_POST['adicional'][$i]);
				$detalhes_pedido['adicional_valor'.$i] =  $meioaMeioexplode[$i][1];
				$detalhes_pedido['adicional_nome'.$i] =  $meioaMeioexplode[$i][0];
			endfor;
		endif;

	//adiciona ao carrinho o pedido!
		$cart->add($_POST['id-item'], $_POST['quantidade'], $detalhes_pedido);


		echo "<script>
		x0p('Sucesso!', 
		'Seu Pedido foi Adicionado!', 
		'ok', false);

		var sound = new Howl({
			src: ['{$site}addcarrinho.mp3'],
			volume: 1.0,
			autoplay: true,
			});
			sound.play();
			$(\"#popuppedido_{$_POST['id-item']}\").modal('hide');
			$(\".obsitem\").val(\"\");
			$('#sidebar').load('{$site}includes/sidebar.php', {'getloja': '{$getnomeloja}'});
			</script>";


		endif;
		
	endif;

	ob_end_flush();
