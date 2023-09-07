<?php
session_start();
if($_SESSION){
    header("Location: painel");
}

require_once('painel/functions.php');
require_once('proj_esc_func\connection.php');
$conn = new Connection();
$conn = $conn->connect();

//SETANDO AS CONFIGURAÇÕES DA PAGINA INICIAL
$query = "select * from config";
$stmt  = $conn->query($query);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$titulo = $row['title_site'];

define("BASE", 'http://localhost/sistema');
define("THEME", 'http://localhost/sistema');
define("THEME_PATH", __DIR__);
define("THEME_LINK", BASE);

$configBase = BASE;
$configSiteName = "SEPO";
$configThemePath = THEME_PATH;
$configThemeLink = THEME_LINK;

$configUrl = explode("/", strip_tags(filter_input(INPUT_GET, "url", FILTER_DEFAULT)));

$configUrl[0] = (!empty($configUrl[0]) ? $configUrl[0] : "home");
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $titulo; ?></title>

        <meta name="viewport" charset="utf-8" content="width=device-width, initial-scale=1.0">

        <script src="<?=$configBase?>/js/jquery.js"></script>
        <script src='https://kit.fontawesome.com/a076d05399.js'></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v1.7.0/mapbox-gl.js'></script>
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/all.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>
        <link rel="shortcut icon" href="<?=$configBase?>/img/sistema/favicon.ico">
        <link href="css/index.css" rel="stylesheet" type="text/css"/>
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v1.7.0/mapbox-gl.css' rel='stylesheet'/>      
    </head>
   
    <body>

        <?php include 'nav.php'; ?>

        <div class="main">
            <?php 
            //QUERY STRING
            
            if (file_exists("{$configThemePath}/{$configUrl[0]}.php") && !is_dir("{$configThemePath}/{$configUrl[0]}.php")) {
                //theme root
                require "{$configThemePath}/{$configUrl[0]}.php";
            }elseif (!empty($configUrl[1]) && file_exists("{$configThemePath}/{$configUrl[0]}/{$configUrl[1]}.php") && !is_dir("{$configThemePath}/{$configUrl[0]}/{$configUrl[1]}.php")) {
                //theme folder
                require "{$configThemePath}/{$configUrl[0]}/{$configUrl[1]}.php";
            } else {
                //theme 404
                if (file_exists("{$configThemePath}/404.php") && !is_dir("{$configThemePath}/404.php")) {
                    require "{$configThemePath}/404.php";
                } else {
                    echo "<div class='container'><div class='trigger trigger-error icon-error radius'>Desculpe, mas a página não existe!</div></div>";
                }
            }
          ?>
        </div>

        <?php include 'form_login.php' ?>

        <?php include 'footer.php' ?>

    </body>
	<script src="<?=$configBase?>/js/jquery.waypoints.min.js" type="text/javascript"></script>
	<script src="<?=$configBase?>/js/animate.js" type="text/javascript"></script>

	<script>
        var flag = 0;
        $(document).ready(function() {
            $('#btn-login').click(function(e) {
                flag = 1;
                $('#login').toggle(300);
                $("#user").focus();
                e.stopPropagation();
                $('body').click(function(e){
                    if($(e.target).attr('data-type')!='modal-login' && flag == 1){
                        $('#login').toggle(400);
                        flag = 0;
                        e.stopPropagation();
                    }
                });

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
