<div class="box" id="sidebar">
    <div class="div-title-box">
        <h1 class="title-box-main  d-flex justify-content-center">Acesso Rápido</h1>
    </div>
    <div class="container py-2">
    	<?php

    	if($_SESSION['type'] == 2):

			$count_aluno = 0;
			$count_adm = 0;
			$count_prof = 0;
			$count_ntc = 0;

			$query1 = "select count(*) from user where type = 1";
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
		 
			<div class='row'>
				<div class="col-12"> 
					<p class='title-sidebar w-100 justify-content-center'>Gerenciar dados</p>
				</div>
			</div>
		    <div class='row'>
		    <div class="col-12 d-flex flex-wrap">
		    	
		    	<div class='box-dash' data-toggle="tooltip" data-placement="top" title="Professores">
		          <a href='<?= "{$configBase}/admin/gerenciar_professor" ?>'>
		            <article class='box-count rounded' id="box-dash-prof">
		              <div class='number-count'>
		                    <?="{$count_adm}"?>
		                  </div>
		                  <div class="icon-count">
		                    <i class='fas fa-users'></i>
		                  </div>                       
		            </article>
		          </a>
		        </div>

		        <div class='box-dash' data-toggle="tooltip" data-placement="top" title="Alunos">
		          <a href='<?= "{$configBase}/admin/gerenciar_aluno" ?>'>
		            <article class='box-count rounded' id="box-dash-aluno">
		              <div class='number-count'>
		                    <?="{$count_aluno}"?>
		                  </div>
		                  <div class="icon-count">
		                    <i class='fas fa-user-graduate'></i>
		                  </div>                       
		            </article>
		          </a>
		        </div>

		        <div class='box-dash' data-toggle="tooltip" data-placement="top" title="Administradores">
		          <a href='<?= "{$configBase}/admin/gerenciar_adm" ?>'>
		            <article class='box-count rounded' id="box-dash-adm">
		              <div class='number-count'>
		                    <?="{$count_adm}"?>
		                  </div>
		                  <div class="icon-count">
		                    <i class='fas fa-users'></i>
		                  </div>                       
		            </article>
		          </a>
		        </div>

		        <div class='box-dash' data-toggle="tooltip" data-placement="top" title="Notícias">
		          <a href='<?= "{$configBase}/admin/gerenciar_noticia" ?>'>
		            <article class='box-count rounded' id="box-dash-noticia">
		              <div class='number-count'>
		                    <?="{$count_ntc}"?>
		                  </div>
		                  <div class="icon-count">
		                    <i class='far fa-calendar-alt'></i>
		                  </div>                       
		            </article>
		          </a>
		        </div>
		    
		    	</div>
		    </div>

			<div class='row'>
		  		<div class="col-12"> 
		  			<p class='title-sidebar w-100 justify-content-center'>Personalização do Site</p>
			  	</div>
			  	<div class="col-12"> 
			  		<div class="row justify-content-center">
			  			<a class='btn btn-primary btn-sm' href='<?="{$configBase}/admin/customizacao_site"?>'>Personalizar</a>
			  		</div>
			  	</div>
			</div>

	<?php 
		endif;
		$query_three_last_news = "select * from news order by `id_news` desc limit 5";
		$stmt = $conn->query($query_three_last_news);
	?>

	<div class='row'>
		<div class="col-12"> 
	  			<p class='title-sidebar w-100 justify-content-center'>Últimas notícias</p>
	  	</div>
	  			
	  		<div class="col-12 d-flex flex-wrap">
	  			
		  	<?php 
		  		while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
		  			$r_img = $result['img_news'];
		  	?>

	  			<div class="news-sidebar">
		  			<div class="d-flex">
		  				<div class="img-news-sidebar">
			  				<img src="<?=$configBase.'/../img/'.$r_img?>">
			  			</div>
			  			<div class="text-news-sidebar py-2">
			  					<div class="col-12" style="font-size: 14px; line-height: 14px;">
				  					<a href="<?=$configBase.'/noticia/'.$result['slug_news']?>" class='titulo-ntc-sidebar'>
						  				<?=$result['title_news']?>	
						  			</a>
			  					</div>
			  					<div class="col-12">
					  				<p id="date-news-sidebar">
					  					<?php 
											$split_date = explode(" ", $result['created_at']);
					  						$date_sidebar = getStringDate($split_date[0]);
					  						echo $date_sidebar;
					  					?>
					  				</p>
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