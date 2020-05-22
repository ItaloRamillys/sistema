
<div id="msg"></div>
<div class="container">
  <div class="row">

<div class="box col-9">
  <header class="div-title-box">
   <h1 class="title-box-main  d-flex justify-content-center">Cadastro de notícia</h1>
  </header>

  <div class="div-content-box">
    <form class="" id="form" method="POST" enctype="multipart/form-data">
      <div class="field-cad">

       	<ul class="list-data-form list-data-form-center"> 
       		<li><label>Título da notícia</label></li>
          <li><input type="text" name="titulo" placeholder="Título da notícia" required="required"></li>
         		
          <li><label>Descrição da notícia</label></li>
          <li class="txt-area"><textarea form="cad_noticia" name="desc" id="desc" class="rounded p-2 "  required="required"></textarea></li>

          <li><label>Imagem de destaque</label></li>
          <li>
            <label for="img-upload" class="custom-file-upload">
              Enviar Imagem
            </label>
            <input id="img-upload" name="img_file" type="file" style="display:none;">
            <label id="file-name"></label>
            <li>

              <img src="http://localhost/sistema/img/padrao/camera.svg"  id="img1" width="200" height="200">
              
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
<div class="col">
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

