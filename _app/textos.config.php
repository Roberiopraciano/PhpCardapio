<?php
// *************************************************
// ********************** IDENTIDADE DO SITE LANDING PAGE ################
// *************************************************

$texto['site_custo_delivery'] = '<strong>Delivery:</strong>';
$texto['site_custo_free_up']  = '<strong>Grátis acima de:</strong>';

// index SEO
$texto['titulo_site_landing']    = (!empty($getEmpresa[0]['titulo_site']) ? $getEmpresa[0]['titulo_site'] : "");
$texto['nome_site_landing']      = (!empty($getEmpresa[0]['nome_site']) ? $getEmpresa[0]['nome_site'] : "");
$texto['descricao_site_landing'] = (!empty($getEmpresa[0]['descricao_site']) ? $getEmpresa[0]['descricao_site'] : "");
$texto['autor_site_landing']     = 'Alex da silva lima';
$texto['keywords_landing']       = (!empty($getEmpresa[0]['palavas_chaves']) ? $getEmpresa[0]['palavas_chaves'] : "");

//ERROS
$texto['msg_erro_empty_op'] = 'Escolher uma opção clicando em <i class="icon_plus_alt2"></i>';

// TELEFONES DE SUPORTE
$texto['telefoneAdministracaoTecnica'] = (!empty($getEmpresa[0]['tel_adm']) ? "55".$getEmpresa[0]['tel_adm'] : "");
$texto['telefoneAdministracaoVendas']  = (!empty($getEmpresa[0]['tel_financeiro']) ? "55".$getEmpresa[0]['tel_financeiro'] : "");

// E-MAIL DE SUPORTE E NOTIFICAÇÃO DO DONO DO SITE
$texto['emailSuporteSite']  = (!empty($getEmpresa[0]['email_suporte']) ? $getEmpresa[0]['email_suporte'] : "");

// HORÁRIOS PARA SUPORTE
$texto['horariosSuporteSite']  = (!empty($getEmpresa[0]['h_suporte']) ? $getEmpresa[0]['h_suporte'] : "");

//LINK PARA O BOTÃO ASSISTIR VIDEOS DA LANDING PAGE
$texto['linkVideosLanding']   = (!empty($getEmpresa[0]['btn_link_youtube']) ? $getEmpresa[0]['btn_link_youtube'] : "");

// REDES SOCIAIS DO SITE
$texto['link_do_face'] = (!empty($getEmpresa[0]['link_do_face']) ? $getEmpresa[0]['link_do_face'] : "");
$texto['link_do_insta'] = (!empty($getEmpresa[0]['link_do_insta']) ? $getEmpresa[0]['link_do_insta'] : "");
$texto['link_do_youtube'] = (!empty($getEmpresa[0]['link_do_youtube']) ? $getEmpresa[0]['link_do_youtube'] : "");

//PLANOS DE USUÁRIOS

//plano 1
$texto['nomePlanoUm']   = (!empty($getEmpresa[0]['nome_plano_um']) ? $getEmpresa[0]['nome_plano_um'] : "");
$texto['valorPlanoUm']  = (!empty($getEmpresa[0]['v_plano_um']) ? $getEmpresa[0]['v_plano_um'] : ""); 
$texto['DiasPlanoUm']   = (!empty($getEmpresa[0]['dias_plano_um']) ? $getEmpresa[0]['dias_plano_um'] : ""); // valor em dias
//plano 2
$texto['nomePlanoDois']   = (!empty($getEmpresa[0]['nome_plano_dois']) ? $getEmpresa[0]['nome_plano_dois'] : "");
$texto['valorPlanoDois']  = (!empty($getEmpresa[0]['v_plano_dois']) ? $getEmpresa[0]['v_plano_dois'] : ""); // Sempre valor inteiro
$texto['DiasPlanoDois']   = (!empty($getEmpresa[0]['dias_plano_dois']) ? $getEmpresa[0]['dias_plano_dois'] : ""); // valor em dias
//plano 3
$texto['nomePlanoTres']   = (!empty($getEmpresa[0]['nome_plano_tres']) ? $getEmpresa[0]['nome_plano_tres'] : "");
$texto['valorPlanoTres']  = (!empty($getEmpresa[0]['v_plano_tres']) ? $getEmpresa[0]['v_plano_tres'] : ""); // Sempre valor inteiro
$texto['DiasPlanoTres']   = (!empty($getEmpresa[0]['dias_plano_tres']) ? $getEmpresa[0]['dias_plano_tres'] : ""); // valor em dias

