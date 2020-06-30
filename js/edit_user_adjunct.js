$('#form_adjunct').submit(function(e) {
	e.preventDefault();
	data = new FormData();
	var inputs = $("#form").find("input");
	var x = $("#form").find("input");
	x.each(function(){
		data.append(this.name, this.value);
	});
	data.append('img_profile', file);
	var tipo = $("#tipo").val();
	var b = false;
	var msg = "";	
	$.ajax({
			type:"POST",
			url:"http://localhost/sistema/controllers/usuario_controller.php?src="+tipo+"&action=edit",
			data:data,
			dataType:"json",
			processData: false,
    		contentType: false,
			success: function(retorno, jqXHR){
				msg = retorno;
				$("#msg").html(msg);
				$("#file-name").html('Sua imagem');
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
		        alert("ERROR" + msg_error);
    		},
	});	
});
