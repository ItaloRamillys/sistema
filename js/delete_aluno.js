$(document).on('click', '.delete', function() {
    var box  = $(this).parent(".box-btn-usu").parent(".box-dados-usu").parent(".container-box")
    var id = $(this).attr("id");
    var data = new FormData();
    var r = confirm("Deseja realmente deletar este usuario?");
    if(r == true){
        data.append('id',id);
        $.ajax({
            url:"http://localhost/sistema/controllers/usuario_controller.php?src=aluno&action=delete",
            type:'POST',
            data: data,
            dataType: "text",
            processData: false,
            contentType: false,
            success:function(retorno, jqXHR){
                if(retorno == "true"){
                    msg = "<p class='msg msg-success'> <span> Usuário excluido com sucesso </span> <i class='fas fa-times-circle icon-close btn'></i> </p>";
                    box.remove();
                }else{
                    msg = "<p class='msg msg-error'> <span> Erro ao excluir usuário </span> <i class='fas fa-times-circle icon-close btn'></i> </p>";
                }
                $('#msg').html(msg); 
                msg = "";
                $(".icon-close").click(function(e) {
                    $(e.target).parent(".msg").remove();
                });
                console.log(retorno);
                console.log(data);
            },
        })  
    }
});

