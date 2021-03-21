<?php
ob_start();
session_cache_expire(60);
session_start();
require('../_app/Config.inc.php');
require('../_app/Mobile_Detect.php');
$detect = new Mobile_Detect;
$site = HOME;
$login = new Login(3);
if($login->CheckLogin()):
    $idusuar = $_SESSION['userlogin']['user_id'];
    $lerbanco->ExeRead('ws_empresa', "WHERE user_id = :idcliente", "idcliente={$idusuar}");
    if (!$lerbanco->getResult()):       
    else:
        foreach ($lerbanco->getResult() as $i):
            extract($i);
        endforeach;
        header("Location: {$site}{$nome_empresa_link}/estatisticas");
    endif;
else:
endif;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastrar-se</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
    

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <script src="<?=$site;?>js/jquery-2.2.4.min.js"></script>

    <link href="<?= $site; ?>css/x0popup-master/dist/x0popup.min.css" rel="stylesheet">
    <script src="<?= $site; ?>css/x0popup-master/dist/x0popup.min.js"></script>
      <link href="<?=$site;?>css/suportewats.css" rel="stylesheet">


</head>
<body>

    <div class="main" style="text-underline: none; ">
        <div class="container">
            <div class="signup-content">
                <div class="signup-img">
                    <img src="images/delivery.jpg" alt="">
                </div>
                <div class="signup-form">
                    <form method="POST" autocomplete="off" class="register-form" id="register-form">
                        <h2>Crie agora seu cardápio online e comece a vender. Você tem <?=$texto['DiasDeTeste'];?> dias para testar.</h2>
                        <?php
                        require('processacadastro.php');
                        ?>
                        <div class="form-row"></div>
                        <div class="form-group">
                            <label for="nome_empresa">Nome da Loja</label>
                            <input type="text" name="nome_empresa" id="nome_empresa" placeholder="Nome da Loja" required/>                                
                        </div>
                        <div class="form-group">
                            <label for="nome_empresa_link"><?=$site;?></label>
                            <input type="text" name="nome_empresa_link" id="nome_empresa_link" required placeholder="Maiúsculas, minúsculas e underline." />
                            <a class="btn btn-success btn-xs" id="verificarDisponibilidadeLink" style="background-color: #5cb85c;color: #ffffff;cursor: pointer;margin-top: 5px;padding: 5px;"><strong> Verificar Disponibilidade </strong></a>
                        </div>


                        <div class="form-row">
                            <div class="form-group">
                                <label for="cidades">Estado:</label>
                                <div class="form-select">
                                   <select required class="form-control" name="end_uf_empresa" id="estados"></select>

                                   <span class="select-icon"><i class="zmdi zmdi-chevron-down"></i></span>
                               </div>
                           </div>
                           <div class="form-group">
                            <label for="city">Cidade:</label>
                            <div class="form-select">
                               <select required class="form-control" name="cidade_empresa" id="cidades">    
                               </select>
                               <span class="select-icon"><i class="zmdi zmdi-chevron-down"></i></span>
                           </div>
                       </div>
                   </div>

                   <div class="form-row">
                    <div class="form-group">
                     <label for="end_bairro_empresa">Bairro</label>
                     <input type="text" autocomplete="off" id="end_bairro_empresa" required name="end_bairro_empresa" class="form-control" placeholder="Bairro...">

                 </div>
                 <div class="form-group">
                     <label for="end_rua_n_empresa">Rua / Nº</label>
                     <input type="text" autocomplete="off" id="end_rua_n_empresa" required name="end_rua_n_empresa" class="form-control" placeholder="Rua e Nº">
                 </div>
             </div>
             <hr />

             <div class="form-row">
                <div class="form-group">
                 <label for="user_name">Nome</label>
                 <input type="text" required autocomplete="off" class="form-control" id="user_name" name="user_name" placeholder="Seu Nome">

             </div>
             <div class="form-group">
                 <label for="user_lastname">Sobrenome</label>
                 <input type="text" required autocomplete="off"  class="form-control" id="user_lastname" name="user_lastname" placeholder="Seu Sobrenome">
             </div>
         </div>

         <div class="form-row">
            <div class="form-group">
               <label for="user_email">E-mail:</label>
               <input type="email" required autocomplete="off" id="user_email" name="user_email" class="form-control " placeholder="E-mail">

           </div>
           <div class="form-group">
             <label for="user_telefone">Telefone para contato:</label>
             <input type="tel" required autocomplete="off"  id="user_telefone" name="user_telefone" class="form-control" placeholder="(99) 99999-9999" data-mask="(00) 00000-0000" maxlength="15">
         </div>
     </div>

     <div class="form-row">
        <div class="form-group">
          <label for="user_password">Senha</label>
          <input type="password" required autocomplete="off" class="form-control" placeholder="*******" name="user_password"  id="user_password" />

      </div>
      <div class="form-group">
         <label for="user_password2">Repita a Senha</label>
         <input type="password" required autocomplete="off"  class="form-control" placeholder="*******" name="user_password2"  id="user_password2" />
     </div>
 </div>


 <div class="form-group">
     <label>Escolha seu plano</label>
     <div class="form-select">

      <select name="user_plano" required class="form-control" >
        <option value="">Selecione um Plano</option>
        <option value="1"><?=$texto['nomePlanoUm'];?></option>
        <option value="2"><?=$texto['nomePlanoDois'];?></option>
        <option value="3"><?=$texto['nomePlanoTres'];?></option>
    </select>
    <span class="select-icon"><i class="zmdi zmdi-chevron-down"></i></span>
