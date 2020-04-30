var file;
$('#file-upload1').change(function (event) {
	file = event.target.files[0]; 
	fileName = file.name;
	$("#file-name").text(fileName);
    // para apenas 1 arquivo
    //var name = event.target.files[0].content.name;
    // para capturar o nome do arquivo com sua extenção
});
$('#form').submit(function(e) {
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
	$("#form").find('input').each(function(index, elem){
	   if($(elem).val().length == 0){
	       b = true;
	   }
	});
	if(!b){
		$.ajax({
			type:"POST",
			url:"http://localhost/sistema/controllers/usuario_controller.php?src="+tipo+"&action=cad",
			data:data,
			dataType: "text",
			processData: false,
    		contentType: false,
			success: function(retorno, jqXHR){
				if(retorno == "true"){

					$('#form')[0].reset();
					$('#file-upload1').val('');
					msg = "<p class='msg msg-success'> Usuário cadastrado com sucesso </p>";

				}else{

					msg = "<p class='msg msg-error'> Falha ao cadastrar usuário </p>";

					console.log(retorno);
					
				}
     			$('#msg').html(msg); 
     			msg = "";
     			
     			$("#img1").attr('src', 'http://localhost/sistema/img/icon-profile.png');
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
	}else{
		alert("Preencha todos os campos");
	}
});
