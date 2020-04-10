$('#form').submit(function(e) {
	e.preventDefault();
	var data = $("#form").serialize();
	var b = false;
	var msg = "";
	$("#form").find('input').each(function(index, elem){
	   if($(elem).val().length == 0){
	       b = true;
	   }
	});
	if(!b){
		$.ajax({
			type:"POST",
			url:"../controllers/disc_controller.php",
			data:data,
			dataType: "json",
			success: function(retorno, jqXHR){
				if(retorno){
					$('#form')[0].reset();
					msg = "<p class='msg msg-success'> Disciplina cadastrada com sucesso </p>";
				}else{
					msg = "<p class='msg msg-error'> Falha ao cadastrar disciplina </p>";
				}
				$("#msg").children().each(function() {
				    $(this).remove();
				    console.log("Removendo");
				});
     			$('#msg').html(msg); 
     			msg = "";
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
    		},
		});
	}else{
		alert("Preencha todos os campos");
	}
});
