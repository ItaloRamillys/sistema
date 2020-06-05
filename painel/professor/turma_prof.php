<?php 
$array_subject_class = [];

$array_days = [];

$array_times = ['07:00:00-07:50:00', '07:50:00-08:40:00', '09:00:00-09:50:00', '09:50:00-10:40:00', 
                '13:00:00-13:50:00', '13:50:00-14:40:00', '15:00:00-15:50:00', '15:50:00-16:40:00'];

//array_days
$class_monday = []; 
$class_tuesday = []; 
$class_wednesday = []; 
$class_thursday = []; 
$class_friday = []; 

$query_my_classes = "select h.nome_disc, k.nome_turma, k.ano from disciplina h inner join (select x.*, t.nome_turma from turma t inner join (select * from disc_turma where id_prof = ".$id_user_menu.") x on t.id_turma = x.id_turma) k on k.id_disc = h.id_disc";
$stmt_my_classes  = $conexao->query($query_my_classes);


while($row_my_classes = $stmt_my_classes->fetch(PDO::FETCH_ASSOC)){
    array_push($array_subject_class, ($row_my_classes['nome_turma']." - ".$row_my_classes['nome_disc']." - ".$row_my_classes['ano']));
}

$ano = date('Y');
$free_time = "Tempo livre";

function mkCellDay($classroom, $subject){
    $text = "{$subject} - {$classroom}";
    return $text;
}

foreach ($array_times as $key => $value) {
    for ($i=1; $i <= 5; $i++) { 
    
        $split_value = explode("-", $value);
        $start_time  = $split_value[0];
        $end_time    = $split_value[1];
        $query_class_teacher = "select c.* from (select r.*, m.* from recorrencia_disciplina r inner join (select k.id_DT, h.nome_disc, k.id_turma, k.nome_turma, k.ano from disciplina h inner join (select x.*, t.nome_turma from turma t inner join (select * from disc_turma where id_prof = {$id_user_menu} and ano = {$ano}) x on t.id_turma = x.id_turma) k on k.id_disc = h.id_disc) m on m.id_DT = r.id_TD order by dia_da_semana, horario_de_inicio) c where dia_da_semana = {$i} and horario_de_inicio = '{$start_time}' and horario_de_termino = '{$end_time}'";
        $stmt_class_teacher = $conexao->query($query_class_teacher);
        if($row_class_teacher = $stmt_class_teacher->fetch(PDO::FETCH_ASSOC)){
            $name_class = $row_class_teacher['nome_turma'];
            $name_subject = $row_class_teacher['nome_disc'];
            $start_time = $row_class_teacher['horario_de_inicio'];
            $end_time = $row_class_teacher['horario_de_termino'];     
            array_push($array_days, mkCellDay($name_class, $name_subject));
        }else{
            array_push($array_days, $free_time);
        }
    }

}

?>
<div class="container">
  <div class="box">
    <div class="div-title-box">
        <span class="title-box-main  d-flex justify-content-center">Minhas Turmas - Painel do Professor</span>
    </div>   
        <div class="container">
        
            <div class="row justify-content-center">
                <h2 class="title-box-main my-3">Suas disciplinas este ano</h2>
            </div>
            <div class="row">
                <table class="table table-hover text-center">
                    <thead>
                        <th>Disciplina - Turma</th>
                    </thead>
                    <tbody>
                        <?php 
                            foreach ($array_subject_class as $key => $value) {
                        ?>

                            <tr>
                                <td><?=$value?></td>
                            </tr>
                        
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        
            <div class="row justify-content-center">
                <h2 class="title-box-main my-3">Seu calendário semanal</h2>
            </div>
            <div class="row">
                <table class=" table table-hover">
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
        </div>
    </div>
</div>

