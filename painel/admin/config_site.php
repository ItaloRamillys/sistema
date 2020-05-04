<?php
include_once('C:\xampp\htdocs\sistema\authentic.php');
if($_SESSION['tipo'] != 2){
header("Location: inicio.php?perm=erro_perm");
}
require_once('C:\xampp\htdocs\sistema\proj_esc_func\conexao.php');
$conexao = new Conexao();
$conexao = $conexao->conectar();
require "../functions.php";
$query = "select * from config";
$stmt  = $conexao->query($query);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$titulo     = $row['titulo_site'];
$img_esc    = "http://localhost/sistema/img/" . $row['img_escola'];
$img1       = "http://localhost/sistema/img/" . $row['img_dest1'];
$img2       = "http://localhost/sistema/img/" . $row['img_dest2'];
$img3       = "http://localhost/sistema/img/" . $row['img_dest3'];
$desc_esc   =  $row['desc_esc'];
$contato    = $row['contato'];
$local      = $row['img_local'];
$text_img1  = $row['txt_img1'];
$text_img2  = $row['txt_img2'];
$text_img3  = $row['txt_img3'];
?>

<div id="msg"></div>
<div class="container">
  <div class="row">
    <div class="col-md-10 col-12">
      <div class="box">
        <header class="div-title-box">
          <h1 class="title-box-main d-flex justify-content-center">Configurações do Site</h1>
        </header>

        <div class="div-content-box">
          <form class="row" id="form" method="POST" enctype="multipart/form-data">
            <div class="divisao-cad col-md-6 col-12">
              <article>
                <ul class="list-data-form mt-3"> 
                  <li><label>Título do site/Nome da escola</label></li>
                  <li><input type="text" name="titulo" placeholder="Título da site" value=  "<?php echo $titulo;  ?>"></li>
                  
                  <li>
                    <li style="display: flex; justify-content: space-around;">
                      <label for="file-upload_esc" class="custom-file-upload">
                        Enviar Imagem da Escola
                      </label>
                  
                      <input id="file-upload_esc" name="img_esc" type="file" value="" style="display:none;">
                    </li>
                  </li>
                  <li style="display: flex; justify-content: space-around;">
                      <img src="<?php echo $img_esc;  ?>" id="img_esc" width="200px" height="160px" >
                  </li>

                  <li><label>Descrição A Escola</label></li>
                  <li class="txt-area">
                    <textarea form="cad_noticia" name="desc_esc" class="rounded p-2"><?php echo $desc_esc;  ?></textarea>
                  </li>

                  <li><label>Descrição do contato</label></li>
                  <li class="txt-area">
                    <textarea form="cad_noticia" name="contato" class="rounded p-2"><?php echo $contato;  ?></textarea>
                  </li>
                </ul>
              </article>
          </div>
          <div class="divisao-cad col-md-6 col-12">
            <article>
              <ul>
                <li>
                  <label>Texto Imagem 1</label>  
                </li>
                <li>
                  <input type="text" name="txt_img1" value ="<?php echo $text_img1; ?>">
                </li>
                <li>
                  <label for="file-upload1" class="custom-file-upload btn btn-outline-secondary my-2">
                    Enviar Imagem 1
                  </label>
                  <input id="file-upload1" name="img1" type="file" value="" style="display:none;">
                </li>
                <li>
                  <label>Texto Imagem 2</label>
                </li>
                <li>
                  <input type="text" name="txt_img2" value ="<?php echo $text_img2; ?>">
                </li>
                <li>
                  <label for="file-upload2" class="custom-file-upload btn btn-outline-secondary my-2">
                    Enviar Imagem 2
                  </label>
                  <input id="file-upload2" name="img2" type="file" value="" style="display:none;">
                </li>
                <li> 
                  <label>Texto Imagem 3</label>
                </li>
                <li>
                  <input type="text" name="txt_img3" value ="<?php echo $text_img3; ?>">
                </li>
                <li>
                  <label for="file-upload3" class="custom-file-upload btn btn-outline-secondary my-2">
                    Enviar Imagem 3
                  </label>
                  
                  <input id="file-upload3" name="img3" type="file" value="" style="display:none;">
                </li>

                <li style="display: flex; justify-content: space-around;">
                    
                    <img src="<?php echo $img1;  ?>" id="img1" width="120px" height="120px" >
                    <img src="<?php echo $img2;  ?>" id="img2" width="120px" height="120px" >
                    <img src="<?php echo $img3;  ?>" id="img3" width="120px" height="120px" >

                </li>

              </ul>

              <input class="btn btn-primary mt-2" type="submit" name="" value="Cadastrar">

            </article>
          </div>	
       </form>
</div>
</div>
</div>
<div class="col-md-2 col-12">
  <?php require("{$configThemePath}/sidebar.php"); ?>
</div>
</div>
</div>

<script src='http://localhost/sistema/js/config_site.js'></script>
<script>
$(function(){
  $('#file-upload_esc').change(function(){
    const file = $(this)[0].files[0]
    const fileReader = new FileReader()
    fileReader.onloadend = function(){
      $('#img_esc').attr('src', fileReader.result)
    }
    fileReader.readAsDataURL(file)
  })
})
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
$(function(){
  $('#file-upload2').change(function(){
    const file = $(this)[0].files[0]
    const fileReader = new FileReader()
    fileReader.onloadend = function(){
      $('#img2').attr('src', fileReader.result)
    }
    fileReader.readAsDataURL(file)
  })
})
$(function(){
  $('#file-upload3').change(function(){
    const file = $(this)[0].files[0]
    const fileReader = new FileReader()
    fileReader.onloadend = function(){
      $('#img3').attr('src', fileReader.result)
    }
    fileReader.readAsDataURL(file)
  })
})
</script>


