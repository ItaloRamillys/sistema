<?php
require_once('C:\xampp\htdocs\sistema\proj_esc_func\connection.php');
$conn = new Connection();
$conn = $conn->connect();
$slug_news = $_GET['slug_news'];
$query_ntc = "select * from news where slug_news = '" . $slug_news . "'";
$stmt_ntc = $conn->query($query_ntc);

if($stmt_ntc->rowCount()>0) {
    $row = $stmt_ntc->fetch(PDO::FETCH_ASSOC);
    $r_titulo = $row['title_news'];
    $r_img = $row['img_news'];
    $r_usu = $row['id_author'];

    $data =  $row['created_at'];

    $r_data = date("d/m/Y", strtotime($data));
    $r_desc = $row['desc_news'];
    $class = "col-12";
    $queryN = "select name, last_name from user where id = {$r_usu}";
    $stmtN  = $conn->query($queryN);
    $resN = $stmtN->fetch(PDO::FETCH_NUM);
    if($resN){
        $usuario = ($resN[0]) . " " . ($resN[1]);
    }else{
        $usuario = "Autor desvinculado";
    }
}else{
    $r_titulo   = "Notícia não encontrada";
    $r_img      = "sistema/empty.svg";
    $class      = "col-6";
    $usuario    = "Sem autor";
    $r_data     = "Indefinida";
    $r_desc     = "Esta notícia não foi encontrada em nossa base de dados. Por favor retorne ao inicio ou tente outra notícia.";
}
?>
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9 col-12">
            <header class="div-title-box">
                <h1 class="title-box-main  d-flex justify-content-center"><?= $r_titulo; ?></h1>
            </header>
           
            <div class="container">
                <div class="row">
                    <img class="<?php echo $class; ?>" src="<?php echo 'http://localhost/sistema/img/'.$r_img; ?>">
                      <div class='col-6'>
                         <i class='fas fa-male' style='font-size:15px'></i>  <?=$usuario?>
                      </div>
                      <div class='col-6 d-flex justify-content-end'>
                         <i class='far fa-clock' style='font-size: 15px;'></i> <?=$r_data?>
                      </div>
                </div>
                    <div class="col-12 p-3">
                        <?=$r_desc?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

