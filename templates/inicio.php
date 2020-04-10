<?php
include_once('C:\xampp\htdocs\proj_esc\authentic.php');
include_once('C:\xampp\htdocs\proj_esc\news.php');

//Checagem de permissão

if(isset($_GET['perm']) && $_GET['perm'] = 'erro_perm'){

  if($_SESSION['tipo'] == 0){
    $tipo = "ALUNO";  
  }else if($_SESSION['tipo'] == 1){
    $tipo = "PROFESSOR";
  }else if($_SESSION['tipo'] == 2){
    $tipo = "ADMINISTRADOR";
  }else{
    $tipo = "INVÁLIDO";
  }

  echo "<script> alert('Você não possui permissão para acessar este conteúdo. Você é um {$tipo}'); </script>";  

}

require_once('C:\xampp\proj_esc_func\conexao.php');

$conexao = new Conexao();

$conexao = $conexao->conectar();

$id_escola = $_SESSION['escola'];

//PEGANDO OS DADOS DO BD PARA CRIAR A PAGINA

$query = "select * from config";
$stmt  = $conexao->query($query);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
  $titulo     = $row['titulo_site'];
  $img_esc    = $row['img_escola'];
  $img1       = "../img/" . $row['img_dest1'];
  $img2       = "../img/" . $row['img_dest2'];
  $img3       = "../img/" . $row['img_dest3'];
  $desc_esc   = "../img/" . $row['desc_esc'];
  $contato    = $row['contato'];
  $local      = $row['img_local'];
  $txt_img1  = $row['txt_img1'];
  $txt_img2  = $row['txt_img2'];
  $txt_img3  = $row['txt_img3'];

?>
<html>
  <head>
      <title>S.E.P.O.</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <?php 

      //Import bootstrap.min.css, bootstrap.min.js, jquery, css and fonts
      include_once 'import_head.php';

    ?>
      
  </head>

  <body>
    <?php 
      require '../profile.php';
    ?>
          
    <div class="container-fluid d-flex">
      
    <div class="row">
      <?php
         require '../menu.php';          
      ?>

      <div class="col-md-10 pb-4">
          <div class="row">
            
            <?php 
              if($_SESSION['tipo'] == 2){ 
                include "dash_admin.php";
              }
            ?>

            <div class="col-md-12 col-sm-12">
              <section class="box pb-2">
                
                <header class="div-title-box">
                  <h1 class="title-box-main d-flex justify-content-center">Destaques</h1>
                </header>

                <div class="col-12 slideshow-container">

                      <div class="mySlides fade">
                          <div class="numbertext">1 / 3</div>
                          <img src="<?= $img1 ?>">
                          <div class="text"><?= $txt_img1 ?></div>
                      </div>

                      <div class="mySlides fade">
                          <div class="numbertext">2 / 3</div>
                          <img src="<?= $img2 ?>">
                          <div class="text"><?= $txt_img2 ?></div>
                      </div>

                      <div class="mySlides fade">
                          <div class="numbertext">3 / 3</div>
                          <img src="<?= $img3 ?>">
                          <div class="text"><?= $txt_img3 ?></div>
                      </div>

                      <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                      <a class="next" onclick="plusSlides(1)">&#10095;</a>

                  </div>

                <br>

                <div style="text-align:center">
                  <span class="dot" onclick="currentSlide(1)"></span> 
                  <span class="dot" onclick="currentSlide(2)"></span> 
                  <span class="dot" onclick="currentSlide(3)"></span> 
                </div>

                <style type="text/css">
                .fade:not(.show) {
                        opacity: 1;
                    }
                </style>

              </section>
            </div>
            
            <div class="col-md-12 col-sm-12">
              <section class="box">
                <header class="div-title-box">
                  <h1 class="title-box-main d-flex justify-content-center"> Por dentro da escola </h1>
                </header>
               
                <div class="div-content-box">
                  <div class="row">
                
                  <?php showNews('../img/noticia/', $conexao) ?>
              
                  </div>
                </div>
              </section>
            </div>
          </div>
        </div>
      </div>
    </div>                 
  
  <?php include '../footer.php'; ?>
  <script type="text/javascript">
    function redirect(tipo){
      window.location = 'showData.php?type=' + tipo; 
    }

  </script>
  <script type="text/javascript" src="../js/slide.js"></script>
  <script src='https://kit.fontawesome.com/a076d05399.js'></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>

