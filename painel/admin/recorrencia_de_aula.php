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
                  <div class='col-md-6 col-12'>
                    <div class='row my-2'>
                        <label class="col-6">Ano</label>

                <?php 
                  $queryAno = "select distinct(year) from class_student";

                  $select = "
                                  <select id='ano' class='col-6' name='year' required/>
                                  <option value=''>Selecione um ano</option>
                            ";

                  foreach ($conn->query($queryAno) as $row) {
                      if(!empty($row)){
                          $select .= "<option value='{$row['year']}'>{$row['year']}</option>";
                      }
                  }

                  $select .= "</select>";

                  echo $select;
                ?>
                    </div>
                <div class="row my-2">
                  <label class="col-6">Selecione a turma</label>
                  <select class="col-6" id="turma" name="id_class" required>
                    <option>Selecione a turma</option>
                  </select>
                </div>
                
            </div>

          <div class="col-md-6 col-12"> 
          <div class="row my-2">
                  <label class="col-6">Selecione a disciplina</label>
                  <select class="col-6" id="disc" name="id_subject" required>
                    <option>Selecione a disciplina</option>
                  </select>
                </div> 
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
<script>
$(document).on('change', '#ano', function(e) {
    var selected = $(this).find('option:selected').val();
    $.ajax({
      type:"GET",
      url:"http://localhost/sistema/painel/ajax/turma_por_ano.php?data="+selected,
      dataType: "json",
      success: function(retorno, jqXHR){      
        var parent = document.getElementById("turma");
        parent.innerHTML = retorno;
      },
      error: function (jqXHR, exception) {
            var msg_error = '';
            if (jqXHR.status === 0) {
                msg_error = 'Not connect.\n Verify Network.';
            } else if (jqXHR.status == 404) {
                msg_error = 'Requested page not found. [404]';
            } else if (jqXHR.status == 500) {
                msg_error = 'Internal Server Error [500].';
            } else if (exception === 'parsererror') {
                msg_error = 'Requested JSON parse failed.';
            } else if (exception === 'timeout') {
                msg_error = 'Time out error.';
            } else if (exception === 'abort') {
                msg_error = 'Ajax request aborted.';
            } else {
                msg_error = 'Uncaught Error.\n' + jqXHR.responseText;
            }
            alert(msg_error);
        },
    });

});
$(document).on('change', '#turma', function(e) {
    var sel_1 = $(this).find('option:selected').val();
    var sel_2 = $('#ano').find('option:selected').val();
    $.ajax({
      type:"GET",
      url:"http://localhost/sistema/painel/ajax/disc_por_turma_ano.php?c="+sel_1+"&y="+sel_2,
      dataType: "json",
      success: function(retorno, jqXHR){      
        var parent = document.getElementById("disc");
        parent.innerHTML = retorno;
      },
      error: function (jqXHR, exception) {
            var msg_error = '';
            if (jqXHR.status === 0) {
                msg_error = 'Not connect.\n Verify Network.';
            } else if (jqXHR.status == 404) {
                msg_error = 'Requested page not found. [404]';
            } else if (jqXHR.status == 500) {
                msg_error = 'Internal Server Error [500].';
            } else if (exception === 'parsererror') {
                msg_error = 'Requested JSON parse failed.';
            } else if (exception === 'timeout') {
                msg_error = 'Time out error.';
            } else if (exception === 'abort') {
                msg_error = 'Ajax request aborted.';
            } else {
                msg_error = 'Uncaught Error.\n' + jqXHR.responseText;
            }
            console.log(msg_error);
        },
    });

});
</script>
<script type="text/javascript" src="<?=$configBase?>/../js/cad_recorrencia_aula.js"></script>
