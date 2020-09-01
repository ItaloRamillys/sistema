<div class="container">
  <div class="row">
    <div class="col-md-9 col-12">
      <div id="msg"></div> 
      <div class="box">
        <header class="div-title-box">
              <h1 class="title-box-main  d-flex justify-content-center">Cadastro do Aluno</h1>
        </header>
        <div class="div-content-box">
          <form class="form-cad" id="form" method="POST" enctype="multipart/form-data">
            <input type="hidden" id="tipo" value="student">
            <div class="row">
         		  <div class="divisao-cad col-md-8 col-sm-12 col-xs-12">
                <article>
                  <header>
                    <h2 class="title-div-form">Dados pessoais</h2>
                  </header>
                  <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">

                      <li><label>Nome do aluno</label></li>
                      <li><input type="text" name="name" placeholder="Nome" required=""></li>

                      <li><label>Sobrenome do aluno</label></li>
                      <li><input type="text" name="last_name" placeholder="Sobrenome"></li>

                      <li><label>Data de nascimento</label></li>
                      <li><input type="text" name="birth" placeholder="dd/mm/aaaa" class="date" data-mask="00/00/0000" required="require"></li>

                      <li><label>CPF</label></li>
                      <li><input type="text" name="document" class="cpf" data-mask="000.000.000-00" placeholder="CPF do aluno"></li>

                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                                          
                      <li><label>Email</label></li>
                      <li><input type="text" name="email" class="field_email" placeholder="Email" required=""></li>
                      
                      <li><label>Tipo sanguíneo</label></li>
                      <li><input type="text" name="blood" placeholder="Tipo sanguíneo"></li>

                      <li><label>Gênero</label></li>
                      <li><input type="text" name="genre" placeholder="M/F/O" pattern="[M,m,F,f,O,o]{1}"></li>
                      
                    </div>

                     <div class="col-12">
                      <li><label>Endereço Completo</label></li>
                      <li><input type="text" name="address"  placeholder="Cidade-Bairro-Rua-Numero"></li>
                      </div>
                  </div>
                </article>
              </div>
              <div class="divisao-cad col-md-4 col-sm-12 col-xs-12">
                <article>
                  <header>
                    <h2 class="title-div-form">Dados do sistema</h2>
                  </header>

                  <li><label>Nome do usuário</label></li>
                  <li><input type="text" name="login" placeholder="Nome temporário" required=""></li>

                  <li><label>Senha do usuário</label></li>
                  <li><input type="password" name="pass" placeholder="Senha temporária" required=""></li>
                  
                  <div class="row d-flex justify-content-around align-items-center p-2">
                    <li><label>Imagem de perfil</label></li>
                    <li>
                      <label for="file-upload1" class="btn btn-sm btn-primary">
                        Enviar Imagem
                      </label>
                      <input id="file-upload1" name="img_profile" type="file" style="display:none;">
                      <label id="file-name"></label>
                      <li>   
                        <img src="http://localhost/sistema/img/padrao/icon-profile.png" id="img_profile">
                      </li>
                    </li>
                  </div>
                </article>
              </div>
            </div>
  		      <div class="row mb-2 justify-content-center">
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
<script src='http://localhost/sistema/js/cad_usu.js'></script>
<script src='http://localhost/sistema/js/load_img_real_time.js'></script>
   