</div>
</div>

<div class="form-submit"> 
  <input type="hidden" name="empresa_status" value="true">
  <input type="reset" value="Resetar campos" class="submit" name="reset" id="reset" />
  <input type="submit" value="Cadastrar Loja" class="submit" name="submit" id="submit" />
</div>
<style type="text/css">
                #social_footer{
    text-align:center;
    border-top:1px solid #ededed;
    padding-top:30px;
    margin-top:30px;
}
#social_footer p{
    font-size:12px;
    color:#8c8c8c;
}
#social_footer ul{
    margin:0;
    padding:0 0 10px 0;
    text-align:center;
}
#social_footer ul li{
    display:inline-block;
    margin:0 5px 10px 5px;
}
#social_footer ul li a{
    color:#666;
    text-align:center;
    line-height:34px;
    display:block;
    font-size:16px;
    width:35px;
    height:35px;
    background-color:#f2f2f2;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    border-radius: 50%;
}
#social_footer ul li a:hover{
    background:#fff;
    color:#111;
}
            </style>
            <div id="social_footer">
        <ul>
          <li><a target="_blank" href="<?=(!empty($texto['link_do_face']) ? $texto['link_do_face'] : "");?>"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></li>
          <!--<li><a href="#0"><i class="icon-twitter"></i></a></li>-->
          <!--<li><a href="#0"><i class="icon-google"></i></a></li>-->
          <li><a target="_blank" href="<?=(!empty($texto['link_do_insta']) ? $texto['link_do_insta'] : "");?>"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
          <!--<li><a href="#0"><i class="icon-pinterest"></i></a></li>-->
          <!--<li><a href="#0"><i class="icon-vimeo"></i></a></li>-->
          <li><a target="_blank" href="<?=(!empty($texto['link_do_insta']) ? $texto['link_do_insta'] : "");?>"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
        </ul>    
      </div>
</form>

</div>
</div>
</div>

</div>

<!-- JS -->
<script src="vendor/jquery/jquery.min.js"></script>
   <script src="<?=$site;?>js/jquery-2.2.4.min.js"></script>
<script src="js/main.js"></script>



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
                '<?=$site;?> \n'+data+' está disponível!', 
                'ok', false);
          }          
      }
  });

    }
});
});
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

<script src="<?=$site;?>js/jquery.mask.js"></script>
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


<script src="<?=$site;?>js/suportewats.js"></script>






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
            <p style="color:#ffffff;">Clique em um de nossos representantes abaixo para conversar no WhatsApp ou envie um email para <?=$texto['emailSuporteSite'];?></p></div>
            <div class='get-new hide'><div id='get-label'></div><div id='get-nama'></div></div></div>
            <div class='home-chat'>
              <!-- Info Contact Start -->
              <a class='informasi' href='javascript:void' title='Chat Whatsapp'>
                <div class='info-avatar'><img src='<?=$site?>img/supportmale.png'/></div>
                <div class='info-chat'>
                  <span class='chat-label' style="text-decoration:none;">Suporte Técnico</span>
                  <span class='chat-nama' style="text-decoration:none;">Atendimento ao Cliente 1</span>
                </div><span class='my-number'><?=$texto['telefoneAdministracaoTecnica'];?></span>
              </a>
              <!-- Info Contact End -->
              <!-- Info Contact Start -->
              <a class='informasi' href='javascript:void' title='Chat Whatsapp'>
                <div class='info-avatar'><img src='<?=$site?>img/supportfemale.png'/></div>
                <div class='info-chat'>
                  <span class='chat-label' style="text-decoration:none;">Suporte Vendas</span>
                  <span class='chat-nama' style="text-decoration:none;">Atendimento ao Cliente 2</span>
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
                <a class='blantershow-chat' href='javascript:void' title='whatsapp' style="text-decoration:none;"><i class='fa fa-whatsapp'></i>Precisa de ajuda?</a>
                <!-- partial -->
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>