$('#form-mensagem').submit(function(e) {
	e.preventDefault();
	var data = $("#form-mensagem").serialize();
	var b = false;
	var msg = "";
	
	$.ajax({
		type:"POST",
		url:"http://localhost/sistema/controllers/mensagem_turma_controller.php?action=cad",
		data:data,
		dataType: "json",
		success: function(retorno, jqXHR){
			$('#form-mensagem')[0].reset();
			msg = retorno;
			console.log(retorno);
 			$('#msg-mensagem-turma').append(msg); 
 			msg = "";
	     	$(".icon-close").click(function(e) {
	        	$(e.target).parent("#msg-mensagem-turma").remove();
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
	        console.log(msg_error);
		},
	});
});
