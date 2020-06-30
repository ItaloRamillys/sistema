$(document).on('click', '.mostrar-cronograma', function(e) {
	e.preventDefault();
    var turma = $("#turmas_src option:selected").val();
    var data = new FormData();
	var aula_2 = "";
	var aula_3 = "";
	var aula_4 = "";
	var aula_5 = "";
	var aula_6 = "";
    data.append('turma', turma);
		$.ajax({
			type:"POST",
			url:"http://localhost/sistema/painel/ajax/turma_aula.php",
			data:data,
			dataType:"json",
            processData: false,
            contentType: false,
			success: function(retorno, jqXHR){
				console.log(retorno);
				for (var i = 0; i < 20; i++) {
					if(typeof(retorno[0][i]) == 'undefined'){
                        aula_atual = "--";
                    }else{
                        if(retorno[0][i]['dia_da_semana'] == '2'){
                            aula_2 += retorno[0][i]['nome_disc'] + " - " + retorno[0][i]['nome'] + "<br><small>" + retorno[0][i]['horario_de_inicio'] + "-" + retorno[0][i]['horario_de_termino']  + "</small><br>";
                        }else if(retorno[0][i]['dia_da_semana'] == '3'){
                            aula_3 += retorno[0][i]['nome_disc'] + " - " + retorno[0][i]['nome'] + "<br><small>" + retorno[0][i]['horario_de_inicio'] + "-" + retorno[0][i]['horario_de_termino']  + "</small><br>";
                        }else if(retorno[0][i]['dia_da_semana'] == '4'){
                            aula_4 += retorno[0][i]['nome_disc'] + " - " + retorno[0][i]['nome'] + "<br><small>" + retorno[0][i]['horario_de_inicio'] + "-" + retorno[0][i]['horario_de_termino']  + "</small><br>";
                        }else if(retorno[0][i]['dia_da_semana'] == '5'){
                            aula_5 += retorno[0][i]['nome_disc'] + " - " + retorno[0][i]['nome'] + "<br><small>" + retorno[0][i]['horario_de_inicio'] + "-" + retorno[0][i]['horario_de_termino']  + "</small><br>";
                        }else if(retorno[0][i]['dia_da_semana'] == '6'){
                            aula_6 += retorno[0][i]['nome_disc'] + " - " + retorno[0][i]['nome'] + "<br><small>" + retorno[0][i]['horario_de_inicio'] + "-" + retorno[0][i]['horario_de_termino']  + "</small><br>";
                        }
                    }
                }

                $("#aulas_seg").html(aula_2);
                $("#aulas_ter").html(aula_3);
                $("#aulas_qua").html(aula_4);
                $("#aulas_qui").html(aula_5);
                $("#aulas_sex").html(aula_6);

                var participantes = "";

	            for (var i = 0; i < retorno[1].length; i++) {
	                participantes   += "<div class='col-6 col-md-3'> <div class='container'> <div class='row'><div class='col-12'><img src = 'http://localhost/sistema/img/" 
	                                + retorno[1][i]['img_profile'] 
	                                + "' width='90px' height='90px'></div><div class='col-12'> " 
	                                + retorno[1][i]['nome'] + " " + retorno[1][i]['sobrenome']  
	                                + "</div><div class='col-12'>"    
	                                + "</div></div></div></div>";
	            }

	            if(participantes == ""){
	                participantes = "Nenhum aluno cadastrado nessa turma";
	            }

	            document.getElementById('participantes').innerHTML = participantes;
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
