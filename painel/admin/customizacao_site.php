<?php
require_once('C:\xampp\htdocs\sistema\proj_esc_func\connection.php');
$conn = new Connection();
$conn = $conn->connect();
require_once('C:\xampp\htdocs\sistema\painel\functions.php');
$query = "select * from config";
$stmt  = $conn->query($query);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$titulo     = $row['title_site'];
$img_esc    = "http://localhost/sistema/img/" . $row['img_school'];
$img1       = "http://localhost/sistema/img/" . $row['img_featured_1'];
$img2       = "http://localhost/sistema/img/" . $row['img_featured_2'];
$img3       = "http://localhost/sistema/img/" . $row['img_featured_3'];
$desc_school= $row['desc_school'];
$phone_1    = $row['phone_school_1'];
$phone_2    = $row['phone_school_2'];
$phone_3    = $row['phone_school_3'];
$local      = $row['img_local'];
$text_img1  = $row['txt_img_1'];
$text_img2  = $row['txt_img_2'];
$text_img3  = $row['txt_img_3'];
$style      = $row['style'];
?>
<div class="container">
    
  <div class="row">
    <div class="col-md-9 col-12 main-content">
      <div id="msg"></div>
      <div class="box">
        <header class="div-title-box">
          <h1 class="title-box-main d-flex justify-content-center">Configurações do Site</h1>
        </header>
        <div class="div-content-box">
          <form id="form" method="POST" enctype="multipart/form-data">
            <div class="row justify-content-center">
              <div class="divisao-cad col-12">
                <article>
                  <header>
                    <h2 class="title-div-form">Dados da Escola</h2>
                  </header>
                  <ul class="list-data-form mt-3"> 
                    <li>
                      <label>Título do site/Nome da escola</label>
                    </li>
                    <li>
                      <input type="text" name="title_site" placeholder="Título da site" value= "<?php echo $titulo;  ?>">
                    </li>
                    <li>
                      <li style="display: flex; justify-content: space-around;">
                        <label for="file_upload_school" class="btn btn-sm btn-primary my-2">
                          Enviar Imagem da Escola
                        </label>
                    
                        <input id="file_upload_school" name="img_school" type="file" value="" style="display:none;">
                      </li>
                    </li>
                    <li style="display: flex; justify-content: space-around;">
                        <img src="<?php echo $img_esc;  ?>" id="img_school" width="200px" height="160px" >
                    </li>


                    <li>
                      <label>Descrição da Escola</label>
                    </li>
                    <li class="txt-area">
                      <textarea form="cad_noticia" name="desc_school" class="p-2"><?php echo $desc_school;  ?></textarea>
                    </li>

                    <li><label>Contato 1</label></li>
                    <li class="txt-area">
                      <input type="text" name="phone_school_1" class=" p-2" value="<?php echo $phone_1;?>">
                    </li>

                    <li><label>Contato 2</label></li>
                    <li class="txt-area">
                      <input type="text" name="phone_school_2" class=" p-2" value="<?php echo $phone_2;?>">
                    </li>

                    <li><label>Contato 3</label></li>
                    <li class="txt-area">
                      <input type="text" name="phone_school_3" class=" p-2" value="<?php echo $phone_3;?>">
                    </li>

                    <li><label>Estilo do site</label></li>
                    <li class="img-area col-12">
                      <div class="row">
                        <?php 
                        for ($i=1; $i <= 7; $i++) { 
                          $check = "";
                          if($i == $style){
                            $check = "checked";
                          }
                        ?>

                        <div class="col-6 col-md-4 my-2">
                          <label>Estilo <?=$i?></label>
                          <img src="<?=$configBase."/../img/sistema/theme_css_" . $i . ".png"?>" width="150" height="120" class="img_css">
                          <input type="radio" name="style" class=" p-2" value="<?=$i?>" <?=$check?>>
                        </div>
                        
                        <?php
                        }
                        ?>
                      </div>
                    </li>

                  </ul>
                </article>
            </div>
            <div class="divisao-cad col-12">
              <article>
                <header>
                  <h2 class="title-div-form">Notícias importantes</h2>
                </header>
                <ul class="list-data-form">
                  <li>
                    <label>Texto Imagem 1</label>  
                  </li>
                  <li>
                    <input type="text" name="txt_img_featured_1" value ="<?php echo $text_img1; ?>" maxlength="80">
                  </li>
                  <li>
                    <label for="file_upload1" class="btn btn-sm btn-primary my-2">
                      Enviar Imagem 1
                    </label>
                    <input id="file_upload1" name="img_featured_1" type="file" value="" style="display:none;">
                  </li>
                  <li>
                    <label>Texto Imagem 2</label>
                  </li>
                  <li>
                    <input type="text" name="txt_img_featured_2" value ="<?php echo $text_img2; ?>" maxlength="80">
                  </li>
                  <li>
                    <label for="file_upload2" class="btn btn-sm btn-primary my-2">
                      Enviar Imagem 2
                    </label>
                    <input id="file_upload2" name="img_featured_2" type="file" value="" style="display:none;">
                  </li>
                  <li> 
                    <label>Texto Imagem 3</label>
                  </li>
                  <li>
                    <input type="text" name="txt_img_featured_3" value ="<?php echo $text_img3; ?>" maxlength="80">
                  </li>
                  <li>
                    <label for="file_upload3" class="btn btn-sm btn-primary my-2">
                      Enviar Imagem 3
                    </label>
                    <input id="file_upload3" name="img_featured_3" type="file" value="" style="display:none;">
                  </li>
                  <li style="display: flex; justify-content: space-around;">
                      
                      <img src="<?php echo $img1;  ?>" id="img1" width="120px" height="120px" >
                      <img src="<?php echo $img2;  ?>" id="img2" width="120px" height="120px" >
                      <img src="<?php echo $img3;  ?>" id="img3" width="120px" height="120px" >

                  </li>
                  </ul>
                </article>
              </div>	
              <input class="btn btn-primary my-2" type="submit" name="" value="Cadastrar">
            </div>
         </form>
        </div>
      </div>
    </div>
    <div class="col-md-3 col-12 sidebar">
      <?php require("{$configThemePath}/sidebar.php"); ?>
    </div>
  </div>
  <div id="overlay">
  </div>
