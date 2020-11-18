<?php
$slug_noticia = sanitize_url_data($configUrl[2]);
$msg_not_found_news = "";
$query_editar_noticia = "select * from news where slug_news = '{$slug_noticia}'";
$stmt_editar_noticia = $conn->query($query_editar_noticia);
$dados_editar_noticia = $stmt_editar_noticia->fetch(PDO::FETCH_ASSOC);
if($dados_editar_noticia){
  $title_news = $dados_editar_noticia['title_news'];
  $desc_news = $dados_editar_noticia['desc_news'];  
  $img_news = $dados_editar_noticia['img_news'];
}else{
  $msg_not_found_news = "Noticia nao encontrada. Verifique o slug da noticia em sua URL.";
}
?>
<div class="container">
  <div class="row">
    <div class="col-md-9 col-12">
      <div id="msg"></div>
      <div class="box">
        <header class="div-title-box">
         <h1 class="title-box-main  d-flex justify-content-center">Cadastro de notícia</h1>
        </header>
        <div class="div-content-box">
          <form class="" id="form" method="POST" enctype="multipart/form-data">
            
            <div class="field-cad">
             	<ul class="list-data-form list-data-form-center">

                <?php
                  if($msg_not_found_news){
                ?>
                  <div class="msg msg-error"><?=$msg_not_found_news?></div>
                <?php
                  }else{ 
                ?>

                <input type="hidden" name="id_news" value="<?=$dados_editar_noticia['id_news']?>">
             		
                <li><label>Título da notícia</label></li>
                <li><input type="text" name="title_news" placeholder="Título da notícia" value="<?=$title_news?>" required></li>
               		
                <li><label>Descrição da notícia</label></li>
                <li class="txt-area"><textarea form="cad_noticia" name="desc_news" id="desc" class="rounded p-2" required><?=$desc_news?>
                </textarea></li>

                <li><label>Imagem de destaque</label></li>
                <li>
                  <label for="img-upload" class="btn btn-sm btn-primary">
                    Enviar Imagem
                  </label>
                  <input id="img-upload" name="img_news" type="file" style="display:none;">
                  <label id="file-name"></label>
                  <li class="my-2">
                    <img src="http://localhost/sistema/img/<?=$img_news?>"  id="img1" width="200" height="200">
                  </li>
                </li>
                <li>
                  <input class="btn btn-sm btn-primary" id="btn-cad-aluno" type="submit" name="" value="Editar">
                </li>

              <?php  } ?>

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
<script src='<?="{$configBase}"?>/../js/edit_news.js'></script>

