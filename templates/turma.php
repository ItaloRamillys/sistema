<?php
    require_once('C:\xampp\htdocs\proj_esc\authentic.php');
    include_once ('C:\xampp\htdocs\proj_esc\conexao.php');

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
              
      
            <style type="text/css">
                @media(max-width: 525px){

                    table{
                        font-size: 12px;
                        overflow-x: scroll;
                    }
                    table td{
                        padding: .5rem !important;
                    }
                }
                @media(max-width: 767px){

                    table{
                        width: 100%;
                        overflow-x: scroll;
                    }
                    table td{
                        padding: .5rem !important;
                    }
                }
            </style>

    <div class="row m-0">
                     
      <?php

        require '../menu.php';

        $ano_atual = date("Y");
        $turma = "";
        $query_turma = "select nome_turma from turma t inner join (select id_turma from turma_aluno where id_aluno = '{$id_user_menu}' and ano = {$ano_atual}) x on t.id_turma = x.id_turma";
        $stmt_turma = $conexao->query($query_turma);

        $turma = $stmt_turma->fetch(PDO::FETCH_ASSOC); 

      ?>

    <div class="col-md-10 pb-4">
        <div class="container">
            <div class="row">
            <div class="box col-12 p-0">
                <div class="div-title-box">
                <span class="title-box-main  d-flex justify-content-center">
                    <?php 

                    if ($turma == "") {
                        echo ("Você não está cadastrado em uma turma este ano");
                    }else{
                        echo ("Turma " . $turma['nome_turma']); 
                    }
                    
                    ?>
                </span>
                    </div>
                
                    <span class="title-box-main ">Cronograma da semana</span>

                    <?php 



                        $query_aula = "select u.nome, j.nome_disc, j.dia_sem, j.hora from usuario u inner join(select d.nome_disc, y.dia_sem, y.hora, y.id_prof from disciplina d INNER join ((select x.id_disc, x.dia_sem, x.hora, x.id_prof from disc_turma x INNER JOIN (select t.id_turma from turma_aluno t where t.id_aluno = 3 and t.ano = 2020) w on x.id_turma = w.id_turma and x.ano = 2020) y) on y.id_disc = d.id_disc)j on u.id = j.id_prof order by j.dia_sem, j.hora asc";

                        $stmt_aula = $conexao->query($query_aula);

                        $aula_1 = array();
                        $aula_2 = array();
                        $aula_3 = array();
                        $aula_4 = array();
                        $aula_5 = array();

                        $prof_aula_1 = array();
                        $prof_aula_2 = array();
                        $prof_aula_3 = array();
                        $prof_aula_4 = array();
                        $prof_aula_5 = array();

                        $row_aula = $stmt_aula->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($row_aula as $var) {
                            if($var['dia_sem'] == 1){
                                array_push($aula_1, $var['nome_disc']);
                                array_push($prof_aula_1, $var['nome']);
                            }
                            else if($var['dia_sem'] == 2){
                                array_push($aula_2, $var['nome_disc']);
                                array_push($prof_aula_2, $var['nome']);
                            }
                            else if($var['dia_sem'] == 3){
                                array_push($aula_3, $var['nome_disc']);
                                array_push($prof_aula_3, $var['nome']);
                            }
                            else if($var['dia_sem'] == 4){
                                array_push($aula_4, $var['nome_disc']);
                                array_push($prof_aula_4, $var['nome']);
                            }
                            else if($var['dia_sem'] == 5){
                                array_push($aula_5, $var['nome_disc']);
                                array_push($prof_aula_5, $var['nome']);
                            }
                           
                        }

                    ?>

                    <style type="text/css">
                        .prof-sup{
                            padding: 3px;
                            font-size: 9px;
                            font-style: italic;
                        }
                    </style>

                    <table class="table table-hover">
                              <thead>
                        <tr>
                            <th>Horário</th>
                            <th>Segunda</th>
                            <th>Terça</th>
                            <th>Quarta</th>
                            <th>Quinta</th>
                            <th>Sexta</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                            <td>7:00 - 7:55</td>
                            
                        </tr>
                        <tr>
                            <td>7:55 - 8:50</td>
                            
                        </tr>
                        <tr>
                            <td>9:00 - 9:55</td>
                            
                        </tr>
                        <tr>
                            <td>9:55 - 10:50</td>
                            
                        </tr>

                      </tbody>
                    </table>
              
        <span class="title-box-main ">Participantes da turma</span>
        <div class="container">
        <?php
                    $ano = date('Y');

                    $result_usuario = "select u.img_profile, u.nome, u.sobrenome from usuario u inner join (select id_aluno from turma_aluno a INNER join (select id_turma from turma_aluno where ano = {$ano} AND id_aluno = {$id_user_menu}) b on a.id_turma = b.id_turma) x on u.id = x.id_aluno";
                        
                    $res = "<div class='row my-3'>";

                        $resultado_usuario = mysqli_query($mysqli, $result_usuario);
                        if (mysqli_num_rows($resultado_usuario) > 0) {
                        while($row = mysqli_fetch_assoc($resultado_usuario)) {

                            $img_profile_turma = $row['img_profile'];

                          $res.= "
                                  <div class='col-md-4 col-6 p-3'>
                                    <div class='row'>
                                      <div class='col-md-6 d-flex justify-content-center align-items-center'><img width='100px' height='100px' style='border-radius: 50%;' src='../img/{$img_profile_turma}'></div>
                                      <div class='col-md-6 d-flex justify-content-center align-items-center'>". utf8_encode($row['nome']) . " ". utf8_encode($row['sobrenome']) ."</div>
                                  </div>
                                </div>
                               ";
                        }
                      } 
                    
                    else {
                        echo "Nenhum registro de turma encontrado";
                    }
                    $res .= "</div>";

                        echo $res;

           ?>
          
          
        </div>
      </div>
    </div>

    <div class="col-3">
        <div class="container">                             

        </div>
    </div>      
    </div>
    </div>
</div>
        
    <?php include '../footer.php'; ?>
    
</body>
</html>
