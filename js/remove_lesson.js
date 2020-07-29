$(document).on('click', '.remove_lesson', function() {
	
	var id = $(this).val();
	data = new FormData();
	data.append('id_recurrence_lesson', id);
	
		$.ajax({
			type:"POST",
			url:"http://localhost/sistema/controllers/recorrencia_aula_controller.php?action=delete",
			data:data,
			dataType: "json",
			processData: false,
    		contentType: false,
			success: function(retorno, jqXHR){
				msg = retorno;
     			$('#msg').append(msg);
		     	$(".icon-close").click(function(e) {
		        	$(e.target).parent(".msg").remove();
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
		        alert(msg_error + " - " + jqXHR.responseText);
    		},
		});	
});
