var file;
$('#file-upload').change(function (event) {
	file = event.target.files[0]; 
	fileName = file.name;
	$("#file-name").text(fileName);
});
$('#form-atividade').submit(function(e) {
	e.preventDefault();
	data = new FormData();
	var x = $("#form-atividade").find("input");
	x.each(function(){
		data.append(this.name, this.value);
	});
	data.append('file_activity', file);
	var msg = "";
	
	$.ajax({
		type:"POST",
		url:"http://localhost/sistema/controllers/atividade_controller.php?action=edit",
		data:data,
		dataType: "json",
		success: function(retorno, jqXHR){
			msg = retorno;
 			$('#msg').append(msg); 
 			msg = "";
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
	        console.log(msg_error);
		},
	});
});
