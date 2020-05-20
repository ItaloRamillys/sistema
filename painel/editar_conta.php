<?php
$id_user = $configUrl[1];
$id_user_get = $id_user;

$query = "select * from usuario where id = " . $id_user;
$stmt = $conexao->query($query);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$login_edit = $row['login'];
$senha_edit = $row['senha'];
$nome_edit = $row['nome'];
$sobrenome_edit = $row['sobrenome'];
$email_edit = $row['email'];
$data_nasc_edit = $row['data_nasc'];
$rg_edit = $row['rg'];
$cpf_edit = $row['cpf'];
$end_edit = $row['endereco'];
$img_profile_edit = $row['img_profile'];
$genero_edit = $row['genero'];
$tipo_sangue_edit = $row['tipo_sang'];

$tipo_query = $row['tipo'];

$tipo_get = "";

if($tipo_query == 0){
  
  $resp_1 = ""; 
  $resp_2 = ""; 
  $c_resp_1 = ""; 
  $c_resp_2 = "";
  $matricula = "";
  $obs = "";

  $tipo_get = 'aluno';

  $string_header = "aluno";

  $query2 = "select * from complemento_aluno where id_usu = " . $id_user_get;
  $stmt2 = $conexao->query($query2);

  if($stmt2 ->rowCount() > 0){

    $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
    $resp_1 = $row2['resp1'];
    $resp_2 = $row2['resp2'];
    $c_resp_1 = $row2['contato_resp1'];
    $c_resp_2 = $row2['contato_resp2'];
    $matricula = $row2['matricula'];
    $obs = $row2['obs'];

  }

}else if($tipo_query == 1){
  
  $tipo_get = 'prof';

  $string_header = "professor";

  $salario = ""; 
  $vencimento = ""; 
  $descricao = ""; 
  $formacao = "";

  $query2 = "select * from complemento_prof where id_usu = " . $id_user_get;
  $stmt2 = $conexao->query($query2);

  if($stmt2 ->rowCount() > 0){

    $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
    $salario = $row2['salario'];
    $vencimento = $row2['vencimento'];
    $descricao = $row2['descricao'];
    $formacao = $row2['formacao'];
  }

}else{
  $tipo_get = 'admin';

  $string_header = "administrador";
}

?>
<script type="text/javascript">
  $('.cpf').mask('000.000.000-00', {reverse: true});

  $('.date').mask('00/00/0000');
