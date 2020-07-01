<div class="box">
    <div class="div-title-box">
        <h1 class="title-box-main  d-flex justify-content-center">Acesso Rápido</h1>
    </div>
    <div class="container py-2">
    	<?php

    	$is_admin = is_admin($_SESSION['login']);

    	if($is_admin):

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
		      			<p class='title-sidebar w-100 justify-content-center'>Gerenciar dados</p>
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
	  			<p class='title-sidebar w-100 justify-content-center'>Configurações do Site</p>
		  	</div>
		  	<div class="col-12"> 
		  		<div class="row justify-content-center">
		  			<a class='btn btn-sm btn-primary' href='<?= "{$configBase}/admin/config_site" ?>'>Configurações do Site</a>
		  		</div>
		  	</div>
		</div>

	<?php 
	endif;
	$query_three_last_news = "select * from noticia order by `id_ntc` desc limit 5";
	$stmt = $conexao->query($query_three_last_news);

	?>

	<div class='row'>
		<div class="col-12"> 
	  			<p class='title-sidebar w-100 justify-content-center'>Últimas notícias</p>
	  	</div>
	  	<div class="col-12">
	  		<div class="row">
	  	<?php 
	  		while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
	  			$r_img = explode(".", $result['path_img']);
			    $name_img = $r_img[0];
			    $new_name_img = $name_img."_100x100.".$r_img[1];
	  	?>
	  		<div class="ntc-sidebar">
		  		<div class="col-12">
		  			<div class="row m-0">
		  				<div class="col-4 p-0">
			  				<img src="<?=$configBase.'/../img/'.$new_name_img?>" class="img-fluid">
			  			</div>
			  			<div class="col-8">
			  				<div class="row">
			  					<div class="col-12 pr-0" style="font-size: 14px; line-height: 14px;">
				  					<a href="<?=$configBase.'/noticia/'.$result['slug']?>" >
						  				<?=$result['titulo_ntc']?></a>
			  					</div>
			  					<div class="col-12 pr-0">
					  				<p id="date-news-sidebar">
					  					<?php 
											$split_date = explode("-", $result['create_at']);
					  						$date_sidebar = $split_date[2] . " de " . getMonthName(floor($split_date[1])-1) . " de " . $split_date[0];
					  						echo $date_sidebar;
					  					?>
					  				</p>
			  					</div>
			  				</div>			  			
			  			</div>
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
</div> 