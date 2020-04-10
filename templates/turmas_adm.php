<?php
    require_once('C:\xampp\htdocs\proj_esc\authentic.php');
    include_once ('C:\xampp\htdocs\proj_esc\conexao.php');
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
        <link rel="stylesheet" href="..\css\style2.css">
        <link rel="stylesheet" href="..\css\cronograma.css">
        <script src='../js/ajax_cronograma.js'></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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

    <div class="col-md-10 pb-4">
        <div class="container">
            <?php
                msg_callback('Excluido com sucesso da turma', 'Falha ao excluir', 'delete');
                ?>
            <div class="row">
            <div class="box col-12 p-0">
                <div class="div-title-box">
                    <h1 class="title-box-main d-flex justify-content-center">Turma</h1>
                </div>
                
                    <span class="title-box-main ">Cronograma da semana</span>

                    <div class="container">
                        <div class="row justify-content-center">
                                <?php 

                                  $query = "select * from turma";                      
                                  $stmt  = $conexao->query($query);
                                  
                                  $result = "<div class='row p-2'>
                                              <div class='content-turma col-12 d-flex justify-content-center align-items-center'>
                                                Selecione a turma a qual deseja inspecionar 

                                                <select name='turma' id='turmas_src' class='ml-3'>
                                                ";
                                  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

                                    $turma = $row['nome_turma'];
                                    $id_turma = $row['id_turma'];
                                    $result .= "<option value='{$id_turma}'>{$turma}</option>";
                                  }

                                  $result .= "</select> <input type='submit' class='btn btn-primary ml-2' value='Buscar' onclick='getDadosAjax()'></div></div>";

                                  echo $result;
                                ?>
                        </div>

                        <section class="col-12 p-0 cronograma text-center text-light">
                        
                            <header class="div-title-box h5 m-0">Cronograma da turma</header>

                            <section class="container">
                                <div class="row" id="dias">
                                    <article class="dia_sem_aula">
                                        <header class="div-title-box h6">Segunda</header>
                                        <div id="aulas_seg">
                                            
                                        </div>

                                    </article>


                                    <article class="dia_sem_aula">
                                        <header class="div-title-box h6">Terça</header>
                                        <div id="aulas_ter">
                                            
                                        </div>

                                    </article>


                                    <article class="dia_sem_aula">
                                        <header class="div-title-box h6">Quarta</header>
                                        <div id="aulas_qua">
                                            
                                        </div>

                                    </article>


                                    <article class="dia_sem_aula">
                                        <header class="div-title-box h6">Quinta</header>
                                        <div id="aulas_qui">
                                            
                                        </div>

                                    </article>


                                    <article class="dia_sem_aula">
                                        <header class="div-title-box h6">Sexta</header>
                                        <div id="aulas_sex">
                                            
                                        </div>

                                    </article>
                                </div>
                            </section>
                                
                    </section>
                    <section class="col-12 p-0 cronograma text-center mb-3 text-light">
                        <header class="title-box-main ">Participantes da turma</header>
                                <div class="container">
                                    <div class="row" id="participantes">
                                        
                                    </div>  
                                </div>
                    </section>


                    <div id="script">
                        
                    </div>
                    
                    </div>

                    <?php 

                        $query_aula = "select tu.nome_turma, o.* from turma tu inner join (select u.nome, w.* from usuario u inner join (select * from disc_turma t where t.ano = 2020) w on w.id_prof = u.id) o on o.id_turma = tu.id_turma order by tu.nome_turma";

                        $stmt_aula = $conexao->query($query_aula);

                        $result_aula = $stmt_aula->fetchAll(PDO::FETCH_ASSOC);
                           
                    ?>

                    <style type="text/css">
                        .prof-sup{
                            padding: 3px;
                            font-size: 9px;
                            font-style: italic;
                        }
                    </style>
      </div>
    </div>   
    </div>
    </div>
</div>
        
    <?php include '../footer.php'; ?>

</body>
</html>
