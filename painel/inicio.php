<?php
//PEGANDO OS DADOS DO BD PARA CRIAR A PAGINA
$query = "select * from config";
$stmt  = $conn->query($query);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$img1       = "http://localhost/sistema/img/".  $row['img_featured_1'];
$img2       = "http://localhost/sistema/img/" . $row['img_featured_2'];
$img3       = "http://localhost/sistema/img/" . $row['img_featured_3'];
$txt_img1  = $row['txt_img_1'];
$txt_img2  = $row['txt_img_2'];
$txt_img3  = $row['txt_img_3'];
?>
<div class="container">
  <div class="row">
      <?php 
        //Apenas adm possui a barra de controle do sistema
        if($_SESSION['type'] == 2) {
            include "admin/dash_admin.php";
        }
        //Apenas adm e professores podem ver os gráficos
        if($_SESSION['type'] == 2 || $_SESSION['type'] == 1){
       ?>
        <div class="col-md-5 col-12 mb-3 h-100" id="calls">
          <div class="box h-100">
            <header class="div-title-box">
              <h1 class="title-box-main d-flex justify-content-center">Chamados</h1>
            </header>
            <div class="container h-100">
              <div class="row">
                <div class="col-12">
                  <p class="msg msg-primary">Você não possui chamados em aberto ainda</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!--<div class="col-md-7 col-12 mb-3" id="statistics">
          <div class="box h-100">
            <header class="div-title-box">
              <h1 class="title-box-main d-flex justify-content-center">Estatísticas</h1>
            </header>
            <div class="container h-100">
              <div class="row">
                <div class="col-12 p-2 h-100">
                  <div class="col-12" id="chartContainer" style="box-shadow: 0px 1px 5px rgba(0,0,0,.4); height: 300px !important; width: 100%; padding: 20px;"> 
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>-->
  <?php
    }     
    if($_SESSION['type'] == 0){ 
  ?>
  <div class="col-md-5 col-12">
    <div class="box pb-2">
      <header class="div-title-box">
        <h1 class="title-box-main d-flex justify-content-center">Últimas atividades</h1>
      </header>
    
    <?php
      $ano_atual = date("Y");
      $query_id_class = "select id_class from class_student where id_student = {$id_user_menu} and year = {$ano_atual}";
      $stmt_id_class = $conn->query($query_id_class);
      $row_id_class = $stmt_id_class->fetch(PDO::FETCH_ASSOC);
      if($row_id_class){
        $id_class = $row_id_class['id_class']; 
        
        $query_id_dt = "select id_sc from subject_class_lesson where id_class = {$id_class} and year = {$ano_atual}";
        $stmt_id_dt = $conn->query($query_id_dt);
        $row_id_dt = $stmt_id_dt->fetchAll(PDO::FETCH_ASSOC);
        $activitys = [];

        foreach ($row_id_dt as $key => $value) {
          $query_activity = "select * from activity where id_SC_activity = {$value['id_sc']}";
          $stmt_activity = $conn->query($query_activity);
          $row_activity = $stmt_activity->fetchAll(PDO::FETCH_ASSOC);
          foreach ($row_activity as $key2 => $value2) {
            if($row_activity && count($activitys) < 3){
              array_push($activitys, $value2);
            }
          }
        }
        $array_colors = []; 
      }
      ?>
      <div class="container">
        <div class="col-12">
          <div class="row">
            
            <?php
            $c = 0;
            if(isset($activitys) && count($activitys)>0){
              if(count($activitys)<=3){
                $max_activitys = count($activitys);
              }else{
                $max_activitys = 3;
              }
              for($i = 0; $i < $max_activitys; $i++){
              
              $id_atv = $activitys[$i]['id_activity'];
              $has_file = $activitys[$i]['file_activity'];
              $id_dt = $activitys[$i]['id_SC_activity'];
              $query_n_teacher_n_subj = "select name_subject, y.name from subject d inner join (SELECT name, x.* from user u inner join (select id_teacher, id_subject from subject_class_lesson dt WHERE dt.id_SC = {$id_dt}) x on x.id_teacher = u.id) y on y.id_subject = d.id_subject";

              $stmt_n_teacher_n_subj = $conn->query($query_n_teacher_n_subj);
              $row_n_teacher_n_subj = $stmt_n_teacher_n_subj->fetch(PDO::FETCH_ASSOC);

              $name_teacher = $row_n_teacher_n_subj['name'];
              $name_subject = $row_n_teacher_n_subj['name_subject'];

            ?>

            <div class="container-activity-md" id="container-activity-md-<?=$c?>">
              <div class="box-activity-md">
                <p class="t_atv" style="background-color: <?='var(--theme-color-'.($c+1).')'?>">
                  <?php echo $activitys[$i]['title_activity']; ?>
                </p>
                <p class="name_teacher_subject">
                  <?php echo $name_teacher . " - " . $name_subject ?>
                </p>
                <p class="d_atv">
                  <?php 
                  $desc = $activitys[$i]['desc_activity'];

                  if (strlen($desc) > 120) {
                    $stringCut = substr($desc, 0, 120);
                    $endPoint = strrpos($stringCut, ' ');
                    $stringCut .= "...";
                    $desc = $stringCut;
                  }
                  echo $desc; 
                  ?>
                </p>
                <?php
                if($has_file){
                ?>
                  <p class='t_atv my-2' style="background-color: <?='var(--theme-color-'.($c+1).')'?>">Arquivo em anexo</p> 
                <?php
                }
                ?>
                <div class="footer-box-activity">
                  <p class="time-activity">
                    <i class="fas fa-clock"></i> 
                    <?php 
                    $date = explode(" ", $activitys[$i]['created_at']);
                    echo getStringDate($date[0]); 
                    ?>
                  </p>
                  <p class="read-more">
                    <a href="<?=$configBase?>/aluno/atividade/<?=$activitys[$i]['id_activity']?>" class="">Ler mais</a>
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
          </div>
        </div>
      </div>
      	<?php
      		}
    	?>
      <div class="col-md-7 col-12">
        <section class="box">
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
    
      <div class="col-md-5 col-12"></div>
    <div class="col-12">
      <section class="box">
        <header class="div-title-box">
          <h1 class="title-box-main d-flex justify-content-center"> Por dentro da escola </h1>
        </header>
        <div class="div-content-box">
          <div class="container p-2">
            <div class="row">
            <?php showNews('http://localhost/sistema/img/', $conn, 'http://localhost/sistema/painel/noticia/') ?>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</div>
<script type="text/javascript" src="<?=$configBase?>/../js/slide.js"></script>
<script>
window.onload = function() {
CanvasJS.addColorSet("greenShades",
                [//colorSet Array

                "#3CB371",
                "#008080",
                "#90EE90",               
                "#2E8B57",
                "#2F4F4F"
                ]);
var chart = new CanvasJS.Chart("chartContainer", {
  backgroundColor: "#00000000",
  exportEnabled: false,
  animationEnabled: true,
  colorSet: "greenShades",
  title: {
    text: "Assiduidade", fontColor: "#000"
  },
  legend:{
    cursor: "pointer", fontColor: "#000", fontSize: 10
  },
  data: [{
    indexLabelFontColor: '#000 ',
    type: "pie",
    startAngle: 25,
    toolTipContent: "{label}: {y}%",
    showInLegend: "true",
    legendText: "{label}",
    indexLabelFontSize: 16,
    indexLabel: "{label} - {y}%",
    innerRadius: 80,
    legendMarkerType: "square",
    dataPoints: [
      { y: 88, label: "Presenças" },
      { y: 12, label: "Faltas" }
    ]
  }]
});
chart.render();

}
</script>