<?php
$inputDadosItem = filter_input_array(INPUT_POST, FILTER_DEFAULT);


if(!empty($inputDadosItem['atualizar_item'])): //INICIO DO PRIMEIRO IF / ELSE
unset($inputDadosItem['atualizar_item']);



// INICIO DA VALIDAÇÃO DA IMAGEM ITEM:
if (isset($_FILES['img_item']['tmp_name']) && $_FILES['img_item']['tmp_name'] != ""):
    $inputDadosItem['img_item'] = $_FILES['img_item'];
else:
    $inputDadosItem['img_item'] = '';
    unset($inputDadosItem['img_item']);     
endif;

if(!empty($inputDadosItem['img_item'])):                        
    $upload = new Upload("uploads/");
    $upload->Image($inputDadosItem['img_item']);

    if(isset($upload) && $upload->getResult()):
        $inputDadosItem['img_item'] = $upload->getResult();
    if(!empty($inputDadosItem['img_item']) && !empty($img_item) && file_exists("uploads/{$img_item}") && !is_dir("uploads/{$img_item}")):
        unlink("uploads/{$img_item}");
endif;
elseif(is_array($inputDadosItem['img_item'])):
    $inputDadosItem['img_item'] = 'null';
endif; 
else:                  
endif;

// FINAL DA VALIDAÇÃO DA IMAGEM ITEM:


$inputDadosItem['nome_item'] = strip_tags(trim($inputDadosItem['nome_item']));
$inputDadosItem['preco_item'] = strip_tags(trim($inputDadosItem['preco_item']));
$inputDadosItem['descricao_item'] = strip_tags(trim($inputDadosItem['descricao_item']));
$inputDadosItem['dia_semana'] = strip_tags(trim($inputDadosItem['dia_semana']));

$inputDadosItem['dia_semana'] = (!empty($inputDadosItem['dia_semana']) ? $inputDadosItem['dia_semana'] : 'null');




if(empty($inputDadosItem['id_cat']) || empty($inputDadosItem['nome_item']) || empty($inputDadosItem['preco_item']) || empty($inputDadosItem['descricao_item'])):
    echo "<div class=\"alert alert-info alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
Preencha os campos obrigatórios!
</div>";
elseif(!empty($inputDadosItem['img_item']) && $inputDadosItem['img_item'] == 'null'):
    echo "<div class=\"alert alert-info alert-dismissable\">
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
    Formato de imagem não suportado!
    </div>";
else:

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




$updatebanco->ExeUpdate("ws_itens", $inputDadosItem, "WHERE user_id = :userid AND id = :upp", "userid={$inputDadosItem['user_id']}&upp={$getIdItem}");
if ($updatebanco->getResult()):                                                
    echo "<div class=\"alert alert-success alert-dismissable\">
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
    <b class=\"alert-link\">SUCESSO!</b> O Item Foi Atualizado.
    </div>"; 

    if(!empty($narray)):

        $lerbanco->ExeRead('ws_relacao_tamanho', "WHERE id_user = :useridd AND id_item = :vv", "useridd={$narray['id_user']}&vv={$getIdItem}");
        if(!$lerbanco->getResult()):
            $narray['id_item'] = $getIdItem;
            $addbanco->ExeCreate("ws_relacao_tamanho", $narray);
        else:
            $updatebanco->ExeUpdate("ws_relacao_tamanho", $narray, "WHERE id_user = :uuserid AND id_item = :uupp", "uuserid={$narray['id_user']}&uupp={$getIdItem}");
        endif;

    endif;

    header("Refresh: 3; url={$site}{$Url[0]}/up-item&id={$getIdItem}#additem");        
else:
    echo "<div class=\"alert alert-danger alert-dismissable\">
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
    <b class=\"alert-link\">OCORREU UM ERRO!</b> Tente novamente.
    </div>"; 
    header("Refresh: 3; url={$site}{$Url[0]}/up-item&id={$getIdItem}#additem");        
endif;

endif; 


endif;//FINAL DO PRIMEIRO IF / ELSE
?>