<div class="container"> 
  <div class="row">
    <div class="col-md-9 col-12">   
      <div id="msg"></div>
      <div class="box">
        <header class="div-title-box">
          <h1 class="title-box-main  d-flex justify-content-center">Cadastro de recorrência de aula</h1>
        </header>
        <div class="container">
          <form class="form-cad" id="form" method="POST">
	           	<div class="d-flex justify-content-center">
               <label>Selecione o dia</label>
              </div> 
              <div class="container">
                <div class="d-flex justify-content-center align-items-center">
                  <div id="container-radio-dias">
                    <input type="radio" name="day_of_week" id="day_1" value="1"><label class="ml-1" for="day_1">Segunda</label>
                    <input type="radio" name="day_of_week" id="day_2" value="2"><label class="ml-1" for="day_2">Terça</label>
                    <input type="radio" name="day_of_week" id="day_3" value="3"><label class="ml-1" for="day_3">Quarta</label>
                    <input type="radio" name="day_of_week" id="day_4" value="4"><label class="ml-1" for="day_4">Quinta</label>
                    <input type="radio" name="day_of_week" id="day_5" value="5"><label class="ml-1" for="day_5">Sexta</label>
                  </div>
                </div>
              </div>

              <div class='container'>
                <div class='row justify-content-center align-items-center'>
                  <div class='col-12'>
                    <div class='row my-2'>
                      <label class="col-6">Turma</label>
                        <?php 
                          $queryAno = "select id_class, name_class from class";

                          $select = "
                                          <select id='class' class='col-6' name='id_class' required/>
                                          <option value=''>Selecione uma turma</option>
                                    ";

                          foreach ($conn->query($queryAno) as $row) {
                              if(!empty($row)){
                                  $select .= "<option value='{$row['id_class']}'>{$row['name_class']}</option>";
                              }
                          }

                          $select .= "</select>";

                          echo $select;
                        ?>
                    </div>
                  </div>

          <div class="col-12"> 
            <div class="row my-2">
              <label class="col-6">Selecione a disciplina</label>
                <?php 
                  $queryAno = "select id_subject, name_subject from subject";

                  $select = "
                                <select id='subject' class='col-6' name='id_subject' required/>
                                <option value=''>Selecione uma turma</option>
                          ";

                  foreach ($conn->query($queryAno) as $row) {
                    if(!empty($row)){
                        $select .= "<option value='{$row['id_subject']}'>{$row['name_subject']}</option>";
                    }
                  }

                  $select .= "</select>";

                  echo $select;
                ?>
            </div> 
          </div>
          <div class="col-12"> 
            <div class="row my-2">
              <label class="col-6">Selecione o professor</label>
                <?php 
                  $queryAno = "select id, name from user where type = 1";

                  $select = "
                                <select id='id_teacher' class='col-6' name='id_teacher' required/>
                                <option value=''>Selecione uma turma</option>
                          ";

                  foreach ($conn->query($queryAno) as $row) {
                    if(!empty($row)){
                        $select .= "<option value='{$row['id']}'>{$row['name']}</option>";
                    }
                  }

                  $select .= "</select>";

                  echo $select;
                ?>
            </div> 
          </div>

          <div class="col-12">
            <div class="row my-2">  
              <label class="col-6">Ordem da aula</label>
              <select class="col-6" name="order_lesson" required>
                <option value="1">1ª</option>
                <option value="2">2ª</option>
                <option value="3">3ª</option>
                <option value="4">4ª</option>
              </select>
            </div>
          </div>
          <div class="col-12">
            <div class="row my-2">  
              <label class="col-6">Ano</label>
              <input type="text" class="col-6" name="year">
            </div>
          </div>
      </div>
    </div>
            <div class="row">
              <div class="col-12">
                <input class="btn btn-sm my-2" id="btn-cad-aluno" type="submit" name="" value="Cadastrar">
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

<script type="text/javascript" src="<?=$configBase?>/../js/cad_recorrencia_aula.js"></script>
