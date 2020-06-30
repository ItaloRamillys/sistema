$(document).on('click', '.btn-modal-activity', function(e) {
	e.preventDefault();
    var id   = $(this).attr("id");
    var data = new FormData();
    data.append('id_atv', id);
		$.ajax({
			type:"POST",
			url:"http://localhost/sistema/painel/ajax/activity.php",
			data:data,
			dataType: "json",
            processData: false,
            contentType: false,
			success: function(retorno, jqXHR){
				console.log(retorno);
				$("#container-modal .modal .modal-title-activity").val(retorno.title);
				$("#container-modal .modal .modal-desc-activity").val(retorno.desc);
				$("#container-modal .modal .modal-datetime-activity").text(retorno.create_at);
     			$("#container-modal").removeClass("container-modal-hidden");
     			$("#agenda").addClass("blur");

     			$(document).on('click', 'body', function(e){
     				if(e.target.className != "modal" && $(e.target).attr("data-type") != "modal-text"){
     					$("#container-modal").addClass("container-modal-hidden");
     					$("#agenda").removeClass("blur");
     				}
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
		        alert(msg_error);
    		},
		});	
});
