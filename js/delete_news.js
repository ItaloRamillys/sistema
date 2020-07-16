$(document).on('click', '.delete', function() {
    var id   = $(this).attr("id");
    var slug = $(this).attr("data-slug");
    var data = new FormData();
    var r = confirm("Deseja realmente deletar esta notícia?");
    if(r == true){
        data.append('id_news', id);
        data.append('slug_news', slug);
        $.ajax({
            url:"http://localhost/sistema/controllers/noticia_controller.php?action=delete",
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
            },
        })  
    }
});

