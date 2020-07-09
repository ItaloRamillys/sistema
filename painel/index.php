<?php
ob_start();
session_start();

if(!$_SESSION || time() - $_SESSION['time_login'] > (2 * 3600)) {
  session_destroy();
?>

<script type="text/javascript">
  
  alert('Sua sessão expirou, por favor realize o login novamente');
  
    window.location.href = "../index.php";
  
</script>
<?php
}
$tipo = $_SESSION['type'];

require_once('C:\xampp\htdocs\sistema\proj_esc_func\connection.php');
require_once('C:\xampp\htdocs\sistema\news.php');
require_once('C:\xampp\htdocs\sistema\painel\functions.php');

define("BASE", 'http://localhost/sistema/painel');
define("THEME", 'http://localhost/sistema/painel');
define("THEME_PATH", __DIR__);
define("THEME_LINK", BASE);

$configBase = BASE;

$configUrl = explode("/", strip_tags(filter_input(INPUT_GET, "url", FILTER_DEFAULT)));

$configUrl[0] = (!empty($configUrl[0]) ? $configUrl[0] : "inicio");
$configSiteName = "WdpShoes";
$configBasePanel = BASE . "/painel";
$configThemePath = THEME_PATH;
$configThemeLink = THEME_LINK;

if ($configUrl[0] == 'admin') {
  if ($tipo != 2) {
    header("Location: http://localhost/sistema/painel/erro_permissao");
  }
}elseif($configUrl[0] == 'aluno') {
  if ($tipo != 0) {
    header("Location: http://localhost/sistema/painel/erro_permissao");
  }
}elseif($configUrl[0] == 'professor') {
  if ($tipo != 1) {
    header("Location: http://localhost/sistema/painel/erro_permissao");
  }
}

$conn = new Connection();
$conn = $conn->connect();
?>
<!DOCTYPE html>
<html>
  <head>
      <title>S.E.P.O.</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
      <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
      <script src="<?=$configBase?>/../js/canvasjs.min.js"></script>
      <?php 
        //Import bootstrap.min.css, bootstrap.min.js, jquery, css and fonts
        include_once '../import_head.php';
      ?>
  </head>
  <body>
    <?php 
      require '../profile.php';
    ?>
          
    <div class="container-main container-fluid">
      <div class="row">
        <?php
           require '../menu.php';          
        ?>
        <div class="col-md-10 pb-3 px-0" id="container-panel">
            
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
      </div>
      
    <div class="row">
      <?php 
        include '../footer.php'; 
      ?>
    </div>

    </div> 
  <script src='https://kit.fontawesome.com/a076d05399.js'></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.min.js"></script>
  </body>
</html>
<?php ob_end_flush(); ?>

