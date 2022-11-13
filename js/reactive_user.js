$(document).on('click', '.reactivate', function() {
    var box  = $(this).parent(".box-btn-usu").parent(".box-dados-usu").parent(".container-box");
    var id   = $(this).attr("id");
    var email = $(this).attr("email-data");
    var tipo = $("#tipo").val();
    var data = new FormData();
    var r = confirm("Deseja realmente reativar este usuario?");
    if(r == true){
        data.append('id', id);
        data.append('email', email);
        $.ajax({
            url:"http://localhost/sistema/controllers/usuario_controller.php?src="+tipo+"&action=reactivate",
            type:'POST',
            data: data,
            dataType: "json",
            processData: false,
            contentType: false,
            success:function(retorno, jqXHR){
                var msg = retorno;
                $('#msg').append(msg); 
                $(".icon-close").click(function(e) {
                    $(e.target).parent(".msg").remove();
                });
                
                $('html, body').delay('200').animate({scrollTop : 0},800);

            },
        })  
    }
});

