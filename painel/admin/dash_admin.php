<?php
$count_aluno = 0;
$count_adm = 0;
$count_prof = 0;
$count_ntc = 0;

$query1 = 'select count(*) from user where type = 1';
$stmt1 = $conn->query($query1);
$row1 = $stmt1->fetch(PDO::FETCH_NUM);
$count_prof = $row1[0];

$query2 = 'select count(*) from user where type = 0';
$stmt2 = $conn->query($query2);
$row2 = $stmt2->fetch(PDO::FETCH_NUM);
$count_aluno = $row2[0];

$query3 = 'select count(*) from user where type = 2';
$stmt3 = $conn->query($query3);
$row3 = $stmt3->fetch(PDO::FETCH_NUM);
$count_adm = $row3[0];

$query4 = 'select count(*) from news';
$stmt4 = $conn->query($query4);
$row4 = $stmt4->fetch(PDO::FETCH_NUM);
$count_ntc = $row4[0];
?>
<div class='col-md-12 col-sm-12'>
  <section class='box'>
    <header class='div-title-box'>
      <h1 class='title-box-main d-flex justify-content-center'>Dashboard Admin</h1>
    </header>
    <div class='div-content-box mt-3 mb-3'>
      <div class='row'>
        
        <div class='box-dash col-md-3 col-sm-3 col-6'>
          <a href='<?= "{$configBase}/admin/gerenciar_professor" ?>'>
            <article class='box-count ' id='box-dash-prof'>
              <header class='col-12 title-box-dash p-2'>
                <h1>Professor(es)</h1>
              </header>
              <div class='col-12 count-dash p-2'>
                <div class='row'>
                  <div class='col-md-6 icon-dash'>
                    <div class="container-icon-dash">
                    <i class='fas fa-chalkboard-teacher'></i>
</div>
                  </div>
                  <div class='col-md-6'>
                  
                  <?="{$count_prof}"?>
                    
                  </div>
                </div>
              </div>                         
            </article>
          </a>
        </div>

        <div class='box-dash col-md-3 col-sm-3 col-6'>
          <a href='<?= "{$configBase}/admin/gerenciar_aluno" ?>'>
            <article class='box-count ' id='box-dash-aluno'>
              <header class='col-12 title-box-dash p-2'>
                <h1>Alunos</h1>
              </header>
              
              <div class='col-12 count-dash p-2'>
                <div class='row'>
                  <div class='col-md-6 icon-dash'>
                    <div class="container-icon-dash">
                    <i class='fas fa-user-graduate'></i>
</div>
                  </div>
                  <div class='col-md-6'>

                  <?="{$count_aluno}"?>

                  </div>
                </div>
              </div>                         
            </article>
          </a>
        </div>

        <div class='box-dash col-md-3 col-sm-3 col-6'>
          <a href='<?= "{$configBase}/admin/gerenciar_adm" ?>'>
            <article class='box-count ' id='box-dash-adm'>
              <header class='col-12 title-box-dash p-2'>
                <h1>Adms</h1>
              </header>
              
              <div class='col-12 count-dash p-2'>
                <div class='row'>
                  <div class='col-md-6 icon-dash'>
                    <div class="container-icon-dash">
                    <i class='fas fa-users'></i>
</div>
                  </div>
                  <div class='col-md-6'>
                  
                    <?="{$count_adm}"?>

                  </div>
                </div>
              </div>                         
            </article>
          </a>
        </div>

        <div class='box-dash col-md-3 col-sm-3 col-6'>
          <a href='<?= "{$configBase}/admin/gerenciar_noticia" ?>'>
            <article class='box-count ' id='box-dash-noticia'>
              <header class='col-12 title-box-dash p-2'>
                <h1>Noticias</h1>
              </header>
              
              <div class='col-12 count-dash p-2'>
                <div class='row'>
                  <div class='col-md-6 icon-dash'>
                    <div class="container-icon-dash">
                    <i class='far fa-calendar-alt'></i>
                    </div>
                  </div>
                  <div class='col-md-6'>
                  
                    <?="{$count_ntc}"?>

                  </div>
                </div>
              </div>                         
            </article>
          </a>
        </div>
        
      </div>
    </div>
  </section>
</div>