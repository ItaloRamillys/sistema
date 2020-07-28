<?php 
$query_class_year = "select * from class c";
$stmt_class_year = $conn->query($query_class_year);
$r_class_year = $stmt_class_year->fetchAll(PDO::FETCH_ASSOC);

$options_class_year = "<select class='col-md-6 col-12 my-3' id='turma'><option>Selecione uma turma</option>";
foreach ($r_class_year as $key => $value) {
    $options_class_year .= "<option value='{$value['id_class']}'>{$value['name_class']} - {$value['year']}</option>";
}
$options_class_year .= "</select>";


?>
<div class="container">
  <div class="box">
    <div class="div-title-box">
        <span class="title-box-main  d-flex justify-content-center">Aulas na escola</span>
    </div>   
        <div class="container">
            <div class="row justify-content-center">
                <?=$options_class_year?>
            </div>
            <div class="row">
                <table class="table table-hover text-center">
                    <thead>
                        <th>Turma - Disciplina</th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>

            <div class="row">
                <table class=" table table-hover">
                    <thead>
                        <th>Horários</th>
                        <th>Segunda-feira</th>
                        <th>Terça-feira</th>
                        <th>Quarta-feira</th>
                        <th>Quinta-feira</th>
                        <th>Sexta-feira</th>
                    </thead>
                    <tbody id='body_table'>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>   
$(document).on('change', '#turma', function(e) {
    
    var selected = $(this).find('option:selected').val();
    $.ajax({
      type:"GET",
      url:"http://localhost/sistema/painel/ajax/ver_turma_controle.php?data="+selected,
      dataType: "json",
      success: function(retorno, jqXHR){
        if(retorno[0]['shift'] == 0){
            document.getElementById('body_table').innerHTML = "<tr><td>07:00 - 07:50</td></tr><tr><td>07:50 - 08:40</td></tr><tr><td>Intervalo</td></tr><tr><td>09:00 - 09:50</td></tr><tr><td>09:50 - 10:40</td></tr>"; 
        }else if(retorno[0]['shift'] == 1){
            document.getElementById('body_table').innerHTML = "<tr><td>13:00 - 13:50</td></tr><tr><td>13:50 - 14:40</td></tr><tr><td>Intervalo</td></tr><tr><td>15:00 - 15:50</td></tr><tr><td>15:50 - 16:40</td></tr>"; 
        }else if(retorno[0]['shift'] == 2){
            document.getElementById('body_table').innerHTML = "<tr><td>18:00 - 18:50</td></tr><tr><td>18:50 - 19:40</td></tr><tr><td>Intervalo</td></tr><tr><td>20:00 - 20:50</td></tr><tr><td>20:50 - 21:40</td></tr>"; 
        }

        console.log(retorno);
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
<script src='http://localhost/sistema/js/.js'></script>



