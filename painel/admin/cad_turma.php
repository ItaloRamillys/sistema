<div class="container"> 
  <div class="row">
    <div class="col-md-9 col-12">   
      <div id="msg"></div>
      <div class="box">
        <header class="div-title-box">
          <h1 class="title-box-main  d-flex justify-content-center">Cadastro de turma</h1>
        </header>
        <div class="div-content-box py-2">
          <form id="form" method="POST">
	           	<label>Nome da turma</label>
              <input type="text" name="name_class" placeholder="Nome da turma" maxlength="2" pattern="^[0-9]{1}[A-Za-z]{1}"
               title="Uma turma possui o seguinte formato #@, onde # deve ser um numero e @ uma letra" required="require">
              <label>Sala de aula</label>
              <input type="text" name="room" placeholder="Sala de aula">
              <label>Ano de cadastro</label>
              <input type="text" name="year" placeholder="Ano vigente">
              <div class="row">
                <div class="col-12">
                  <input class="btn btn-primary my-2" type="submit" name="" value="Cadastrar">
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
<script type="text/javascript" src="<?=$configBase?>/../js/cad_turma.js"></script>
