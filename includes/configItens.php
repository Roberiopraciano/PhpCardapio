<?php
$inputDadosItem = filter_input_array(INPUT_POST, FILTER_DEFAULT);


if(!empty($inputDadosItem['add_item'])): //INICIO DO PRIMEIRO IF / ELSE
unset($inputDadosItem['add_item']);

// INICIO DA VALIDAÇÃO DA IMAGEM ITEM:
if (isset($_FILES['img_item']['tmp_name']) && $_FILES['img_item']['tmp_name'] != ""):
    $inputDadosItem['img_item'] = $_FILES['img_item'];
else:
    $inputDadosItem['img_item'] = '';
endif;

if(!empty($inputDadosItem['img_item'])):                        
    $upload = new Upload("uploads/");
    $upload->Image($inputDadosItem['img_item']);

    if(isset($upload) && $upload->getResult()):
        $inputDadosItem['img_item'] = $upload->getResult();
elseif(is_array($inputDadosItem['img_item'])):
    $inputDadosItem['img_item'] = 'null';
endif;                    
endif;

// FINAL DA VALIDAÇÃO DA IMAGEM ITEM:


$inputDadosItem['nome_item'] = strip_tags(trim($inputDadosItem['nome_item']));
$inputDadosItem['preco_item'] = strip_tags(trim($inputDadosItem['preco_item']));
$inputDadosItem['descricao_item'] = strip_tags(trim($inputDadosItem['descricao_item']));


$inputDadosItem['dia_semana'] = (!empty($inputDadosItem['dia_semana']) ? implode(",", $inputDadosItem['dia_semana'])  : "null");




if(empty($inputDadosItem['id_cat']) || empty($inputDadosItem['nome_item']) || empty($inputDadosItem['preco_item']) || empty($inputDadosItem['descricao_item'])):
    echo "<div class=\"alert alert-info alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
Preencha os campos obrigatórios!
</div>";
elseif($inputDadosItem['img_item'] == 'null'):
    echo "<div class=\"alert alert-info alert-dismissable\">
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
    Formato de imagem não suportado!
    </div>";
else:

    if($inputDadosItem['img_item'] == ''):
        $inputDadosItem['img_item'] = 'false';
    endif;


    $inputDadosItem['preco_item'] = Check::Valor($inputDadosItem['preco_item']);

    if(!empty($inputDadosItem['id_tipo']) && !empty($inputDadosItem['tamanhos'])):
        $narray = array();

    $narray['id_tipo'] = $inputDadosItem['id_tipo'];
    unset($inputDadosItem['id_tipo']);


    $narray['id_tamanho'] = $inputDadosItem['tamanhos'];
    unset($inputDadosItem['tamanhos']);


    $narray['id_tamanho'] = implode(',', $narray['id_tamanho']); 
    $narray['id_user'] = $inputDadosItem['user_id']; 


else:
    unset($inputDadosItem['id_tipo']);
    if(isset($inputDadosItem['tamanhos'])): unset($inputDadosItem['tamanhos']); endif;
endif;


$addbanco->ExeCreate("ws_itens", $inputDadosItem);
if ($addbanco->getResult()):                                                
    echo "<div class=\"alert alert-success alert-dismissable\">
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
    <b class=\"alert-link\">SUCESSO!</b> Item Adicionado ao Menu.
    </div>";

    if(!empty($narray)):
        $narray['id_item'] = $addbanco->getResult();
        $addbanco->ExeCreate("ws_relacao_tamanho", $narray);
    endif;

    unset($_POST); 
    header("Refresh: 3; url={$site}{$Url[0]}/itens");      
else:
    echo "<div class=\"alert alert-danger alert-dismissable\">
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
    <b class=\"alert-link\">OCORREU UM ERRO!</b> Tente novamente.
    </div>";  
    unset($_POST); 
    header("Refresh: 3; url={$site}{$Url[0]}/itens");        
endif;

endif; 

endif;//FINAL DO PRIMEIRO IF / ELSE
?>