<div class="box">
    <div class="div-title-box">
        <h1 class="title-box-main  d-flex justify-content-center">Acesso Rápido</h1>
    </div>
    <div class="container py-2">
    	<?php
			$count_aluno = 0;
			$count_adm = 0;
			$count_prof = 0;
			$count_ntc = 0;

			$query1 = 'select count(*) from usuario where tipo = 1';
			$stmt1 = $conexao->query($query1);
			$row1 = $stmt1->fetch(PDO::FETCH_NUM);
			$count_prof = $row1[0];


			$query2 = 'select count(*) from usuario where tipo = 0';
			$stmt2 = $conexao->query($query2);
			$row2 = $stmt2->fetch(PDO::FETCH_NUM);
			$count_aluno = $row2[0];


			$query3 = 'select count(*) from usuario where tipo = 2';
			$stmt3 = $conexao->query($query3);
			$row3 = $stmt3->fetch(PDO::FETCH_NUM);
			$count_adm = $row3[0];


			$query4 = 'select count(*) from noticia';
			$stmt4 = $conexao->query($query4);
			$row4 = $stmt4->fetch(PDO::FETCH_NUM);
			$count_ntc = $row4[0];
		?>
		 
		      <div class='row'>
		      	<div class="col-12"> 
		      			<p class='msg w-100 justify-content-center'>Gerenciar dados</p>
		      	</div>
		      </div>
		      <div class='row'>
		      	<div class="col-12">
		      		<div class="container"> 
		      				<div class="row"> 
					<div class='box-dash p-1' data-toggle="tooltip" data-placement="top" title="Professores">
			          <a href='<?= "{$configBase}/admin/ger_prof" ?>'>
			            <article class='box-count rounded' style='background-color:#3bce89'>
			              <div class='col-12 count-dash p-2'>
			                <div class='row'>
			                  <div class='col-md-6 icon-dash' style="position: relative;">
			                  <?="{$count_prof}"?>
			                    <i class='fas fa-chalkboard-teacher' style="position: absolute; top: 10%; left: 20%;  font-size: 40px"></i>
			                  </div>
			                </div>
			              </div>                         
			            </article>
			          </a>
			        </div>
			        
			        <div class='box-dash p-1' data-toggle="tooltip" data-placement="top" title="Alunos">
			          <a href='<?= "{$configBase}/admin/ger_aluno" ?>'>
			            <article class='box-count rounded' style='background-color: #39bb94'>
			              <div class='col-12 count-dash p-2'>
			                <div class='row'>
			                  <div class='col-md-6 icon-dash' style="position: relative;">
			                  <?="{$count_aluno}"?>
			                    <i class='fas fa-user-graduate' style="position: absolute; top: 10%; left: 20%;	  font-size: 40px"></i>
			                  </div>
			                </div>
			              </div>                         
			            </article>
			          </a>
			        </div>

			        <div class='box-dash p-1' data-toggle="tooltip" data-placement="top" title="Administradores">
			          <a href='<?= "{$configBase}/admin/ger_adm" ?>'>
			            <article class='box-count rounded' style='background-color: #1198a4'>
			              <div class='col-12 count-dash p-2'>
			                <div class='row'>
			                  <div class='col-md-6 icon-dash' style="position: relative;">
			                    <?="{$count_adm}"?>
			                    <i class='fas fa-users' style="position: absolute; top: 10%; left: 20%; font-size: 40px"></i>
			                  </div>
			                </div>
			              </div>                         
			            </article>
			          </a>
			        </div>

			        <div class='box-dash p-1' data-toggle="tooltip" data-placement="top" title="Notícias">
			          <a href='<?= "{$configBase}/admin/ger_news" ?>'>
			            <article class='box-count rounded' style='background-color:#0090c3'>
			              <div class='col-12 count-dash p-2'>
			                <div class='row'>
			                  <div class='col-md-6 icon-dash' style="position: relative;">
			                    <?="{$count_ntc}"?>
			                    <i class='far fa-calendar-alt' style="position: absolute; top: 10%; left: 20%;  font-size: 40px"></i>
			                  </div>
			                </div>
			              </div>                         
			            </article>
			          </a>
			        </div>
			      </div>
		</div>
</div>
</div>
	<div class='row'>
	  	<div class="col-12"> 
	  			<p class='msg w-100 justify-content-center'>Configurações do Site</p>
	  	</div>
	  	<div class="col-12"> 
	  		<div class="row justify-content-center">
	  			<a class='btn btn-sm btn-primary' href='<?= "{$configBase}/admin/config_site" ?>'>Configurações do Site</a>
	  		</div>
	  	</div>
	</div>

	<?php 

	$query_three_last_news = "select * from noticia order by `id_ntc` desc limit 3";
	$stmt = $conexao->query($query_three_last_news);

	?>

	<div class='row'>
		<div class="col-12"> 
	  			<p class='msg w-100 justify-content-center'>Últimas notícias</p>
	  	</div>
	  	<div class="col-12">
	  		
	  	<?php 
	  		while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
	  			$desc = $result['desc_ntc'];
	  			if (strlen($desc) > 75) {

				    $stringCut = substr($desc, 0, 75);
				    $endPoint = strrpos($stringCut, ' ');
				    $stringCut .= "...";
				    $desc = $stringCut;

				}
	  	?>
	  		<div class="ntc-sidebar">
		  		<div class="col-12"> 
		  			<a href="<?=$configBase.'/noticia/'.$result['id_ntc']?>">
			  			<div class="row justify-content-center titulo-ntc-sidebar">
			  				<?=$result['titulo_ntc']?>
			  			</div>
		  			</a>
		  			<div class="row justify-content-center titulo-ntc-sidebar">
		  				<img src="<?=$configBase.'/../img/'.$result['path_img']?>" class="img-thumbnail">
		  			</div>
		  			<div class="row justify-content-center desc-ntc-sidebar">
		  				<?=$desc?>
		  			</div>
	  			</div>
	  		</div>
	  	<?php 
	  		} 
	  	?>
	  	</div>
	</div>
</div>	  
</div> 