<div id="msg"></div>
<div class="container"> 
  <div class="row">
    <div class="col-md-9 col-12">   
      <div class="box">
        <header class="div-title-box">
          <h1 class="title-box-main  d-flex justify-content-center">Cadastro de recorrência de aula</h1>
        </header>
        <div class="div-content-box py-2">
          <form class="form-cad" id="form" method="POST">
	           	<label>Selecione os dias</label>
              <div class="container">
                <div class="row justify-content-center align-items-center">
                  <div class="col-12">
                    <input type="radio" name="day_of_week" id="day_1" value="1"><label class="ml-1" for="day_1">Segunda</label>
                    <input type="radio" name="day_of_week" id="day_2" value="2"><label class="ml-1" for="day_2">Terça</label>
                    <input type="radio" name="day_of_week" id="day_3" value="3"><label class="ml-1" for="day_3">Quarta</label>
                    <input type="radio" name="day_of_week" id="day_4" value="4"><label class="ml-1" for="day_4">Quinta</label>
                    <input type="radio" name="day_of_week" id="day_5" value="5"><label class="ml-1" for="day_5">Sexta</label>
                  </div>
                </div>
              </div>

              <label>Ano</label>
                <?php 
                  $queryAno = "select distinct(ano) from turma_aluno";

                  $select = "<div class='container'>
                <div class='row justify-content-center align-items-center'>
                  <div class='col-12'>
                                  <select class='' id='ano' name='ano_turma' required/>
                                  <option value=''>Selecione um ano</option>
                            ";

                  foreach ($conexao->query($queryAno) as $row) {
                      if(!empty($row)){
                          $select .= "<option value='{$row['ano']}'>{$row['ano']}</option>";
                      }
                  }

                  $select .= "</select></div></div></div>";

                  echo $select;
                ?>
              <label>Selecione a aula</label>
              <div class="container">
                <div class="row justify-content-center align-items-center">
                  <div class="col-12">
                   <select id="select_ano">
                     <option>Selecione a aula</option>
                   </select>
                  </div>
                </div>
              </div>
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
<script>

$(document).on('change', '#ano', function(e) {
    var selected = $(this).find('option:selected').val();
        console.log(selected);
    $.ajax({
      type:"GET",
      url:"http://localhost/sistema/painel/ajax/aula_por_ano.php?data="+selected,
      dataType: "json",
      success: function(retorno, jqXHR){      
        var parent = document.getElementById("select_ano");
        console.log(retorno);
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
<script type="text/javascript" src="<?=$configBase?>/../js/cad_turma.js"></script>
