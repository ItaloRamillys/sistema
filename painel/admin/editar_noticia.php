<?php

$slug_noticia = $configUrl[2];
$query_editar_noticia = "select * from noticia where slug = '{$slug_noticia}'";
$stmt_editar_noticia = $conexao->query($query_editar_noticia);
$dados_editar_noticia = $stmt_editar_noticia->fetch(PDO::FETCH_ASSOC);

?>

<div class="container">
  <div id="msg"></div>
  <div class="row">

  <div class="col-md-9 col-12">
  <div class="box">
  <header class="div-title-box">
   <h1 class="title-box-main  d-flex justify-content-center">Cadastro de notícia</h1>
  </header>

  <div class="div-content-box">
    <form class="" id="form" method="POST" enctype="multipart/form-data">
      <div class="field-cad">

       	<ul class="list-data-form list-data-form-center"> 
       		<li><label>Título da notícia</label></li>
          <li><input type="text" name="titulo" placeholder="Título da notícia" required="required" value="<?=$dados_editar_noticia['titulo_ntc']?>"></li>
         		
          <li><label>Descrição da notícia</label></li>
          <li class="txt-area"><textarea form="cad_noticia" name="desc" id="desc" class="rounded p-2" required="required"><?=$dados_editar_noticia['desc_ntc']?>
          </textarea></li>

          <li><label>Imagem de destaque</label></li>
          <li>
            <label for="img-upload" class="custom-file-upload">
              Enviar Imagem
            </label>
            <input id="img-upload" name="img_file" type="file" style="display:none;">
            <label id="file-name"></label>
            <li class="my-2">
              <img src="http://localhost/sistema/img/<?=$dados_editar_noticia['path_img']?>"  id="img1" width="200" height="200">
            </li>
          </li>
          <li>
            <input class="btn btn-primary" id="btn-cad-aluno" type="submit" name="" value="Cadastrar">
          </li>
        </ul>
	    </div>	
   </form>
  </div>
</div>
</div>
<div class="col-md-3 col-12">
      <?php require("{$configThemePath}/sidebar.php"); ?>
    </div>
</div>
</div>

<script>
$(function(){
$('#img-upload').change(function(){
const file = $(this)[0].files[0]
const fileReader = new FileReader()
fileReader.onloadend = function(){
  $('#img1').attr('src', fileReader.result)
}
fileReader.readAsDataURL(file)
})
})

</script>
<script src='<?="{$configBase}"?>/../js/cad_news.js'></script>

