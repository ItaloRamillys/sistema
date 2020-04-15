<?php
  include_once('C:\xampp\htdocs\sistema\authentic.php');
 
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
            <div class="col-md-10 col-sm-12 col-xs-12">
                <div class="container">
                  <div class="col-md-12 col-sm-12 col-xs-12 p-0">
              
                    <div class="box">

                      <header class="div-title-box">
                        <h1 class="title-box-main  d-flex justify-content-center">Preencher disciplinas em turmas</h1>
                      </header>
                      <div class="container p-3 text-center">
                          <form action="../controllers/turma_disc_controller.php?action=cad" method="post"> 
                          <?php 

                            $query = "select * from turma";                      
                            $stmt  = $conexao->query($query);
                            
                            $result = "<div class='row p-2'>

                                        <div class='content-turma col-12 d-flex justify-content-center align-items-center'>
                                        
                                          Selecione a turma a qual deseja preencher <select name='turma' class='ml-3'>
                                          ";

                            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                              $turma = $row['nome_turma'];
                              $id_turma = $row['id_turma'];
                              $result .= "<option value='{$id_turma}'>{$turma}</option>";
                            }

                            $result .= "</select> </div></div>";

                            echo $result;

                            $query2 = "select * from disciplina";                      
                            $stmt2  = $conexao->query($query2);
                            
                            $result2 = "<div class='row p-2'>

                                        <div class='content-turma col-12 d-flex justify-content-center align-items-center'>
                                        
                                          Selecione a disciplina a qual deseja inserir <select name='disciplina' class='ml-3'>
                                          ";

                            while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
                              $nome_disc = $row2['nome_disc'];
                              $id_disc = $row2['id_disc'];
                              $result2 .= " <option value='{$id_disc}'>{$nome_disc}</option>";
                            }

                            $result2 .= "</select> </div></div>";

                            echo $result2;

                            $query3 = "select * from usuario where tipo = 1 order by nome asc";                      
                            $stmt3 = $conexao->query($query3);
                            
                            $result3 = "<div class='row p-2'>

                                        <div class='content-turma col-12 d-flex justify-content-center align-items-center'>
                                        
                                          Selecione a disciplina a qual deseja inserir <select name='professor' class='ml-3'>
                                          ";

                            while($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)){
                              $nome_usu = $row3['nome'];
                              $sobrenome = $row3['sobrenome'];
                              $id_prof_disc = $row3['id']; 
                              $result3 .= "<option value='{$id_prof_disc}'>{$nome_usu} {$sobrenome}</option>";
                            }

                            $result3 .= "</select></div></div>";

                            echo $result3;
                          ?>

                          <!-- DIA DA SEMANA / HORARIO / ANO -->
                          <div class="row my-2">
                              <div class='content-turma col-12 d-flex justify-content-center align-items-center'>
                                  <label class='p-2'>Segunda</label><input type="radio" name="dia_sem" value="2" required>
                                  <label class='p-2'>Terça</label><input type="radio" name="dia_sem" value="3">
                                  <label class='p-2'>Quarta</label><input type="radio" name="dia_sem" value="4">
                                  <label class='p-2'>Quinta</label><input type="radio" name="dia_sem" value="5">
                                  <label class='p-2'>Sexta</label><input type="radio" name="dia_sem" value="6">
                              </div>
                          </div>
                          <div class="row my-2">
                              <div class='content-turma col-12 d-flex justify-content-center align-items-center'>
                                  Horário de início da aula: 
                                  <select name="hora" class="ml-2" required>
                                    <option>07:00 - 08:00</option>
                                    <option>08:00 - 09:00</option>
                                    <option>09:00 - 10:00</option>
                                    <option>10:00 - 11:00</option>
                                    <option>13:00 - 14:00</option>
                                    <option>14:00 - 15:00</option>
                                    <option>15:00 - 16:00</option>
                                    <option>16:00 - 17:00</option>
                                  </select>
                              </div>
                          </div>
                          <?php 
                              $queryAno = "select distinct(ano) from turma_aluno";

                              $select = "<div class='row my-2 d-flex justify-content-center align-items-center'>
                                          <div class='content-turma col-4'>
                                              <select class='col-12 col' name='ano_turma' required/> 
                                              <option value=''>Selecione um ano</option>
                                        ";

                              foreach ($conexao->query($queryAno) as $row) {
                                  if(!empty($row)){
                                      $select .= "<option value='{$row['ano']}'>{$row['ano']}</option>";
                                  }
                              }

                              $select .= "</select></div> </div>";

                              echo $select;
                          ?>

                          <input type="submit" value="Cadastrar"  class="btn btn-primary" name="">
                          </form>
                      </div>
                    </div>
                  </div>
                  </div>
                </div>
            </div>    
        </div>
    </div>
    
            
    <?php include '../footer.php'; ?>
    
    </body>
    <script src='../js/ver_disc.js'></script>
    <script src='../js/cad_disc.js'></script>
</html>

