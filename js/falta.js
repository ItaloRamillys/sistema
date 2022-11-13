$(document).on('click', '.btn-falta', function(e) {

    var turma_ano = $("#class_year").val();
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
				var select = $('#turma_ano option:selected').text();

	            var date = $('#date').val();            

	            var result = "";

	            if (retorno[0].length == 0 || date == "") {
	                x = "<div class='p-4'>Nenhum aluno encontrado</div>";
	                result = "<div class='row justify-content-center'><span class='my-3 bg-dark text-light p-2 rounded'>Escolha uma data</span></div>";
	                $('#result-falta').html(x); 
	            }else{

	                result = "<div class='row justify-content-center'><span class='my-3 bg-dark text-light p-2 rounded'></span></div>";

	                for (var i = 0; i < retorno[0].length; i++) {
	                    result += 
	                        "<article class='row p-2'>" +
	                        "<div class='col-6'><div class='row'>" + 
	                        "<div class='col-12 col-md-3'>" + retorno[0][i]['img_profile'] + "</div>" + 
	                        "<div class='col-12 col-md-9 m-auto'><input type='hidden' name='id_usu[]' value='" + retorno[0][i]['id'] + "'>" + 
	                        retorno[0][i]['name'] + " " +retorno[0][i]['last_name'] + 
	                        "</div></div></div>" + 
	                        "<div class='col-6 m-auto'>" + 
	                        "<select name='tipo_falta[]' class='col-12'>" +
	                        "<option value='p'>Presente</option>" +
	                        "<option value='f'>Falta</option>" +
	                        "<option value='j'>Falta justificada</option>" +
	                        "</select>" +
	                        "</div> </article>";
	                }

	               $('.confirmation').on('click', function(){ return confirm('Deseja realmente incluir esta frequência?')});
	                result += "<input type='' class='confirmation btn btn-primary btn-sm' value='Cadastrar faltas'>";
            }
                $('#result-falta').html(result);
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
