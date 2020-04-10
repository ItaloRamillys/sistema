<?php
  include_once('C:\xampp\htdocs\sistema\authentic.php');
if($_SESSION['tipo'] != 2){
  header("Location: inicio.php?perm=erro_perm");
}
require_once('../functions.php');
require_once('C:\xampp\proj_esc_func\conexao.php');

$conexao = new Conexao();
$conexao = $conexao->conectar();
$id_ntc = $_GET['news_id'];

$query = "select * from noticia where id_ntc = " . $id_ntc;
$stmt = $conexao->query($query);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$titulo_row = $row['titulo_ntc'];
$desc_row   = $row['desc_ntc'];
$img_row    = "../img/" . $row['path_img'];

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
          <div class="container">
            <div class="row">
              <?php 
                    msg_callback('Notícia editada com sucesso.', 'Notícia não editada. A descrição deve conter entre 20 e 400 caracteres. A imagem deve ser menor que 5MB e se do tipo .jpg ou .jpeg ou .png.', 'edit');
                    if (isset($_GET['error_img']) && $_GET['error_img'] == 1) {
                      echo "
                      <div class='msg-cad cad-warn'>
                          Algum problema ocorreu ao fazer o upload da imagem. Verifique o tamanho e o tipo do arquivo escolhido.
                      </div>" ;
                }
              ?>

          <div class="box col-12 p-0">
            <header class="div-title-box">
             <h1 class="title-box-main  d-flex justify-content-center">Editar notícia</h1>
            </header>

            <div class="div-content-box">
			        <form class="" id="cad_noticia" action="../controllers/noticia_controller.php?action=edit" method="POST" enctype="multipart/form-data">
                <div class="field-cad">

			           	<ul class="list-data-form list-data-form-center"> 
			           		<li><label>Título da notícia</label></li>
					          <li><input type="text" name="titulo" placeholder="Título da notícia" value="<?php echo $titulo_row; ?>" required="required"></li>
				           		
                    <li><label>Descrição da notícia</label></li>
                    <li class="txt-area"><textarea form="cad_noticia" name="desc" class="rounded p-2 " required="required"> <?php echo $desc_row; ?></textarea></li>

                    <li><label>Imagem de destaque</label></li>
                    <li>
                      <label for="file-upload1" class="custom-file-upload">
                        Enviar Imagem
                      </label>
                      <input id="file-upload1" name="img_file" type="file" style="display:none;">
                      <label id="file-name"></label>
                      <li>
                        
                        <img src="<?= $img_row ?>" id="img1" width="300" height="250">

                      </li>
                    </li>
                    
                    <li>
                      <input type="hidden" name="id_ntc" value="<?php echo $id_ntc; ?>">
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
    <?php include '../footer.php'; ?>
    
    </body>
    <script>
      $(function(){
        $('#file-upload1').change(function(){
          const file = $(this)[0].files[0]
          const fileReader = new FileReader()
          fileReader.onloadend = function(){
            $('#img1').attr('src', fileReader.result)
          }
          fileReader.readAsDataURL(file)
        })
      })
     
    </script>
</html>

