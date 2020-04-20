<?php

require_once('proj_esc_func\conexao.php');
$conexao = new Conexao();
$conexao = $conexao->conectar();
//SETANDO AS CONFIGURAÇÕES DA PAGINA INICIAL
$query = "select * from config";
$stmt  = $conexao->query($query);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$titulo     = $row['titulo_site'];
$img_esc    = $row['img_escola'];
$img1       = "img/" . $row['img_dest1'];
$img2       = "img/" . $row['img_dest2'];
$img3       = "img/" . $row['img_dest3'];
$desc_esc   = $row['desc_esc'];
$contato    = $row['contato'];
$local      = $row['img_local'];
$txt_img1  = $row['txt_img1'];
$txt_img2  = $row['txt_img2'];
$txt_img3  = $row['txt_img3'];

?>
<!DOCTYPE html>
<html>
    <head>

        <meta name="viewport" charset="utf-8" content="width=device-width, initial-scale=1.0">
        <script src="js/jquery.js"></script>
        <script src="js/load.js"></script>
        <title><?php echo $titulo; ?></title>
        <link href="css/index.css" rel="stylesheet" type="text/css"/>
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v1.7.0/mapbox-gl.js'></script>
        <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v1.7.0/mapbox-gl.css' rel='stylesheet'/>
        

    </head>
   
    <body>

        <?php include 'nav.php'; ?>

        <section class="main">
            <img src="img/padrao/carregar.gif" width="100" height="100" style="display: block;margin: 250px auto;">
        </section>

        <?php include 'form_login.php' ?>

        <?php include 'footer.php' ?>

    </body>

    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script>

        $(document).ready(function() {
            $('#show-login').click(function(e) {
                $('#login').toggle(300);
                    e.stopPropagation();
            });
        });

        $(document).ready(function() {
            $('#close-login').click(function(e) {
                $('#login').toggle(400);
                    e.stopPropagation();
            });
        });

    </script>

  <?php 
    if(isset($_GET['login']) && $_GET['login'] == 'erro'){
        ?>
        <script>

          $('#show-login').ready(function(e) {
              $('#login').toggle(300);
                  e.stopPropagation();
          });

      </script>
        <?php
    }
  ?>


</html>



