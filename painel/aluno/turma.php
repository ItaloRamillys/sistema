<?php

$array_times = ['07:00:00-07:50:00', '07:50:00-08:40:00', '09:00:00-09:50:00', '09:50:00-10:40:00', 
                '13:00:00-13:50:00', '13:50:00-14:40:00', '15:00:00-15:50:00', '15:50:00-16:40:00']; 

$ano_atual = date("Y");
$turma = "";
$query_turma = "select d.nome_disc, b.* from disciplina d inner join (select rd.dia_da_semana, rd.horario_de_inicio, rd.horario_de_termino, y.id_disc from recorrencia_disciplina rd inner join (select dt.id_prof, dt.id_DT, dt.id_disc from disc_turma dt inner join (select ta.id_turma from turma_aluno ta where ta.id_aluno = 38 and ta.ano = 2020) x on dt.id_turma = x.id_turma and dt.ano = 2020) y on rd.id_TD = y.id_DT)b on b.id_disc = d.id_disc order by b.dia_da_semana ASC";

$stmt_turma = $conexao->query($query_turma);

$turma = $stmt_turma->fetch(PDO::FETCH_ASSOC); 
?>
<div class="container">
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
    </div>
</div>
