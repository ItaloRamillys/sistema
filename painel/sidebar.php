<div class="box">
    <div class="div-title-box">
        <h1 class="title-box-main  d-flex justify-content-center">Barra lateral</h1>
    </div>
    <div class="container">
    	<?php
			$count_aluno = 0;
			$count_adm = 0;
			$count_prof = 0;
			$count_ntc = 0;

			$query1 = 'select count(*) from usuario where tipo = 1 and id_esc = ' . $id_escola;
			$stmt1 = $conexao->query($query1);
			$row1 = $stmt1->fetch(PDO::FETCH_NUM);
			$count_prof = $row1[0];


			$query2 = 'select count(*) from usuario where tipo = 0 and id_esc ='. $id_escola;
			$stmt2 = $conexao->query($query2);
			$row2 = $stmt2->fetch(PDO::FETCH_NUM);
			$count_aluno = $row2[0];


			$query3 = 'select count(*) from usuario where tipo = 2 and id_esc =' . $id_escola;
			$stmt3 = $conexao->query($query3);
			$row3 = $stmt3->fetch(PDO::FETCH_NUM);
			$count_adm = $row3[0];


			$query4 = 'select count(*) from noticia';
			$stmt4 = $conexao->query($query4);
			$row4 = $stmt4->fetch(PDO::FETCH_NUM);
			$count_ntc = $row4[0];
		?>
		  <section class='box'>
		    <div class='div-content-box mt-3 mb-3'>
		      <div class='row'>
				<div class='box-dash col-12 my-1'>
		          <a href='<?= "{$configBase}/admin/ger_prof" ?>'>
		            <article class='box-count rounded' style='background-color:#3bce89'>
		              <header class='col-12 title-box-dash p-2'>
		                <h1>Professores</h1>
		              </header>
		              <div class='col-12 count-dash p-2'>
		                <div class='row'>
		                  <div class='col-md-5'>
		                     
		                  <?="{$count_prof}"?>
		                    
		                  </div>
		                  <div class='col-md-6 icon-dash'>
		                    <i class='fas fa-chalkboard-teacher'></i>
		                  </div>
		                </div>
		              </div>                         
		            </article>
		          </a>
		        </div>
		        
		        <div class='box-dash col-12'>
		          <a href='<?= "{$configBase}/admin/ger_aluno" ?>'>
		            <article class='box-count rounded' style='background-color: #39bb94'>
		              <header class='col-12 title-box-dash p-2'>
		                <h1>Estudantes</h1>
		              </header>
		              
		              <div class='col-12 count-dash p-2'>
		                <div class='row'>
		                  <div class='col-md-5'>

		                  <?="{$count_aluno}"?>

		                  </div>
		                  <div class='col-md-6 icon-dash'>
		                    <i class='fas fa-user-graduate'></i>
		                  </div>
		                </div>
		              </div>                         
		            </article>
		          </a>
		        </div>

		        <div class='box-dash col-12'>
		          <a href='<?= "{$configBase}/admin/ger_adm" ?>'>
		            <article class='box-count rounded' style='background-color: #1198a4'>
		              <header class='col-12 title-box-dash p-2'>
		                <h1>Adms</h1>
		              </header>
		              
		              <div class='col-12 count-dash p-2'>
		                <div class='row'>
		                  <div class='col-md-5'>

		                  
		                    <?="{$count_adm}"?>

		                  </div>
		                  <div class='col-md-6 icon-dash'>
		                    <i class='fas fa-users'></i>
		                  </div>
		                </div>
		              </div>                         
		            </article>
		          </a>
		        </div>

		        <div class='box-dash col-12'>
		          <a href='<?= "{$configBase}/admin/ger_news" ?>'>
		            <article class='box-count rounded' style='background-color:#0090c3'>
		              <header class='col-12 title-box-dash p-2'>
		                <h1>Noticias</h1>
		              </header>
		              
		              <div class='col-12 count-dash p-2'>
		                <div class='row'>
		                  <div class='col-md-5'>

		                  
		                    <?="{$count_ntc}"?>

		                  </div>
		                  <div class='col-md-6 icon-dash'>
		                    <i class='far fa-calendar-alt'></i>
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
</div>