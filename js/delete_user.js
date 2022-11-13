$(document).on('click', '.delete', function() {
    var user = $(this).parent("td").parent("tr").attr("id");

    var box  = $(this).parent(".box-btn-usu").parent(".box-dados-usu").parent(".container-box")
    var id   = $(this).attr("id");
    var email = $(this).attr("email-data");
    var tipo = $("#tipo").val();
    var data = new FormData();
    var r = confirm("Deseja realmente deletar este usuario?");
    if(r == true){
        data.append('id', id);
        data.append('email', email);
        $.ajax({
            url:"http://localhost/sistema/controllers/usuario_controller.php?&action=delete",
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

                if($("#msg p").hasClass("msg-success")){
                    $("#"+user).hide('slow');
                }

                $('html, body').delay('500').animate({scrollTop : 0},800);
            },
        })  
    }
});

