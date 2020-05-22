<div class="container"> 
  <div class="row">
    <div class="col-md-9 col-12">   
      <div class="box">
        <header class="div-title-box">
          <h1 class="title-box-main  d-flex justify-content-center">Cadastro de turma</h1>
        </header>
        <div class="div-content-box py-2">
          <form class="form-cad" method="POST">
	           	<label>Nome da turma</label>
              <input type="text" name="nome_turma" placeholder="Nome da turma" maxlength="2" pattern="^[0-9]{1}[A-Za-z]{1}"
               title="Uma turma possui o seguinte formato #@, onde # deve ser um numero e @ uma letra" required="require">
              <label>Sala de aula</label>
              <input type="text" name="sala" placeholder="Sala de aula">
              <?php $ano_atual = date("Y");?>
              <label>Ano de cadastro</label>
              <input type="text"  class="form-control" name="id_ano" placeholder="Ano vigente" value=<?php echo $ano_atual ?> readonly>
              <div class="row">
                <div class="col-12">
                  <input class="btn btn-primary my-2" id="btn-cad-aluno" type="submit" name="" value="Cadastrar">
                </div>
              </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-3 col-12">
      <?php require 'sidebar.php'; ?>
    </div>
  </div>     
</div>     
