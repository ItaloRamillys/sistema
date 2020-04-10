<?php
  include_once('C:\xampp\htdocs\sistema\authentic.php');
  if($_SESSION['tipo'] != 2){
    header("Location: inicio.php?perm=erro_perm");
  }
    require "../functions.php";
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>S.E.P.O.</title>
        <?php 

        //Import bootstrap.min.css, bootstrap.min.js, jquery, css and fonts
        include_once 'import_head.php';

      ?>
    </head>

  
    <body>
      
    <?php 
      require '../profile.php';
    ?>
        
    <div class="row m-0">

       <?php
         require '../menu.php';            
       ?>
         
        <div class="col-md-10 col-sm-12">
          <div id="msg"></div>
          <div class="container">
            <div class="row">

          <div class="box col-12 p-0">
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
                        
                        <img src="../img/padrao/cam.png" id="img1" width="300" height="250">

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
      </div>
      </div>
      </div>
    </body>
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
    <?php include '../footer.php'; ?>
    <script src='../js/cad_news.js'></script>
</html>

