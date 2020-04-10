function delete_img(path, key){
	if(confirm('Deseja realmente excluir esta imagem?')){

		$('html, body').animate({scrollTop:0}, 'medium');
		$.ajax({
			type:'post',
			url:'../functions/delete_img.php',
			data:{path_img:path}
		}).done(function() {
			$('#msg_delete').html("Imagem excluida com sucesso").show();
		  })
		  .fail(function() {
		  	$('#msg_delete').html("Falha ao excluir").show();
		  })
		  .always(function(){
		  	$('#msg_delete').delay(4000).hide(1000);
		  	$('#'+key).hide(4000);
		  });
	}
}