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
							<span class="title-box-main d-flex justify-content-center">Documentos</span>
						</div>
						<div class="div-content-box">
							Seus documentos serão gerados aqui
						<!-- 

						Verificações:

						1- Saber se é aluno ou professor

						2- Aluno: Perguntar o ano e mostrar as atividades

						3- Professor: Perguntar o ano e mostra as turmas

						4- Professor: Escolhe a turma e visualiza as atividades 
						e pode cadastrar uma nova caso esteja no ano atual.

						-->

						</div>
					</div>
				</div>
			</div>
		</div>
	
    <?php include '../footer.php'; ?>
    
</body>
</html>