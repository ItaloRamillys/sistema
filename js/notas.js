$(document).on('click', '.btn-notas', function(e) {

    var turma_ano = $("#turma_ano").val();
    var data = new FormData();
    data.append('turma_ano', turma_ano);
		$.ajax({
			type:"POST",
			url:"http://localhost/sistema/painel/ajax/turmas_prof.php",
			data:data,
			dataType:"json",
            processData: false,
            contentType: false,
			success: function(retorno, jqXHR){
				var disc_hora_turma = $('#turma_ano option:selected').text();
	            var per = $('#periodo').val();
	            var result = "";
	            if(per == ""){
	                per = "Selecione uma turma e um período por favor";

	                result = "<div class='row justify-content-center'><span class='my-3 bg-dark text-light p-2 rounded'>" + disc_hora_turma + " - " + per +  "</span></div>";

	            }else{
	                per = "Periodo: " + per;
	            

	                if (retorno[0].length == 0) {
	                    retorno = "<div class='p-4'>Nenhum aluno encontrado</div>";  
	                    $('#result-falta').html(retorno); 
	                }else{
	                    result = "<div class='row justify-content-center'><span class='my-3 bg-dark text-light p-2 rounded'>" + disc_hora_turma + " - " + per +  "</span></div>";
	                    for (var i = 0; i < retorno[0].length; i++) {
	                        result += 
	                            "<div class='row p-2'>" +
	                            "<div class='col-6'><div class='row'>" + 
	                            "<div class='col-12 col-md-4'>" + retorno[0][i]['img_profile'] + "</div>" + 
	                            "<div class='col-12 col-md-8 m-auto'><input type='hidden' name='id_usu[]' value='" + retorno[0][i]['id'] + "'>" + 
	                            retorno[0][i]['name'] + " " +retorno[0][i]['last_name'] + 
	                            "</div></div></div>" + 
	                            "<div class='col-6 m-auto p-2'>" + 
	                            "<div class='container'><div class='row'><span class='col-md-5 col-12 d-flex justify-content-center align-items-center'>Insira a nota:</span><div class='col-md-7 col-12 d-flex justify-content-center align-items-center'> <input type='text' name='nota[]'></div></div></div>" +
	                            "</select>" +
	                            "</div> </div>";
	                    }

	                    result += "<input type='submit' class='confirmation btn btn-primary' value='Cadastrar Notas'>";


	                    $('.confirmation').on('click', function(){ return confirm('Deseja realmente incluir estas notas?')});
	                }
	                
	            }
                document.getElementById('result-falta').innerHTML = result;
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