</div>

<script src='http://localhost/sistema/js/config_site.js'></script>
<script>
$(function(){
  $('#file_upload_school').change(function(){
    const file = $(this)[0].files[0]
    const fileReader = new FileReader()
    fileReader.onloadend = function(){
      $('#img_school').attr('src', fileReader.result)
    }
    fileReader.readAsDataURL(file)
  })
})
$(function(){
  $('#file_upload1').change(function(){
    const file = $(this)[0].files[0]
    const fileReader = new FileReader()
    fileReader.onloadend = function(){
      $('#img_featured_1').attr('src', fileReader.result)
    }
    fileReader.readAsDataURL(file)
  })
})
$(function(){
  $('#file_upload2').change(function(){
    const file = $(this)[0].files[0]
    const fileReader = new FileReader()
    fileReader.onloadend = function(){
      $('#img_featured_2').attr('src', fileReader.result)
    }
    fileReader.readAsDataURL(file)
  })
})
$(function(){
  $('#file_upload3').change(function(){
    const file = $(this)[0].files[0]
    const fileReader = new FileReader()
    fileReader.onloadend = function(){
      $('#img_featured_3img_featured_3').attr('src', fileReader.result)
    }
    fileReader.readAsDataURL(file)
  })
})

// Image to Lightbox Overlay 
$('.img_css').on('click', function() {
  $('#overlay')
    .css({backgroundImage: `url(${this.src})`})
    .addClass('open')
    .one('click', function() { $(this).removeClass('open'); });
});
</script>
<style type="text/css">
.img_css{
  cursor: pointer;
}  
#overlay{
  position: fixed;
  top:20px;
  left:20px;
  width: calc(100% - 40px);
  height: calc(100% - 40px);
  background: rgba(0,0,0,0.5) none 50% / contain no-repeat;
  cursor: pointer;
  transition: 0.3s; 
  visibility: hidden;
  opacity: 0;
}
#overlay.open {
  visibility: visible;
  opacity: 1;
}
#overlay:after { /* X button icon */
  content: "\2715";
  position: absolute;
  color:#fff;
  top: 10px;
  right:20px;
  font-size: 2em;
}
</style>


