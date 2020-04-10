<?php
    require_once('C:\xampp\htdocs\proj_esc\authentic.php');
    if($_SESSION['tipo'] != 2){
      header("Location: inicio.php?perm=erro_perm");
    }
    require "../functions.php";
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>S.E.P.O.</title>
        <script src="../js/ver_turmas.js" type="text/javascript"></script>
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

                    msg_callback('Turma cadastrada com sucesso', 'Turma não cadastrada', 'cadastro');

                  ?>
          <div class="row">
            <div class="col-md-6 col-sm-12">   
              <div class="box box-cad">
                <header class="div-title-box">
                  <h1 class="title-box-main  d-flex justify-content-center">Cadastro de turma</h1>
                </header>
                <div class="div-content-box">
                  

                  <div class='bg-info my-1 p-2 d-flex justify-content-center align-items-center text-white text-center rounded'>
                          Visualizar as turmas já cadastradas
                          <a class='getDados' onclick='getDadosTurma();'><div class='btn-danger rounded btn-sm ml-2'>Visualizar</div></a>
                  </div>  

    				      <form class="form-cad" action="../controllers/turma_controller.php" method="POST">

        						<div class="field-cad">
  			           		<ul class="list-data-form"> 
  			           			<!--<li><label>Código da turma</label></li>
  					           	<li><input type="text" name="cod_turma" placeholder="Código da turma"></li>-->
  				           		
  					           	<li><label>Nome da turma</label></li>
  					           	<li><input type="text" name="nome_turma" placeholder="Nome da turma" maxlength="2" pattern="^[0-9]{1}[A-Za-z]{1}"
                         title="Uma turma possui o seguinte formato #@, onde # deve ser um numero e @ uma letra" required="require"></li>

                        <?php $ano_atual = date("Y");?>

                        <li><label>Ano de cadastro</label></li>
                        <li><input type="text"  class="form-control" name="id_ano" placeholder="Ano vigente" value=<?php echo $ano_atual ?> readonly>

                        </li>
  					          </ul>
        						</div>

    				        <div class="row d-flex justify-content-center">
    							     <input class="btn btn-primary" id="btn-cad-aluno" type="submit" name="" value="Cadastrar">
    						    </div>

    		           </form>
              </div>
            </div>
          </div>

               <div class="col-md-6 col-sm-12" id="box-result"> 
                <div class="box box-cad">
                    <header class="div-title-box">
                      <h1 class="title-box-main d-flex justify-content-center">Turmas cadastradas</h1>
                    </header>
                    <div class="p-3">
                      <div class="text-center" id="result">
                        
                      </div>
                    </div>
                  </div>
              </div>
            </div>
          

            <div class="col-md-12 col-sm-12 col-xs-12 p-0">
              
              <div class="box">

                <header class="div-title-box">
                  <h1 class="title-box-main  d-flex justify-content-center">Preencher turmas</h1>
                </header>
                <div class="container p-3 text-center">
                  
                    <?php 

                      $query = "select * from turma";                      
                      $stmt  = $conexao->query($query);
                      
                      $result = "<div class='row p-2'>

                                  <div class='content-turma col-12 d-flex justify-content-center align-items-center'>
                                  <form action='preencher_turma.php' method='post'>
                                    Selecione a turma a qual deseja preencher <select name='turma' class='ml-3'>
                                    ";

                      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

                        $turma = $row['nome_turma'];
                        $id_turma = $row['id_turma'];
                        $result .= "
                          
                                

                                  <option value='{$id_turma}'>{$turma}</option>

                                
                                
                              ";
                      }

                      $result .= "</select> <input type='submit' class='btn btn-primary' value='Preencher'></form></div></div>";

                      echo $result;
                    ?>
                </div>
              </div>
            </div>
          </div>     
        </div>
    </div>
    
    <?php include '../footer.php'; ?>
  </body>
</html>