// DIAS PARA TESTAR O SISTEMA
$texto['DiasDeTeste']   = (!empty($getEmpresa[0]['dias_testes']) ? $getEmpresa[0]['dias_testes'] : ""); // valor em dias - minimo tem que ser 1

// IMPORTANTE ***** SEUS DADOS DO MERCADO PAGO PARA RECEBER PAGAMENTO
//--------------------------------------------------------------------
//*****************************************************************
// DEPOIS DE CRIAR SUA CONTA NO MERCADO PAGO VOCÊ DEVE 
//TERMINAR DE PREENCHER ALGUNS DADOS E PEGAR ESSAS 2 INFORMAÇÕES NO LINK E SUBISTITUIR ABAIXO:
// https://www.mercadopago.com.br/developers/panel/credentials
//******************************************************************
$texto['accesstoken'] = (!empty($getEmpresa[0]['access_token_mp']) ? $getEmpresa[0]['access_token_mp'] : "");
$texto['publickey']   = (!empty($getEmpresa[0]['public_key_mp']) ? $getEmpresa[0]['public_key_mp'] : "");


//--------------------------------------------------------------------
// *************************************************
// *************** TEXTOS GERAIS DA FRONT END
// *************************************************
//--------------------------------------------------------------------

// MENU
$texto['home']          = 'Inicio';
$texto['sobre']         = 'Sobre';
$texto['contato']       = 'Contato';
$texto['login']         = 'Administrar';
$texto['Conf_loja']     = 'Configurações';
$texto['estatisticas']  = 'Relatórios';
$texto['msg_pedidos']   = 'Ver Pedidos';
$texto['Contegoria']    = 'Categorias';
$texto['Menu']          = 'Adicionar Itens';
$texto['itens']         = 'Meus Itens';
$texto['login-senha']   = 'Alterar Senha';
$texto['Administrar']   = 'Administrar';
$texto['delivery_adress']     = 'Configurar Entregas';
$texto['cupom-desconto']      = 'Cupom de Desconto';
$texto['cadastros-menu']      = 'Cadastros';
$texto['cadastros-cat']       = 'Cadastrar Categorias';
$texto['cadastros-iten']      = 'Cadastrar Itens';
$texto['cadastros-enderecos'] = 'Cadastrar Endereços';
$texto['cadastros-cupons']    = 'Cadastrar Cupons';
$texto['cadastros-observacoes']    = 'Cadastrar Observações';
$texto['cadastros-tipostamanhos']    = 'Cadastrar Tipos e Tamanhos';
$texto['cadastros-complementos']    = 'Cadastrar Complementos';
$texto['cadastro-pagamentos']    = 'Cadastrar formas de pagamento';
$texto['sair']                =  'Sair';

