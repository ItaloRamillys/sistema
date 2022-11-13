$(document).on('change', '#turma', function(e) { 
    var selected = $(this).find('option:selected').val();
    $("#title_table").text($(this).find('option:selected').text());
    $.ajax({
      type:"GET",
      url:"http://localhost/sistema/painel/ajax/ver_turma_controle.php?data="+selected,
      dataType: "json",
      success: function(retorno, jqXHR){
        var r = retorno;
        var array_time = [];

        if(retorno[0]['shift'] == 0){
            array_time.push('07:00 - 07:50');
            array_time.push('07:50 - 08:40');
            array_time.push('09:00 - 09:50');
            array_time.push('09:50 - 10:40');
        }else if(retorno[0]['shift'] == 1){
            array_time.push('13:00 - 13:50');
            array_time.push('13:50 - 14:40');
            array_time.push('15:00 - 15:50');
            array_time.push('15:50 - 16:40');
        }else if(retorno[0]['shift'] == 2){
            array_time.push('18:00 - 18:50');
            array_time.push('18:50 - 19:40');
            array_time.push('20:00 - 20:50');
            array_time.push('20:50 - 21:40');
        }else{
            array_time.push('Horário não especificado');
            array_time.push('Horário não especificado');
            array_time.push('Horário não especificado');
            array_time.push('Horário não especificado');
        }

        var data_table = "";

        for (var i = 1; i <= 4; i++) {
            data_table += "<tr>";
            for (var j = 0; j <= 5; j++) {
                if(j == 0){
                    data_table += "<td class='time_table'>" + array_time[i-1] + "</td>";
                }else{
                    data_table += "<td id='"+j+""+i+"' value=''></td>";
                }
            }  
            data_table += "</tr>"; 
        }

        document.getElementById('body_table').innerHTML = data_table;

        if(r[1].length >= 1){
            for(var i = 0; i < r[1].length; i++){
                var id = String(r[1][i]['day_of_week']) + String(r[1][i]['order_lesson']);
                document.getElementById(id).innerHTML = r[1][i]['name_subject'] + "<br><button class='btn btn-sm btn-primary remove_lesson' value='"+r[1][i]['id_recurrence_lesson']+"'>Remover</button>";
            }
        }
        
        $("#table tbody tr td").each(function(){
            if($(this).text()==""){
                $(this).text("Sem aula");
            }
        });
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