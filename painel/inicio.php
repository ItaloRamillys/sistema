<?php

//PEGANDO OS DADOS DO BD PARA CRIAR A PAGINA
$query = "select * from config";
$stmt  = $conexao->query($query);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$img1       = "http://localhost/sistema/img/".  $row['img_dest1'];
$img2       = "http://localhost/sistema/img/" . $row['img_dest2'];
$img3       = "http://localhost/sistema/img/" . $row['img_dest3'];
$txt_img1  = $row['txt_img1'];
$txt_img2  = $row['txt_img2'];
$txt_img3  = $row['txt_img3'];

?>
<div class="container">
  
<div class="row">
  
  <?php 
    if($_SESSION['tipo'] == 2){ 
      include "admin/dash_admin.php";
    }
  ?>
  <div class="col-md-5 col-12">
    <section class="box pb-2">
      
    <?php 

    if($_SESSION['tipo'] == 0){ 

    ?>

      <header class="div-title-box">
        <h1 class="title-box-main d-flex justify-content-center">Últimas atividades</h1>
      </header>
    
    <?php
      $ano_atual = date("Y");
      $query_id_class = "select id_turma from turma_aluno where id_aluno = {$id_user_menu} and ano = {$ano_atual}";
      $stmt_id_class = $conexao->query($query_id_class);
      $row_id_class = $stmt_id_class->fetch(PDO::FETCH_ASSOC);
      $id_class = $row_id_class['id_turma']; 

      $query_id_dt = "select id_DT from disc_turma where id_turma = {$id_class} and ano = {$ano_atual}";
      $stmt_id_dt = $conexao->query($query_id_dt);
      $row_id_dt = $stmt_id_dt->fetchAll(PDO::FETCH_ASSOC);

      $activitys = [];

      foreach ($row_id_dt as $key => $value) {
        $query_activity = "select * from atividade where id_DT = {$value['id_DT']}";
        $stmt_activity = $conexao->query($query_activity);
        $row_activity = $stmt_activity->fetchAll(PDO::FETCH_ASSOC);
        foreach ($row_activity as $key2 => $value2) {
          if($row_activity && count($activitys) < 3){
            array_push($activitys, $value2);
          }
        }
      }

      $array_colors = ['#3bce89', '#39bb94', '#1198a4', '#0090c3']; 

      ?>
      <div class="container">
            <div class="row">
              
            <?php
            $c = 0;
            if(count($activitys)>0){
              for($i = 0; $i < count($activitys); $i++){
              
              $id_atv = $activitys[$i]['id_atv'];
              $id_dt = $activitys[$i]['id_DT'];
              $query_n_teacher_n_subj = "select nome_disc, y.nome from disciplina d inner join (SELECT nome, x.* from usuario u inner join (select id_prof, id_disc from disc_turma dt WHERE dt.id_DT = {$id_dt}) x on x.id_prof = u.id) y on y.id_disc = d.id_disc";
              $stmt_n_teacher_n_subj = $conexao->query($query_n_teacher_n_subj);
              $row_n_teacher_n_subj = $stmt_n_teacher_n_subj->fetch(PDO::FETCH_ASSOC);

              $name_teacher = $row_n_teacher_n_subj['nome'];
              $name_subject = $row_n_teacher_n_subj['nome_disc'];

            ?>

            <div class="container-activity-md" id="container-activity-md-<?=$c?>">
              <div class="box-activity-md">
                <p class="t_atv" style="background-color: <?=$array_colors[$c]?>">
                  <?php echo $activitys[$i]['titulo_atv']; ?>
                </p>
                <p class="name_teacher_subject">
                  <?php echo $name_teacher . " - " . $name_subject ?>
                </p>
                <p class="d_atv">
                  <?php 

                  $desc = $activitys[$i]['desc_atv'];

                  if (strlen($desc) > 150) {

                  $stringCut = substr($desc, 0, 150);
                  $endPoint = strrpos($stringCut, ' ');
                  $stringCut .= "...";
                  $desc = $stringCut;

               }

                  echo $desc; 

                  ?>
                </p>
                <div class="footer-box-activity">
                  <p class="time-activity">
                    <i class="fas fa-clock"></i> <?php echo $activitys[$i]['create_at'] ?>
                  </p>
                  <p class="read-more">
                    <a href="<?=$configBase?>/aluno/atividade/<?=$activitys[$i]['id_atv']?>" class="text-primary">Ler mais</a>
                  </p>
                </div>
              </div>
            </div>

            <?php 
              
              $c++;
              
              } 
            }else{
              echo "<p class='msg msg-warn'>Nenhuma atividade cadastrada</p>";
            }

            ?>
            </div>
          </div>
      <?php

    }elseif($_SESSION['tipo'] == 2){

    ?>

      <header class="div-title-box">
        <h1 class="title-box-main d-flex justify-content-center">Últimas atividades</h1>
      </header>

      <div class="container">
        <div class="row">
          
        </div>
      </div>

    <?php
      
      }

    ?>
    </section>  
  </div>
  <div class="col-md-7 col-12">
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
  
  <div class="col-12">
    <section class="box">
      <header class="div-title-box">
        <h1 class="title-box-main d-flex justify-content-center"> Por dentro da escola </h1>
      </header>
     
      <div class="div-content-box">
        <div class="row">
      
        <?php showNews('http://localhost/sistema/img/', $conexao, 'http://localhost/sistema/painel/noticia/') ?>
    
        </div>
      </div>
    </section>
  </div>
</div>
</div>
  <script type="text/javascript" src="<?=$configBase?>/../js/slide.js"></script>