// Página inicial
$texto['home_ajuda']              = 'Precisa de <span>Ajuda?</span>';
$texto['msg_ate']                 = 'até';
$texto['msg_aberto']              = 'ABERTO AGORA';
$texto['msg_fechado']             = 'FECHADO AGORA';
$texto['msg_fechado_dia']         = 'NÃO ABRIREMOS HOJE';
$texto['msg_compartilhar']        = 'Compartilhe – Com Amigos e Familiares';
$texto['msg_cardapio']            = '<i class="fa fa-cart-arrow-down" aria-hidden="true"></i> - ITENS ABAIXO - <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>';
$texto['msg_itemlop']             = 'Item';
$texto['msg_precolop']            = 'Preço';
$texto['msg_pedirlop']            = 'Pedir';
$texto['msg_delivery']            = 'No endereço - (Delivery)';
$texto['msg_Buscar_pedido']       = 'Retirar no Balcão';
$texto['msg_pedido_mesa']         = 'Entregar na Mesa';
$texto['msg_tamanho']             = 'Opção';
$texto['msg_adicionais']          = '+Adicionais';
$texto['msg_quantidade']          = 'Quantidade';
$texto['msg_purchase']            = 'ADICIONAR AO PEDIDO';
$texto['msg_indisponivel']        = 'INDISPONÍVEL NO MOMENTO';
$texto['msg_seu_pedido']          = 'SEU PEDIDO';
$texto['msg_limpar_pedido']       = 'Limpar Pedido';
$texto['msg_escolha_opção_abaixo']= 'ESCOLHA UMA OPÇÃO ABAIXO';
$texto['msg_subtotal']            = 'Subtotal';
$texto['msg_adicionais']          = 'Adicionais';
$texto['msg_total_valor']         = 'TOTAL';
$texto['msg_confirmar_puschase']  = 'CONCLUIR PEDIDO';
$texto['msg_btn_cupom']           = 'CUPOM DE DESCONTO';
$texto['msg_input_cep']           = 'Antes verifique se fazemos entrega em seu endereço e qual  o valor:';
$texto['msg_entrega_adress']      = 'Entrega em meu endereço?';
$texto['msg_nao_sabe_cep']        = 'Não sei meu cep';
$texto['msg_conet_whatsapp']      = 'Conectar ao WhatsApp';
$texto['msg_msg_conect_whatsapp'] = 'Antes Conecte seu computador ao WhatsApp';
$texto['msg_qtd']                 = 'Qtd:';
$texto['msg_adicionais']          = 'Adicionais:';
$texto['msg_valor'] 			  = 'Valor:';
$texto['msg_sem_adicionais']      = 'Sem Adicionais';
$texto['msg_add_titulo']          = 'CARRINHO';
$texto['msg_add_subtitulo']       = 'Seu pedido foi adicionado.';
$texto['msg_opcao_delivery']      = 'SELECIONE UMA OPÇÃO:';
$texto['msg_disponibilidadeItens']= 'Em breve teremos itens nessa categoria. Aguarde!';
$texto['msg_obsItem']             = 'Alguma observação p/ este pedido?';
$texto['msg_remover_item']        = 'Remover Item';
$texto['msg_ver_horarios']        = 'Ver Horários';
$texto['msg_btn_horarios']        = 'Horários de atendimento';
$texto['msg_h_dimingo']           = 'DOMINGO';
$texto['msg_h_segunda']           = 'SEGUNDA FEIRA';
$texto['msg_h_terca']             = 'TERÇA FEIRA';
$texto['msg_h_quarta']            = 'QUARTA FEIRA';
$texto['msg_h_quinta']            = 'QUINTA FEIRA';
$texto['msg_h_sexta']             = 'SEXTA FEIRA';
$texto['msg_h_sabado']            = 'SABADO';
$texto['msg_btn_fechar']          = 'Fechar';

