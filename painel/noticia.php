<?php
$slug = $configUrl[1];

$query_ntc = "select * from noticia where slug = '" . $slug . "'";

$stmt_ntc = $conexao->query($query_ntc);
if($stmt_ntc->rowCount()>0) {
    $row = $stmt_ntc->fetch(PDO::FETCH_ASSOC);
    $r_titulo = $row['titulo_ntc'];
    $r_img = $row['path_img'];
    $r_usu = $row['id_resp'];

    $data =  $row['create_at'];

    $r_data = date("d/m/Y", strtotime($data));
    $r_desc = $row['desc_ntc'];
    $class = "col-12";
    $queryN = "select nome, sobrenome from usuario where id = {$r_usu}";
    $stmtN  = $conexao->query($queryN);
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
    $class_aux  = "justify-content-center align-items-center";
?>
<div class="container">
    <div class="row">
        <div class="col-md-9 col-12">
            <div class="box"> 
                <header class="div-title-box">
                    <h1 class="title-box-main  d-flex justify-content-center"><?= $r_titulo; ?></h1>
                </header>
               
                <div class="container">
                    <div class="row">
                        <div class="col-12 p-3">
                            <div class="row <?php echo $class_aux; ?>">
                               <img class="<?php echo $class; ?>" src="<?php echo 'http://localhost/sistema/img/'.$r_img; ?>">
                           </div> 
                            <div class='details-atividade'>
                              <div class='details-atividade-left'>
                                 <i class=' fas fa-male' style='font-size:15px'></i>  <?=$usuario?>
                              </div>
                              <div class='details-atividade-right'>
                                 <i class='far fa-clock' style='font-size: 15px;'></i> <?=$r_data?>
                              </div>
                            </div>
                        </div>
                        <div class="col-12 p-3">
                            <div class="container">
                                
                            <?=$r_desc?>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="col-md-3 col-12">
            <?php require "sidebar.php"; ?>
        </div>
    </div>
</div>

<script src="http://localhost/sistema/js/delete_aluno.js"></script>
