<?php
require_once('C:\xampp\htdocs\sistema\proj_esc_func\model\usuario.php');
require_once('C:\xampp\htdocs\sistema\proj_esc_func\controllers\usuario_service.php');

$user = $_SESSION['user_id'];
$query_edit_account = "select * from usuario where id = {$user_id}";
$stmt_edit_account = $conexao->query($query_edit_account);

function can_edit($tipo){
  if(!is_adm($tipo)){
    echo "readonly";
  }
}
?>

<div class="container">
<div id="msg"></div> 
  <div class="row">
    <div class="col-md-9 col-12">
      <div class="box">
        <header class="div-title-box">
              <h1 class="title-box-main  d-flex justify-content-center">Editar usuário</h1>
        </header>

      <div class="div-content-box">
      	<?php 
  			  if($stmt_edit_account->rowCount()>0) {
    				$row_edit_account = $stmt_edit_account->fetch(PDO::FETCH_ASSOC);
            $type = $row_edit_account['tipo'];
            $text_type = getTextType($type);

            $id_created_by = $row_edit_account['id_resp_insert'];
            $id_edited_by = $row_edit_account['id_resp_update'];
            $datetime_author_create = $row_edit_account['create_at'];
            $datetime_author_edit = $row_edit_account['update_at'];

            
            $user_edited_by = new Usuario(); 
            $con = new Conexao();
            $user_edited_by->__set('id', $id_edited_by);
            $user_service_edit = new UsuarioService($con, $user_edited_by);
            $data_user_edit = $user_service_edit->findById(" nome, sobrenome");
            
            $name_user_author_edit = $data_user_edit['nome'] . " " . $data_user_edit['sobrenome'];

            $user_created_by = new Usuario(); 
            $user_created_by->__set('id', $id_created_by);
            $user_service_create = new UsuarioService($con, $user_created_by);
            $data_user_create = $user_service_create->findById(" nome, sobrenome ");
            
            $name_user_author_create = $data_user_create['nome'] . " " . $data_user_create['sobrenome'];

        ?>
        <form id="form" enctype="multipart/form-data">
          <input type="hidden" id="tipo" value="usuario">
          <div class="row">
         		<div class="divisao-cad col-md-8 col-sm-12 col-xs-12">
                  <article>
                    <header>
                      <h2 class="title-box-main  d-flex justify-content-center">Dados pessoais</h2>
                      
                      <?php 

                        if($type != 2){

                      ?>

                          <p class="text-danger text-center" id="msg-cad-auth">
                            *Somente o administrador tem permissão para alterar os dados pessoais. Entre em contato com o administrador da sua escola.
                          </p>
                      <?php
                        }
                      ?>
                    </header>

                     <div class="row">
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="hidden" name="id_user" value="<?=$user?>">
                        <li><label>Nome do usuário</label></li>
                        <li><input type="text" name="nome" placeholder="Nome" value="<?=$row_edit_account['nome']?>" <?php can_edit($type); ?>></li>

                        <li><label>Sobrenome do usuário</label></li>
                        <li><input type="text" name="sobrenome" placeholder="Sobrenome" value="<?=$row_edit_account['sobrenome']?>"  <?php can_edit($type); ?>></li>

                        <li><label>Data de nascimento</label></li>
                        <li><input type="text" name="data_nasc" placeholder="dd/mm/aaaa" class="date" data-mask="00/00/0000" value="<?=$row_edit_account['data_nasc']?>"  <?php can_edit($type); ?>></li>

                        <li><label>CPF</label></li>
                        <li><input type="text" name="cpf" class="cpf" data-mask="000.000.000-00" placeholder="CPF do usuário" value="<?=$row_edit_account['cpf']?>"  <?php can_edit($type); ?>></li>

                      </div>

                      <div class="col-md-6 col-sm-6 col-xs-12">

                        <li><label>Email</label></li>
                        <li><input type="text" name="email" class="field_email" placeholder="Email" value="<?=$row_edit_account['email']?>"  <?php can_edit($type); ?>></li>
                        
                        <li><label>Tipo sanguíneo</label></li>
                        <li><input type="text" name="tipo_sangue" placeholder="Tipo sanguíneo" value="<?=$row_edit_account['tipo_sangue']?>"  <?php can_edit($type); ?>></li>

                        <li><label>Gênero</label></li>
                        <li><input type="text" name="genero" placeholder="M/F/O" pattern="[M,m,F,f,O,o]{1}" value="<?=$row_edit_account['genero']?>"  <?php can_edit($type); ?>></li>
                        
                       </div>

                       <div class="col-12">
                        <li><label>Endereço Completo</label></li>
                        <li><input type="text" name="endereco"  placeholder="Cidade-Bairro-Rua-Numero" value="<?=$row_edit_account['endereco']?>"   <?php can_edit($type); ?>></li>
                        
                        <div class="row d-flex justify-content-around align-items-center p-2">
                          <li><label>Imagem de perfil</label></li>
                            <li>
                              <label for="file-upload1" class="custom-file-upload">
                                Enviar Imagem
                              </label>
                              <input id="file-upload1" name="img_profile" type="file" value="<?=$row_edit_account['img_profile']?>" style="display:none;">
                              <label id="file-name"></label>
                              <li>
                                
                                <img src="http://localhost/sistema/img/<?=$row_edit_account['img_profile']?>" id="img1" width="200" height="200" style="border-radius: 50%;">

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
                  <li><input type="text" name="login" placeholder="Nome temporário" value="<?=$row_edit_account['login']?>" required></li>

                  <li><label>Senha do usuário</label></li>
                  <li><input type="password" name="senha" placeholder="Senha temporária" value="<?=$row_edit_account['senha']?>" required></li>
			          
                  <input class="btn btn-sm btn-primary mt-2" id="btn-cad-usuário" type="submit" name="" value="Cadastrar">
                  
                  <div class="alert alert-primary m-0 mt-2" style="font-size: .75em;">
                  
                        <li>Cadastrado por:</li>
                        <li><?=$name_user_author_create?></li>
                        <li>Em:</li>
                        <li><?=$datetime_author_create?></li>
                        <hr>
                        <li>Editado por:</li>
                        <li><?=$name_user_author_edit?></li>
                        <li>Em:</li>
                        <li><?=$datetime_author_edit?></li>
                  
                  </div>  
                </article>
            </div>
        </div>
      	</form>
        
        <?php 

        if($_SESSION['tipo'] == 2){

        ?>

        <form  class="form-cad" id="form" method="POST" enctype="multipart/form-data">
          <div class="row">
            
          <div class="divisao-cad col-12 p-0">
                <article>
                  <header>
                    <h2 class="title-box-main  d-flex justify-content-center">Dados do <?=$text_type?></h2>
                  </header>

                  <?php 

                  if($type == 0){

                  ?>

                  <li><label>Nome do responsável (1)</label></li>
                  <li><input type="text" name="login" placeholder="Nome do rsponsável" value="<?=$row_edit_account['login']?>"></li>

                  <li><label>Nome do responsável (2)</label></li>
                  <li><input type="text" name="login" placeholder="Nome do rsponsável" value="<?=$row_edit_account['login']?>"></li>

                  <li><label>Contato do responsável (1)</label></li>
                  <li><input type="text" name="login" placeholder="Contato do responsável" value="<?=$row_edit_account['login']?>"></li>

                  <li><label>Contato do responsável (2)</label></li>
                  <li><input type="text" name="login" placeholder="Contato do responsável" value="<?=$row_edit_account['login']?>"></li>

                  <li><label>Observações do aluno</label></li>
                  <li><input type="text" name="login" placeholder="obs" value="<?=$row_edit_account['login']?>"></li>

                  <?php 

                  }elseif($type == 1){

                  ?>
                  
                  <li><label>Salário</label></li>
                  <li><input type="text" name="login" placeholder="Nome do rsponsável" value="<?=$row_edit_account['login']?>"></li>

                  <li><label>Formação</label></li>
                  <li><input type="text" name="login" placeholder="Nome do rsponsável" value="<?=$row_edit_account['login']?>"></li>

                  <li><label>Descrição</label></li>
                  <li><input type="text" name="login" placeholder="Contato do responsável" value="<?=$row_edit_account['login']?>"></li>

                  <li><label>Dia do pagamento</label></li>
                  <li><input type="text" name="login" placeholder="Contato do responsável" value="<?=$row_edit_account['login']?>"></li>

                  <?php 

                  }elseif($type == 2){

                  ?>
                  
                  <li><label>Responsabilidade</label></li>
                  <li><input type="text" name="login" placeholder="Nome do rsponsável" value="<?=$row_edit_account['login']?>"></li>

                  <li><label>Dia do pagamento</label></li>
                  <li><input type="text" name="login" placeholder="Nome do rsponsável" value="<?=$row_edit_account['login']?>"></li>

                  <li><label>Formação</label></li>
                  <li><input type="text" name="login" placeholder="Contato do responsável" value="<?=$row_edit_account['login']?>"></li>

                  <?php 

                  }else{

                  ?>

                    <p class="msg msg-error">Erro de segurança: O tipo de usuário não está registrado em nosso sistema. Contate o desenvolvedor.</p>

                  <?php 

                  } 

                  ?>

                  <li>
                    <input type="submit" value="Cadastrar" class="btn btn-sm btn-primary mt-2">
                  </li>

                </article>
            </div>
          </div>
        </form>
  		<?php }

      } ?>
    </div>
  </div>
  </div>
  <div class="col-md-3 col-12">
      <?php require("{$configThemePath}/sidebar.php"); ?>
    </div>
  </div> 
</div> 
<script>
$(function(){
$('#file-upload1').change(function(){
  const file = $(this)[0].files[0]
  const fileReader = new FileReader()
  fileReader.onloadend = function(){
    $('#img1').attr('src', fileReader.result)
  }
  fileReader.readAsDataURL(file)
})
})
</script>
<script src="<?=$configBase?>/../js/edit_usu.js"></script>