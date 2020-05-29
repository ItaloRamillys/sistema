<div class="container">
  <div class="row">
    <div class="col-md-9 col-12">
        <div class="box">
        <div class="div-title-box">
            <h1 class="title-box-main d-flex justify-content-center">Turma</h1>
        </div>

        <div class="container py-2">
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

                  $result .= "</select> <input type='submit' class='btn btn-primary ml-2' value='Buscar' onclick='getDadosAjaxCronograma()'></div></div>";

                  echo $result;
                ?>
            </div>

            <section class="col-12 text-center text-light rounded" id="box-black">
            
                <header class="div-title-box h5">
                    <span>
                        Cronograma da turma
                    </span>                
                </header>

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
                
            <div class="container div-title-box rounded cronograma text-center my-3 text-light" id="box-black">
                <div class="row">
                    <div class="col-12">
                        <header class="h5">
                            <span>
                            Participantes da turma
                            </span>                
                        </header>   
                        <div class="row" id="participantes">
                            
                        </div>    
                    </div>  
                </div>
            </div>

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
<div class="col-md-3 col-12">
    <?php require 'sidebar.php'; ?>
</div>
</div>
</div>
<script src='http://localhost/sistema/js/ajax_cronograma.js'></script>  