// Página do carrinho
$texto['msg_delivery_time']        = 'Tempo de Entrega';
$texto['msg_delivery_time_msg']    = 'Tempo Médio de Entrega 30 Minutos!';
$texto['msg_detalhes_pedidos']     = 'Preencha os campos abaixo:';
$texto['msg_seu_nome']             = 'Seu Nome/Apelido';
$texto['msg_placehold_complemento']= 'bloco? apto? casa?';
$texto['msg_placehold_obs']        = 'Observações';
$texto['msg_seu_tell']             = 'Seu telefone';
$texto['msg_pedir_agora']          = 'Pedir Agora';
$texto['msg_add_mai']              = 'Adicionar Mais';
$texto['msg_seu_endereco']         = 'Seu Endereço';
$texto['msg_seu_cep']              = 'Seu Cep:';
$texto['msg_sua_rua']              = 'Rua:';
$texto['msg_seu_n']                = 'Numero:';
$texto['msg_seu_b']                = 'Bairro:';
$texto['msg_seu_bairro']           = 'BAIRROS ATENDIDOS';
$texto['msg_sel_bairro']           = 'Selecione o seu bairro...';
$texto['msg_sua_cidade']           = 'Cidade:';
$texto['msg_seu_estado']           = 'Estado:';
$texto['msg_complemento']          = 'Complemento:';
$texto['msg_obs_endereco']         = 'Observação:';
$texto['msg_f_pagamento']          = 'FORMA DE PAGAMENTO';
$texto['msg_f_dh']                 = 'Dinheiro';
$texto['msg_f_cr']                 = 'Crédito';
$texto['msg_f_db']                 = 'Débito';
$texto['msg_troco']                = 'TROCO PARA';
$texto['msg_resumo_pedido']        = 'Resumo do seu pedido';
$texto['msg_cart_delivery']        = 'Delivery';
$texto['msg_msg_fechado']          = 'Loja Fechada no Momento';
$texto['msg_msg_camposVazios']     = 'Preencha os campos obrigatórios!';
$texto['msg_msg_dadosabaixo']      = 'INFORME OS DADOS ABAIXO';
$texto['msg_msg_Nmesa']            = 'Nº da Mesa:';
$texto['msg_msg_qtdpessoas']       = 'Quantidade de Pessoas:';
$texto['msg_msg_obsmesa']          = 'Observações:';
$texto['msg_msg_enviarzap']        = 'Agilize o seu pedido enviando para o whatsapp do estabelecimento. "Você precisa confirmar o envio no APP."';



$texto['msg_detaches_pedidos']    = "Escolha seu pedido abaixo selecionando e alterando as quantidades, e em \"{$texto['msg_seu_pedido']}\" acompanhe como está ficando, depois de pronto, clique em \"{$texto['msg_confirmar_puschase']}\", informe seu endereço e a forma de pagamento, depois clique em \"{$texto['msg_pedir_agora']}\", será enviado tudo pelo WhatsApp automaticamente!";


// Página de contato
$texto['texto_login_admin']          = 'Faça Login Agora!';
$texto['texto_login_admin_msg']      = 'Reservado para os Administradores';

$texto['texto_contato_head']         = 'Envie sua mensagem via WhatsApp!';
$texto['texto_contato_paragrafo']    = 'Tem alguma dúvida, pergunta ou quer fazer uma encomenda?';
$texto['texto_contato_nome']         = 'Nome';
$texto['texto_contato_email']        = 'E-mail';
$texto['texto_contato_assunto']      = 'Assunto?';
$texto['texto_contato_msg']          = 'Sua Mensagem';
$texto['texto_contato_bt']           = 'Enviar Mensagem';

$texto['texto_contato_erro_vazio']   = 'Preencha todos os campos!';
$texto['texto_contato_erro_email']   = 'O EMAIL informado não e valido!';

// Página Sobre
$texto['texto_sobre_titulo']         = 'Desde 2015 entregando os lanches mais sinistros da cidade!';

$texto['texto_sobre_endereco']       = 'Nosso <span>Endereço:</span>';
$texto['texto_sobre_endereco_msg']   = 'Seu endereço completo aqui...';
//--------------------------------------
$texto['texto_sobre_menu']           = '<span>+50</span> escolhas gostosas';
$texto['texto_sobre_menu_msg']       = 'Fale um pouco sobre o seu menu para o cliente...';
//--------------------------------------
$texto['texto_sobre_delivery']       = 'Serviços <span>Delivery</span>';
$texto['texto_sobre_delivery_msg']   = 'Fale um pouco sobre os serviços de entrega...';
//--------------------------------------
$texto['texto_sobre_mobile']         = 'Suporte rápido pelo <span>celular</span>';
$texto['texto_sobre_mobile_msg']     = 'explique ao cliente sobre os serviços de suporte...';
//--------------------------------------
$texto['texto_sobre_barato']         = 'Os lanches <span>+ baratos</span> da cidade';
$texto['texto_sobre_barato_msg']     = 'Fale um pouco sobre as vantagens de comprar com vcs...';
//--------------------------------------
$texto['texto_sobre_cartoes']        = 'Aceitamos <span>cartões de créditos</span>';
$texto['texto_sobre_cartoes_msg']    = 'explique as formas de pagamento e se aceita cartão...';
