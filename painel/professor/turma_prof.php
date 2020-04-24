
<div class="container">
  <div class="box">
    <div class="div-title-box">
        <span class="title-box-main  d-flex justify-content-center">Minhas Turmas - Painel do Professor</span>
    </div>   
    <div class="container">
      <div class="row mt-3 d-flex justify-content-center flex-column">

        <div id="ano" class="d-flex justify-content-center">
            
            <?php 

            ?>

            <button class="rounded p-1 text-light bg-primary mr-2">2017</button>
            <button class="rounded p-1 text-light bg-primary mr-2">2018</button>
            <button class="rounded p-1 text-light bg-primary mr-2">2019</button>

        </div>

        <span class="title-box-main ">Cronograma da semana</span>
        
        <!-- 

            Criar funçao JS que recebe o id_principal de disciplina_turma_prof
            Passar para um Ajax que busca no banco de dados os alunos e seus id's

        -->

        <ul>
        
            <li>
                Segunda
                <ul>
                    <span class="hora_aula">7:00 - 7:55 - </span>
                    <span class="aula_disc">Português - </span>
                    <span class="aula_turma">8C - </span>
                    <button id="id_turma" class="rounded p-1 bg-primary text-light" value="id_turma">Acessar turma</button>
                </ul>
            </li>

            <li>
                Terça
                <ul>
                    <span class="hora_aula">7:00 - 7:55 - </span>
                    <span class="aula_disc">Português - </span>
                    <span class="aula_turma">8C - </span>
                    <button id="id_turma" class="rounded p-1 bg-primary text-light" value="id_turma">Acessar turma</button>
                </ul>
            </li>

            <li>
                Quarta
                <ul>
                    <span class="hora_aula">7:00 - 7:55 - </span>
                    <span class="aula_disc">Português - </span>
                    <span class="aula_turma">8C - </span>
                    <button id="id_turma" class="rounded p-1 bg-primary text-light" value="id_turma">Acessar turma</button>
                </ul>
            </li>

            <li>
                Quinta
                <ul>
                    <span class="hora_aula">7:00 - 7:55 - </span>
                    <span class="aula_disc">Português - </span>
                    <span class="aula_turma">8C - </span>
                    <button id="id_turma" class="rounded p-1 bg-primary text-light" value="id_turma">Acessar turma</button>
                </ul>
            </li>

            <li>
                Sexta
                <ul>
                    <span class="hora_aula">7:00 - 7:55 - </span>
                    <span class="aula_disc">Português - </span>
                    <span class="aula_turma">8C - </span>
                    <button id="id_turma" class="rounded p-1 bg-primary text-light" value="id_turma">Acessar turma</button>
                </ul>
            </li>
        
        </ul>
          
      </div>
  </div>
    <span class="title-box-main ">Participantes da turma</span>
    <div class="container" id="participantes">
        <?php
                
                if(isset($_SESSION['turma_aluno'])){
                    $id_turma = $_SESSION['turma_aluno'];  
                    $result_usuario = "SELECT nome, sobrenome FROM aluno y inner join (select b.id_aluno from aluno_turma b where b.id_turma = ". $id_turma .") as x on y.id_alu = x.id_aluno order by nome";
                    $resultado_usuario = mysqli_query($mysqli, $result_usuario);
                    if (mysqli_num_rows($resultado_usuario) > 0) {
                    while($row = mysqli_fetch_assoc($resultado_usuario)) {
                      echo "<div class='row mt-3'>
                              <div class='col-md-6'>
                                <div class='row'>
                                  <div class='col-md-6 d-flex justify-content-center'><img width='100px' src='../img/icon-profile.png'></div>
                                  <div class='col-md-6 d-flex align-items-center'>". utf8_encode($row['nome']) . " ". utf8_encode($row['sobrenome']) ."</div>
                              </div>
                            </div>
                            </div>
                           ";
                    }
                  } 
                }
                else {
                    echo "Nenhum registro de turma encontrado";
                }

        ?>
      
      
    </div>
  </div>
</div>

