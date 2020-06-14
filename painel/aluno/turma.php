<?php
$array_times = ['07:00:00-07:50:00', '07:50:00-08:40:00', '09:00:00-09:50:00', '09:50:00-10:40:00', 
                '13:00:00-13:50:00', '13:50:00-14:40:00', '15:00:00-15:50:00', '15:50:00-16:40:00']; 
$free_time = "Tempo livre";
$array_days = [];

function mkCellDay($subject, $teacher){
    $text = "{$subject} <br> <small>{$teacher}</small>";
    return $text;
}

$ano_atual = date("Y");
$turma = "";
?>
<div class="container">
    <div class="box">
        <div class="div-title-box">
            <span class="title-box-main  d-flex justify-content-center">
                Turma
            </span>
        </div>
            <?php 
            foreach ($array_times as $key => $value){
                for ($i=1; $i <= 5; $i++) { 
                    $split_value = explode("-", $value);
                    $start_time  = $split_value[0];
                    $end_time    = $split_value[1];
                    $query_class_student = "select p.nome, h.* from usuario p inner join(select d.nome_disc, b.* from disciplina d inner join (select rd.dia_da_semana, rd.horario_de_inicio, rd.horario_de_termino, y.id_disc, y.id_prof from recorrencia_disciplina rd inner join (select dt.id_prof, dt.id_DT, dt.id_disc from disc_turma dt inner join (select ta.id_turma from turma_aluno ta where ta.id_aluno = {$id_user_menu} and ta.ano = {$ano_atual}) x on dt.id_turma = x.id_turma and dt.ano = {$ano_atual}) y on rd.id_TD = y.id_DT and rd.dia_da_semana = {$i} and horario_de_inicio = '{$start_time}' and horario_de_termino = '$end_time')b on b.id_disc = d.id_disc) h on h.id_prof = p.id order by h.dia_da_semana ASC";
                    $stmt_class_student = $conexao->query($query_class_student);
                    if($row_class_student = $stmt_class_student->fetch(PDO::FETCH_ASSOC)){
                        $name_subject = $row_class_student['nome_disc'];
                        $teacher = $row_class_student['nome'];
                        array_push($array_days, mkCellDay($name_subject, $teacher));
                    }else{
                        array_push($array_days, $free_time);
                    }
                }
            }
            ?>
            <table class="table table-hover text-center">
                    <thead>
                        <th>Horários</th>
                        <th>Segunda-feira</th>
                        <th>Terça-feira</th>
                        <th>Quarta-feira</th>
                        <th>Quinta-feira</th>
                        <th>Sexta-feira</th>
                    </thead>
                    <tbody>
                        <?php
                        //PERCORRER OS DIAS
                        $x = 0;
                        foreach ($array_times as $key => $value) {
                             
                        ?>
                            
                            <tr>
                                <th><?=$value?></th>
                                <td><?=$array_days[$x + 0]?></td>
                                <td><?=$array_days[$x + 1]?></td>
                                <td><?=$array_days[$x + 2]?></td>
                                <td><?=$array_days[$x + 3]?></td>
                                <td><?=$array_days[$x + 4]?></td>
                            </tr>

                        <?php        
                            
                            $x = $x + 5;
                        }

                        ?>
                        
                    </tbody>
                </table>
    </div>

    <?php 

        $query_id_class = "select id_turma  from turma_aluno where id_aluno = {$id_user_menu} and ano = {$ano_atual}";
        $stmt_id_class = $conexao->query($query_id_class);
        $row_id_class = $stmt_id_class->fetch(PDO::FETCH_ASSOC);
        $id_class = $row_id_class['id_turma'];        

        $query_data_student = "select u.img_profile, u.nome, u.sobrenome from usuario u inner join (select id_aluno, id_TA from turma_aluno where id_turma = {$id_class} and ano = {$ano_atual}) x on u.id = x.id_aluno and u.status = 1
        ";
        $stmt_data_student = $conexao->query($query_data_student);
        $row_data_student = $stmt_data_student->fetchAll(PDO::FETCH_ASSOC);
    
    ?>
    <div class="box">
        <div class="div-title-box">
            <span class="title-box-main  d-flex justify-content-center">
                Participantes
            </span>
        </div>
        <div class="container">
            <div class="row p-3">
                <?php 
                    foreach ($row_data_student as $key => $value) {
                        $img_student = $configBase."/../img/".$value['img_profile'];
                        $name_student = $value['nome'] . " " . $value['sobrenome'];
                ?>
                <div class="col-2">
                    
                        <img src="<?=$img_student?>" class="img-fluid" style="height: 60px; width: 60px; border-radius: 50%">
                        <p><small><?=$name_student?></small></p>
                    
                </div>
                <?php        
                    }
                ?>
            </div>
        </div>
    </div>
</div>
