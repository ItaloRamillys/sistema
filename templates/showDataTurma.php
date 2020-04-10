<?php
  
  include_once('C:\xampp\htdocs\sistema\authentic.php');
require_once('C:\xampp\proj_esc_func\conexao.php');

$conexao = new Conexao();
$conexao = $conexao->conectar();
if($_SESSION['tipo'] != 2){
  header("Location: inicio.php?perm=erro_perm");
}
require "../functions.php";

if(isset($_POST['turma'])){
	$turma_edit = stripcslashes($_POST['turma']);
}
if(isset($_GET['turma'])){
	$turma_edit = stripcslashes($_GET['turma']);
}
if(isset($_GET['nome_turma'])){
  $nome_turma = stripcslashes($_GET['nome_turma']);
}

if(isset($_GET['ano'])){
	$ano = stripcslashes($_GET['ano']);
}else{
	$ano = date('Y');	
}

$query_nome_turma = "select nome_turma from turma where id_turma = {$turma_edit}";

$stmt_nome_turma = $conexao->query($query_nome_turma);

$row_turma = $stmt_nome_turma->fetch(PDO::FETCH_ASSOC);

require_once('C:\xampp\proj_esc_func\conexao.php');

$conexao = new Conexao();
$conexao = $conexao->conectar();


$query_edit = "select t.id_TA, u.id, u.img_profile, u.nome, u.sobrenome from usuario u inner join turma_aluno t on ano = {$ano} and id_turma = {$turma_edit} and u.id = t.id_aluno
";

$stmt_edit_turma = $conexao->query($query_edit);

?>
<html>
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>S.E.P.O.</title>
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

        require '../menu.php';
         
      ?>
      
      <div class="col-md-10 col-sm-12">
        <div class="container">
          	<div class="row">
               
              <?php 
               	msg_callback('Aluno excluido com sucesso da turma', 'Falha ao excluir aluno da turma', 'delete');
              ?>

              	<div class="col-12">
              		<div class="box">
		                <header class="div-title-box">
		                      <h1 class="title-box-main  d-flex justify-content-center">Editar turma <?= $row_turma['nome_turma'] ?></h1>
		                </header>

	              		<div class="container">
			             	<?php
			              		$res = "<div class='row my-3 justify-content-center'>";
			                        
			                    $count = 0;    

			                        while($row = $stmt_edit_turma->fetch(PDO::FETCH_ASSOC)) {

			                        	$count++;

			                          $img_profile_turma = $row['img_profile'];

			                          $res.= "
			                                  <div class='col-md-3 col-6 p-3'>
			                                    <div class='row'>
			                                      <div class='col-md-6 d-flex justify-content-center align-items-center'><img width='100px' height='100px' style='border-radius: 50%;' src='../img/{$img_profile_turma}'></div>
			                                      <div class='col-md-6 d-flex justify-content-center align-items-center'>". ($row['nome']) . " ". ($row['sobrenome']) ."</div>
			                                      <div class='col-md-6 d-flex justify-content-center align-items-center'>

			                                      <a href='../controllers/turma_aluno_controller.php?ta={$row['id_TA']}&turma_del={$turma_edit}&action=delete' class='confirmation btn btn-danger btn-sm my-2'>Excluir</a> 

			                                      </div>
			                                  </div>
			                                </div>
			                               ";
			                        }
			                       
			                    if($count == 0){
			                    	$res.=" <span>Nenhum aluno cadastrado nessa turma</span>";
			                    }   
			                    
			                    $res .= "</div><!-- Include jQuery - see http://jquery.com -->
                                        <script type='text/javascript'>
                                            $('.confirmation').on('click', function () {
                                                return confirm('Deseja realmente excluir?');
                                            });
                                        </script> ";

		                        echo $res;
                        	?>
	              	</div>
            </div>
          </div>
   
          </div> 
        </div> 
      </div>
    </div>
    
    <?php include '../footer.php'; ?>
    
</body>
</html>

