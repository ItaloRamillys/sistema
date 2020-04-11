<?php

include_once('C:\xampp\htdocs\sistema\authentic.php');
if($_SESSION['tipo'] != 2){
header("Location: inicio.php?perm=erro_perm");
}
require "../functions.php";

require_once('C:\xampp\htdocs\sistema\proj_esc_func\conexao.php');

$conexao = new Conexao();
$conexao = $conexao->conectar();

if(isset( $_POST['turma'])){
  $turma = stripcslashes($_POST['turma']);
}else if(isset($_GET['turma'])){
	$turma = stripcslashes($_GET['turma']);
}
else{
	header("inicio.php?error=2");
}

$query_nome_turma = "select nome_turma from turma where id_turma = {$turma}";

$stmt_nome_turma = $conexao->query($query_nome_turma);

$row_turma = $stmt_nome_turma->fetch(PDO::FETCH_ASSOC);

$ano =  date("Y");

?>

<html>
	<head>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <title>S.E.P.O.</title>
	    <script src='../js/ver_turmas.js'></script>
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
        	<?php
        	msg_callback('Preenchimento efetuado com sucesso', 'Falha ao preencher turma', 'cadastro');
        	?>
          <div class="row">
            <div class="col-md-12 col-sm-12">   
              <div class="box box-cad">
                <header class="div-title-box">
                  <h1 class="title-box-main d-flex justify-content-center">Preencher turma <?= $row_turma['nome_turma'] ?> - Ano <?= $ano ?> </h1>
                </header>
                <div class="div-content-box text-center">
                  	<form class="form-cad" action="../controllers/turma_aluno_controller.php?action=cad" method="POST">
                  		
                  		<header class="h3 mt-3">Alunos cadastrados no sistema</header>
                  		
                  		<div class="input-group mb-1">
	                  		<div class="input-group-prepend">
							    <span class="input-group-text" id="basic-addon1">@</span>
							</div>
							<input type="text" class="form-control col-10" placeholder="Pesquisar por nome">
							<button class="btn btn-primary ml-2">Pesquisar</button>
						</div>

						<span>Alunos sem turma este ano</span>
                  		
                  		<?php 

                  		//AND alunos que nao estão cadastrados no ano atual
                  		$query = "select * from usuario a where tipo = 0 and not exists(select ano, id_aluno from turma_aluno where ano={$ano} and id_aluno=a.id)";

                  		$stmt = $conexao->query($query);

                  		$res = "<section class='row'>
	                                
	                                <div class='col-md-12 col-12 p-0 py-4'>
	                                    <div class='container'>
	                                        <div class='row'>
                                                        
                                                ";

                  		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            
                            if($row["email"] == ''){
                              $row["email"] = "Não possui email";
                            }

                            if($row['img_profile'] == ''){
                                $img = "img-profile-default.jpg";
                            }else{
                                $img = $row['img_profile'];
                            }

                            $nome = $row['nome'];
                            $sobrenome = $row['sobrenome'];
                            $email = $row['email'];
                            $cria = $row['create_at'];
                            $id_get = $row['id'];

	                            $res .= "
	                                <div class='container-box'>
	                                    <label class='box-dados-usu' for='check-{$id_get}'>
	                                        <div class='box-img-usu'>
	                                            <img class='img-fluid' src='../img/{$img}'>
	                                        </div>
	                                        <p class='box-nome-usu'>
	                                            {$nome} {$sobrenome}
	                                        </p>

	                                        
	                                            <p class='box-email-usu'>
	                                                {$email}
	                                            </p>
	                                            <p class='box-cria-usu'>
	                                                Cadastrado em: {$cria}
	                                            </p>
	                                        
	                                        	
	                                            <input type='checkbox' id='check-{$id_get}' name='aluno_turma[]' value='{$id_get}'>
	                                        
	                                        ";

	                            $res.= "           
	                                    </label>
	                                </div>
	                                      ";
	                        }

	                        $res .= "</div> </div> </div> </section> <input type='hidden' name='turma' value='{$turma}'>
	                        <input type='hidden' name='ano' value='{$ano}'>";

	                        echo $res;

                  		?>
                  		<input type="submit" class="btn btn-primary" value="Cadastrar selecionados" name="">
    		        </form>
              </div>
            </div>
          </div>    
        </div>
        
          </div>     
        </div>
    </div>
    <?php include '../footer.php'; ?>
    <style type="text/css">
    	.container-box{
			white-space: normal;
			margin: 5px 5px;
		    flex: calc(20% - 10px);
		    max-width: calc(20% - 10px);
		    width: calc(20% - 10px);
		}
    </style>
</body>
</html>