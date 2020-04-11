<?php
  include_once('C:\xampp\htdocs\sistema\authentic.php');
    if($_SESSION['tipo'] != 1){
      header("Location: inicio.php?perm=erro_perm");
    }
    require_once('C:\xampp\htdocs\sistema\conexao.php');
    require_once('C:\xampp\htdocs\sistema\functions.php');

?>
<html>
  <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>S.E.P.O.</title>
        <script src='../js/ajax_notas.js'></script>
        <?php 

        //Import bootstrap.min.css, bootstrap.min.js, jquery, css and fonts
        include_once 'import_head.php';

      ?>

  </head>

  <body>
       
      <?php 

      require '../profile.php';

      ?>
              
      <style type="text/css">
        label{
          margin: 0 !important;
        }
      </style>

    <div class="row m-0" style="min-height: 100%;"> 
                    
      <?php

        require '../menu.php';
         
      ?>
      
      <div class="col-md-10 col-sm-12">
            
        <div class="box box-cad">
          <div class="div-title-box">
            <span class="title-box-main  d-flex justify-content-center">Cadastro de notas</span>
				  </div>
        <div class="container">
            <?php 
                msg_callback('Notas cadastradas com sucesso', 'Notas não cadastradas.<br> Erro: Algum dado pode estar repetido ou não foi aceito pelo banco de dados.<br> Verifique se a data está correta. Na maioria das vezes o periodo ou a turma está errada.  Se todas as checagens foram efetuadas e o problema persistir, entre em contato com o desenvolvedor.', 'cadastro', 10000);
            ?>
          <div class="row p-2">

            
          
        </div>
          <div class="msg-aluno">
            <section class='row'> 
              <div class='container'>
                <form action='../controllers/nota_controller.php?action=cad' method='post'>
                  <div class="col-12 justify-content-center">
                <?php 

                  $query = "select k.id_DT, k.hora, h.nome_disc, k.id_turma, k.nome_turma, k.ano, k.id_turma from disciplina h inner join (select x.*, t.nome_turma from turma t inner join (select distinct id_DT, ano, id_turma, id_disc, hora from disc_turma where id_prof = ".$id_user_menu.") x on t.id_turma = x.id_turma) k on k.id_disc = h.id_disc";
                  $stmt  = $conexao->query($query);
                  
                  $result = "<div class='row'>
                              <div class='container'>
                                <div class='row'>

                                  <div class='col-12 d-flex justify-content-center align-items-center'>
                                    Selecione a turma que deseja inspecionar 
                                  </div>

                                <div class='col-12 d-flex justify-content-center align-items-center'><select name='turma_ano' id='turma_ano' class='ml-md-3 my-2'>
                                ";
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

                      $ano_q = $row['ano'];
                      $turma_q = $row['nome_turma'];
                      $id_turma_q = $row['id_turma'];
                      $disc_nome = $row['nome_disc'];
                      $id_DT = $row['id_DT'];
                      $hora = $row['hora'];
                      
                      $result .= "<option value = '{$id_turma_q}-{$ano_q}-{$disc_nome}-{$id_DT}'>{$turma_q} - {$disc_nome} - {$hora} - {$ano_q}</option>";

                    }

                  $result .= "</select></div> </div></div></div>";

                  echo $result;
                ?>

          </div>

                  <input type="hidden" name="prof" value=<?php echo $id_user_menu ?>>
                  <div class='row justify-content-center align-items-center'>
                    <label class="col-12 d-flex justify-content-center align-items-center">Período: </label><input class='col-3 d-flex justify-content-center align-items-center' type='number' name='periodo' id='periodo' min='1' max='4' required="required">
                  </div>
                  <div class='content-turma col-12 d-flex justify-content-center align-items-center'>
                    <div class='btn btn-primary my-2' value='Buscar' onclick='getDadosAjax()'>Buscar</div>
                  </div>
                    <div  id="result-falta"></div>
                </form>
              </div>
            </section>
          </div>
        </div>
      </div>
    </div>     
    </div>
    <?php include '../footer.php'; ?>
  </body>
</html>

