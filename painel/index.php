<?php
ob_start();
session_start();
if(!$_SESSION || ($_SESSION && time() - $_SESSION['time_login'] > (4 * 3600))){
  session_destroy();
?>
<script type="text/javascript">
  alert('Sua sessão expirou, por favor realize o login novamente');
  window.location.href = "../index.php";
</script>
<?php
}

$type = $_SESSION['type'];

require_once('C:\xampp\htdocs\sistema\proj_esc_func\connection.php');
require_once('C:\xampp\htdocs\sistema\news.php');
require_once('C:\xampp\htdocs\sistema\painel\functions.php');
require_once('C:\xampp\htdocs\sistema\painel\config.php');

define("BASE", 'http://localhost/sistema/painel');
define("THEME", 'http://localhost/sistema/painel');
define("THEME_PATH", __DIR__);
define("THEME_LINK", BASE);

$configBase = BASE;
$configUrl = explode("/", strip_tags(filter_input(INPUT_GET, "url", FILTER_DEFAULT)));

$configUrl[0] = (!empty($configUrl[0]) ? $configUrl[0] : "inicio");
$configSiteName = "SEPO";
$configBasePanel = BASE . "/painel";
$configThemePath = THEME_PATH;
$configThemeLink = THEME_LINK;

if ($configUrl[0] == 'admin') {
  if ($type != 2) {
    header("Location: http://localhost/sistema/painel/erro_permissao");
  }
}elseif($configUrl[0] == 'aluno') {
  if ($type != 0) {
    header("Location: http://localhost/sistema/painel/erro_permissao");
  }
}elseif($configUrl[0] == 'professor') {
  if ($type != 1) {
    header("Location: http://localhost/sistema/painel/erro_permissao");
  }
}
$conn = new Connection();
$conn = $conn->connect();

$query_title_site = "select title_site from config";
$stmt_title_site = $conn->query($query_title_site);
$row_title_site = $stmt_title_site->fetch(PDO::FETCH_ASSOC);
$title_site = $row_title_site['title_site'];

$query_style_site_user = "select std_style from user where id = " . $_SESSION['user_id'];
$stmt_style_site_user = $conn->query($query_style_site_user);
$row_style_site_user = $stmt_style_site_user->fetch(PDO::FETCH_ASSOC);
$style_site = $row_style_site_user['std_style'];

if(is_null($style_site)){
  $query_style_site_std = "select style from config";
  $stmt_style_site_std = $conn->query($query_style_site_std);
  $row_style_site_std = $stmt_style_site_std->fetch(PDO::FETCH_ASSOC);
  $style_site = $row_style_site_std['style'];
}

?>
<!DOCTYPE html>
<html>
  <head>
    <title><?=$title_site?> - Painel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php 
      //Import bootstrap.min.css, bootstrap.min.js, jquery, css and fonts
      include_once('import_head.php');
    ?>
  </head>
  <body>
    <?php include_once('profile.php'); ?>
    <div class="container-main container-fluid">
      <div class="row">
        <?php include_once('menu.php'); ?>
		  <div id="container-panel">
			  <div class="" id="opacity-panel">
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
	  	</div>
      <div class="row">
        <?php include_once('../footer.php'); ?>
      </div>
    </div> 
  <script src='https://kit.fontawesome.com/a076d05399.js'></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.min.js"></script>
  </body>
</html>
<?php ob_end_flush(); ?>

