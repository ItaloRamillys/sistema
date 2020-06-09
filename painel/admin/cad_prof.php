<div id="msg"></div>
<div class="container">
  <div class="row">
    <div class="col-md-9 col-12">
      <div class="box">
        <div class="div-title-box">
          <h1 class="title-box-main  d-flex justify-content-center">Cadastro de professor</h1>
        </div>
        <div class="div-content-box">
	      <form class="pt-3" id="form" enctype="multipart/form-data">
          <input type="hidden" id="tipo" value="prof">
            <div class="row">
                    <div class="divisao-cad  col-md-8 col-sm-12 col-xs-12">
                          <article>
                              <header>
                                <h2 class="title-box-main  d-flex justify-content-center">Dados pessoais</h2>
                              </header>

                              <div class="row">
                                  
                                  <div class="col-md-6 col-sm-6">
                                    
                                      <li><label>Nome</label></li>
                                      <li><input type="text" name="nome" placeholder="Nome" required="require"></li>

                                      <li><label>Sobrenome</label></li>
                                      <li><input type="text" name="sobrenome" placeholder="Sobrenome"></li>

                                      <li><label>Data de nascimento</label></li>
                                      <li><input type="text" name="data_nasc" placeholder="dd/mm/aaaa" pattern="[0,1,2,3]{1}[0-9]{1}\/[0,1]{1}[0-9]{1}\/[0-9]{4}" required="require"></li>

                                      <li><label>Tipo sanguíneo</label></li>
                                      <li><input type="text" name="tipo_sangue" placeholder="Tipo sanguíneo"></li>

                                  </div>

                                  <div class="col-md-6 col-sm-6">
                                      
                                      <li><label>Gênero</label></li>
                                      <li><input type="text" name="genero" placeholder="M/F/O" pattern="[M,m,F,f,O,o]{1}" required="require"></li>

                                      <li><label>CPF</label></li>
                                      <li><input type="text" name="cpf" placeholder="CPF do professor" required="require"></li>

                                      <li><label>Contato</label></li>
                                      <li><input type="text" name="contato" placeholder="Contato"></li>
                                      
                                  </div>

                                  <div class="col-12">

                                    

                                    <li><label>E-mail</label></li>
                                    <li><input type="text" name="email" placeholder="E-mail" required="require"></li>
                          
                                    <li><label>Endereço Completo</label></li>
                                    <li><input type="text" name="end"  placeholder="Cidade-Bairro-Rua-Numero"></li>
                                    
                          <div class="row d-flex justify-content-around align-items-center p-2">
                            <li><label>Imagem de perfil</label></li>
                              <li>
                                <label for="file-upload1" class="custom-file-upload">
                                  Enviar Imagem
                                </label>
                                <input id="file-upload1" name="img_profile" type="file" style="display:none;">
                                <label id="file-name"></label>
                                <li>
                                  
                                <img src="http://localhost/sistema/img/icon-profile.png" id="img1" width="200" height="200" style="border-radius: 50%;">

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
                        <li><input type="text" name="login" placeholder="Nome temporário" required=""></li>

                        <li><label>Senha do usuário</label></li>
                        <li><input type="password" name="senha" placeholder="Senha temporária" required=""></li>
                        
                        <!--
                        <header>
                          <h2 class="title-box-main  d-flex justify-content-center mt-2">Dados profissionais</h2>
                        </header>
                          
                        <li><label>Salário</label></li>
                        <li><input type="text" name="salario" placeholder="Salário (Não obrigatório)"></li>

                        <li><label>Vencimento</label></li>
                        <li><input type="text" name="vencimento" placeholder="Dia do pagamento (Não obrigatório)"></li>

                        <li><label>Formação</label></li>
                        <li><input type="text" name="formacao" placeholder="Ex.: Graduado em Física (Não obrigatório)"></li>

                        <li><label>Descrição do professor</label></li>
                        <li>
                          <input type="text" name="descricao_prof" style="width: 100%; max-height: 214px; height: 214px;">
                            
                        </li>
                      -->

                      </article>
                  </div>
              </div>
                  
		        <div class="row d-flex justify-content-center">
					<input class="btn btn-primary" id="btn-cad-aluno" type="submit" name="" value="Cadastrar">
				</div>

         </form>
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

<script src='http://localhost/sistema/js/cad_usu.js'></script>


