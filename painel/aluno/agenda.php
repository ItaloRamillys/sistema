<?php
  include_once('C:\xampp\htdocs\sistema\authentic.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>S.E.P.O</title>
		<?php 

			//Import bootstrap.min.css, bootstrap.min.js, jquery, css and fonts
			include_once 'import_head.php';

		?>
</head>


<body>

	<?php 

              require '../profile.php';

            ?>
	            
	    

	<div class="row m-0">
		
             
        <?php
          
          require '../menu.php';;
           
        ?>
        
		<div class="col-md-10 pb-4 pl-sm-4 pr-sm-4">
		<div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">

		       <div class="box">
		           <div class="div-title-box">
		       		<span class="title-box-main d-flex justify-content-center">Agendas</span>
		          </div>
		          <div class="div-content-box">
		        <div id="ano" class="d-flex justify-content-center">
                  
                  <?php 

                  ?>

                  <button class="rounded p-1 text-light bg-primary mr-2">2017</button>
                  <button class="rounded p-1 text-light bg-primary mr-2">2018</button>
                  <button class="rounded p-1 text-light bg-primary mr-2">2019</button>

              	</div>

              	<ul class="list-data-form mt-2"> 
			           			
			           			<li><label>Selecione a turma</label></li>
                      <li>
                                  <select class="select-turma">
                                    <option>--</option>

                                  </select>
                      </li>

					        </ul>

		       		<!-- 

						Verificações:

						1- Saber se é aluno ou professor

						2- Aluno: Perguntar o ano e mostrar as atividades

						3- Professor: Perguntar o ano e mostra as turmas

						4- Professor: Escolhe a turma e visualiza as atividades 
						e pode cadastrar uma nova caso esteja no ano atual.

		       		-->


		          	<div class="main-atividades">
		           		

			           	
			        <div class="box-atividade">
					
					<div class="row">
						<div class="col-md-3 col-sm-6 col-6">
							<div class="card">
                              <img class="card-img-top img-agenda" src="../img/ciencia.jpg" alt="Card image cap" >
                              	<div class="card-body">
	                                <h5 class="card-title">Atividade do livro</h5>
	                                <p class="card-text">Atividade do livro de Geografia. Páginas 233 até a 235 (todas as questões).</p>
	                                
					           		<hr>
					           		<div class="details-atividade">
						           		<div class="details-atividade-left">
						           			 <i class="	fas fa-male" style="font-size:15px"></i>  João Freitas
						           		</div>
						           		<div class="details-atividade-right">
						           			 <i class='far fa-clock' style="font-size: 15px;"></i> 22:30 12/12/2019
						           		</div>
					           		 </div>
	                                <button href="#" class="btn btn-primary">Saiba mais</button>
                            	</div>
                        	</div>
						</div>
						<div class="col-md-3 col-sm-6 col-6">
							<div class="card">
                              <img class="card-img-top img-agenda" src="../img/ciencia.jpg" alt="Card image cap" >
                              	<div class="card-body">
	                                <h5 class="card-title">Atividade do livro</h5>
	                                <p class="card-text">Atividade do livro de Geografia. Páginas 233 até a 235 (todas as questões).</p>
	                                
					           		<hr>
					           		<div class="details-atividade">
						           		<div class="details-atividade-left">
						           			 <i class="	fas fa-male" style="font-size:15px"></i>  João Freitas
						           		</div>
						           		<div class="details-atividade-right">
						           			 <i class='far fa-clock' style="font-size: 15px;"></i> 22:30 12/12/2019
						           		</div>
					           		 </div>
	                                <button href="#" class="btn btn-primary">Saiba mais</button>
                            	</div>
                        	</div>
						</div>
						<div class="col-md-3 col-sm-6 col-6">
							<div class="card">
                              <img class="card-img-top img-agenda" src="../img/ciencia.jpg" alt="Card image cap" >
                              	<div class="card-body">
	                                <h5 class="card-title">Atividade do livro</h5>
	                                <p class="card-text">Atividade do livro de Geografia. Páginas 233 até a 235 (todas as questões).</p>
	                                
					           		<hr>
					           		<div class="details-atividade">
						           		<div class="details-atividade-left">
						           			 <i class="	fas fa-male" style="font-size:15px"></i>  João Freitas
						           		</div>
						           		<div class="details-atividade-right">
						           			 <i class='far fa-clock' style="font-size: 15px;"></i> 22:30 12/12/2019
						           		</div>
					           		 </div>
	                                <button href="#" class="btn btn-primary">Saiba mais</button>
                            	</div>
                        	</div>
						</div>
						<div class="col-md-3 col-sm-6 col-6">
							<div class="card">
                              <img class="card-img-top img-agenda" src="../img/ciencia.jpg" alt="Card image cap" >
                              	<div class="card-body">
	                                <h5 class="card-title">Atividade do livro</h5>
	                                <p class="card-text">Atividade do livro de Geografia. Páginas 233 até a 235 (todas as questões).</p>
	                                
					           		<hr>
					           		<div class="details-atividade">
						           		<div class="details-atividade-left">
						           			 <i class="	fas fa-male" style="font-size:15px"></i>  João Freitas
						           		</div>
						           		<div class="details-atividade-right">
						           			 <i class='far fa-clock' style="font-size: 15px;"></i> 22:30 12/12/2019
						           		</div>
					           		 </div>
	                                <button href="#" class="btn btn-primary">Saiba mais</button>
                            	</div>
                        	</div>
						</div>
					
		           	</div>
			           		 
                   
			      </div></div>
		       </div>


	    	
	    </div>
	</div>
	</div>
	         
		</div>
	

		
    <?php include '../footer.php'; ?>
    
</body>
</html>