</script>
<div class="row"> 
      <div class="col-md-9 col-sm-12">
        <div class="container">
          <div class="row">
            <div class="box col-12 p-0">
                <header class="div-title-box">
                      <h1 class="title-box-main  d-flex justify-content-center">Editar <?php echo $string_header ?></h1>
                </header>

              <div class="container">
              
                <form class="form-cad" enctype="multipart/form-data">

                  <div class="row">
    	           		<div class="divisao-cad col-md-8 col-sm-12 col-xs-12">
                          <article>
                            <header>
                              <h2 class="title-box-main  d-flex justify-content-center">Dados pessoais</h2>
                            </header>

                             <div class="row">
                              <div class="col-md-6 col-sm-6 col-xs-12">

                                <?php if($tipo_query == 0){ ?>

                                  <li><label>Matricula</label></li>
                                  <li><input type="text" name="matricula" placeholder="Matricula"  value="<?php echo $matricula; ?>"></li>
                                
                                <?php } ?>
                                
                                <li><label>Nome</label></li>
                                <li><input type="text" name="nome" placeholder="Nome"  value="<?php echo $nome_edit; ?>"></li>

                                <li><label>Sobrenome</label></li>
                                <li><input type="text" name="sobrenome" placeholder="Sobrenome" value="<?php echo $sobrenome_edit; ?>"></li>

                                <li><label>CPF</label></li>
                                <li><input type="text" name="cpf" class= "cpf" data-mask="000.000.000-00" placeholder="CPF" value="<?php echo $cpf_edit; ?>" max-length="12"></li>
                                
                                <li><label>RG</label></li>
                                <li><input type="text" name="rg" placeholder="RG" value="<?php echo $rg_edit; ?>"></li>

                                <?php if($tipo_query == 0){ ?>

                                  <li><label>Email</label></li>
                                  <li><input type="text" name="email" class="field_email" placeholder="Email"  value="<?php echo $email_edit; ?>"></li>

                                <?php } ?>

                              </div>

                              <div class="col-md-6 col-sm-6 col-xs-12">
                                
                                <li><label>Data de nascimento</label></li>
                                <li><input type="text" name="data_nasc" class="field_date" class="date" data-mask="00/00/0000" value="<?php echo $data_nasc_edit; ?>"></li>

                                <li><label>Telefone</label></li>
                                <li><input type="text" name="cont_alu" class="phone" data-mask="(00)00000-0000" placeholder="Contato"></li>
                                
                                <li><label>Tipo sanguíneo</label></li>
                                <li><input type="text" name="tipo_sangue" placeholder="Tipo sanguíneo" value="<?php echo $tipo_sangue_edit; ?>"></li>

                                <li><label>Gênero</label></li>
                                <li><input type="text" name="genero" placeholder="M/F/O" pattern="[M,m,F,f,O,o]{1}" value="<?php echo $genero_edit; ?>"></li>

                                

                                <?php if($tipo_query == 0){ ?>

                                  <li><label>Alergias</label></li>
                                  <li><input type="text" name="alergia" placeholder="Alergias"></li>

                                  <li><label>Observações</label></li>
                                  <li><input type="text" name="obs"  placeholder="Observações gerais" value="<?php echo $obs; ?>"></li>

                                <?php } ?>
                                
                               </div>

                               <div class="col-12">

                                <?php if($tipo_query == 1 || $tipo_query == 2){ ?>

                                  <li><label>Email</label></li>
                                  <li><input type="text" name="email" class="field_email" placeholder="Email"  value="<?php echo $email_edit; ?>"></li>

                                <?php   
                                  }
                                ?>

                                <li><label>Endereço Completo</label></li>
                                <li><input type="text" name="end"  placeholder="Cidade-Bairro-Rua-Numero" value="<?php echo $end_edit; ?>"></li>
                                
                                <div class="row d-flex justify-content-around align-items-center p-2">
                                  <li><label>Imagem de perfil</label></li>
                                    <li>
                                      <label for="file-upload1" class="custom-file-upload">
                                        Enviar Imagem
                                      </label>
                                      <input id="file-upload1" name="img_profile" type="file" style="display:none;">
                                      <label id="file-name"></label>
                                      <li>
                                        
                                        <img src="http://localhost/sistema/img/<?php echo $img_profile_edit ?>" id="img1" width="200" height="200">

                                      </li>
                                    </li>
                                </div>
                              </div> 
                            </div>
                        </article>
                    </div>

                    <div class="divisao-cad col-md-4 col-sm-12 col-xs-12">
                        <article>
                          <header>
                            <h2 class="title-box-main  d-flex justify-content-center">Dados do sistema</h2>
                          </header>

                          <li><label>Nome do usuário</label></li>
                          <li><input type="text" name="login" placeholder="Nome temporário" value="<?php echo $login_edit; ?>"></li>

                          <li><label>Senha do usuário</label></li>
                          <li><input type="text" name="senha" placeholder="Senha temporária" value="<?php echo $senha_edit; ?>"></li>
                          
                          <?php if($tipo_query == 0){ ?>

                          <header>
                            <h2 class="title-box-main  d-flex justify-content-center mt-2">Responsáveis</h2>
                          </header>
                            
                          <li><label>Responsável 1</label></li>
                          <li><input type="text" name="resp_1" placeholder="Nome responsável" value="<?php echo $resp_1; ?>"></li>

                          <li><label>Contato responsável 1</label></li>
                          <li><input type="text" name="cont_1" placeholder="Contato 1" class="phone" data-mask="(00)00000-0000" value="<?php echo $c_resp_1; ?>"></li>

                          <li><label>Responsável 2</label></li>
                          <li><input type="text" name="resp_2" placeholder="Nome responsável" value="<?php echo $resp_2; ?>"></li>

                          <li><label>Contato responsável 2</label></li>
                          <li><input type="text" name="cont_2" placeholder="Contato 2" class="phone" data-mask="(00)00000-0000" value="<?php echo $c_resp_2; ?>"></li>

                          
                          <?php } ?>

                          <?php if($tipo_query == 1){ ?>

                          <header>
                            <h2 class="title-box-main  d-flex justify-content-center mt-2">Dados Profisionais</h2>
                          </header>
                            
                          <li><label>Salário</label></li>
                          <li><input type="text" name="salario" placeholder="Salçario" value="<?php echo $salario; ?>"></li>

                          <li><label>Vencimento</label></li>
                          <li><input type="text" name="vencimento" placeholder="Vencimento" value="<?php echo $vencimento; ?>"></li>

                          <li><label>Formação</label></li>
                          <li><input type="text" name="formacao" placeholder="Formação" value="<?php echo $formacao; ?>"></li>
                          
                          <li><label>Descricao</label></li>
                          <li><textarea name="descricao_prof" style="width: 100%; max-height: 214px;" ><?php echo $descricao; ?></textarea></li>


                          
                          <?php } ?>

                        <input type="hidden" name="id_user" value="<?php echo $id_user_get; ?>">
                        <div class="row d-flex pt-3 justify-content-center">
                          <input type="submit" name="" value="Atualizar" class="btn btn-primary">
                        </div>

                        </article>
                    </div>
    	          </div>
    		      </form>
            </div>
          </div>
   
          </div> 
        </div> 
      </div>
      <div class="col-md-3 col-12">
        <?php require 'sidebar.php'; ?>
      </div>
    
</div>
<script src="http://localhost/sistema/js/editar_usuario.js"></script>