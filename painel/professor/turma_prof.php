<?php 
$array_subject_class = [];

$array_days = [];

$array_times = ['07:00:00-07:50:00', '07:50:00-08:40:00', '09:00:00-09:50:00', '09:50:00-10:40:00', 
                '13:00:00-13:50:00', '13:50:00-14:40:00', '15:00:00-15:50:00', '15:50:00-16:40:00']; 

$query_my_classes = "select h.name_subject, k.name_class, k.year from subject h inner join (select x.*, t.name_class from class t inner join (select * from subject_class where id_teacher = ".$id_user_menu.") x on t.id_class = x.id_class) k on k.id_subject = h.id_subject";
$stmt_my_classes  = $conn->query($query_my_classes);

while($row_my_classes = $stmt_my_classes->fetch(PDO::FETCH_ASSOC)){
    array_push($array_subject_class, ($row_my_classes['name_class']." - ".$row_my_classes['name_subject']." - ".$row_my_classes['year']));
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
        $query_class_teacher = "select c.* from (select r.*, m.* from recurrence_lesson r inner join (select k.id_SC, h.name_subject, k.id_class, k.name_class, k.year from subject h inner join (select x.*, t.name_class from class t inner join (select * from subject_class where id_teacher = {$id_user_menu} and year = {$ano}) x on t.id_class = x.id_class) k on k.id_subject = h.id_subject) m on m.id_SC = r.id_subject_class order by day_of_week, start_time_lesson) c where day_of_week = {$i} and start_time_lesson = '{$start_time}' and end_time_lesson = '{$end_time}'";
        $stmt_class_teacher = $conn->query($query_class_teacher);
        if($row_class_teacher = $stmt_class_teacher->fetch(PDO::FETCH_ASSOC)){
            $name_class = $row_class_teacher['name_class'];
            $name_subject = $row_class_teacher['name_subject'];
            $start_time = $row_class_teacher['start_time_lesson'];
            $end_time = $row_class_teacher['end_time_lesson'];     
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
        <span class="title-box-main  d-flex justify-content-center">Minhas aulas - Painel do Professor</span>
    </div>   
        <div class="container">
        
            <div class="row justify-content-center">
                <h2 class="title-box-main my-2 col-6 text-center">Suas aulas este ano</h2>
            </div>
            <div class="row">
                <table class="table table-hover text-center">
                    <thead>
                        <th>Turma - Disciplina</th>
                    </thead>
                    <tbody>
                        <?php 
                            foreach ($array_subject_class as $key => $value){
                               $explode_class = explode(" - ", $value);
                               $class_exp = $explode_class[0];
                               $disc_exp = $explode_class[1];
                               $ano_exp = $explode_class[2];
                        ?>

                            <tr>
                                    <td>
                                        <a href="<?=$configBase?>/professor/turma/<?=$class_exp?>-<?=$disc_exp?>-<?=$ano_exp?>">
                                            <?=$value?>
                                        </a>
                                    </td>
                            </tr>
                        
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        
            <div class="row justify-content-center">
                <h2 class="title-box-main my-2 col-6 text-center">Seu calendário semanal</h2>
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


