var file1, file2, file3, fileE;
var bool_img1 = bool_img2 = bool_img3 = bool_imgE = false;

$('#file_upload_school').change(function (event) {
	fileE = event.target.files[0]; 
	fileName = fileE.name;
	$("#file_upload_esc-name").text(fileName);
	bool_imgE = true;
});
$('#file_upload1').change(function (event) {
	file1 = event.target.files[0]; 
	fileName1 = file1.name;
	$("#file-name1").text(fileName1);
	bool_img1 = true;
});
$('#file_upload2').change(function (event) {
	file2 = event.target.files[0]; 
	fileName2 = file2.name2;
	$("#file-name2").text(fileName2);
	bool_img2 = true;
});
$('#file_upload3').change(function (event) {
	file3 = event.target.files[0]; 
	fileName3 = file3.name;
	$("#file-name3").text(fileName3);
	bool_img3 = true;
});

$('#form').submit(function(e) {
	e.preventDefault();
	data = new FormData();
	
	var x = $("#form").find('input[type="text"]');
	x.each(function(){
		data.append(this.name, this.value);
	});

	var y = $("#form").find("textarea");
	y.each(function(){
		data.append(this.name, this.value);
	});

	if(bool_imgE){
		data.append('img_school', fileE);
	}else{
		data.append('img_school', '');
	}

	if(bool_img1){
		data.append('img_featured_1', file1);
	}else{
		data.append('img_featured_1', '');
	}

	if(bool_img2){
		data.append('img_featured_2', file2);
	}else{
		data.append('img_featured_2', '');
	}

	if(bool_img3){
		data.append('img_featured_3', file3);
	}else{
		data.append('img_featured_3', '');
	}

	data.append('style', $("input[type='radio']:checked").val());
	
	var msg = ""

		$.ajax({
			type:"POST",
			url:"http://localhost/sistema/controllers/config_controller.php",
			data:data,
			dataType: "text",
			processData: false,
    		contentType: false,
			success: function(retorno, jqXHR){
				if(retorno == "true"){
					msg = "<p class='msg msg-success'> <span> Dados atualizados com sucesso </span> <i class='fas fa-times-circle icon-close btn'></i> </p>";
				}else{
					msg = "<p class='msg msg-error'> <span> Falha ao atualizar dados </span> <i class='fas fa-times-circle icon-close btn'></i> </p>";
				}

     			$('#msg').append(msg); 

     			$('html, body').animate({scrollTop : 0},500);

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
