<?php
function mkCellDay($subject, $teacher){
    $text = "{$subject} <br> <small>{$teacher}</small>";
    return $text;
}
$array_days = [];
$ano_atual = date("Y");
$turma = "";
?>
<div class="container">
    <div class="row">
        <div class="col-12">
            
        
    <div class="box">
        <div class="div-title-box">
            <span class="title-box-main  d-flex justify-content-center">
                Turma
            </span>
        </div>
            <?php 

            //VERIFICAR SE NO ANO ATUAL EXISTE UMA TURMA QUE ESTE ALUNO ESTÁ MATRICULADO

            $query_class_student_exists = "select * from class_student where id_student = {$id_user_menu} and year = {$ano_atual}";

                   
            $stmt_class_student_exists = $conn->query($query_class_student_exists);
            $row_class_student_exists = $stmt_class_student_exists->fetch(PDO::FETCH_ASSOC);
            if($row_class_student_exists){
        
                $array_times = [1,2,3,4];
                foreach ($array_times as $key => $value){
                    for ($i=1; $i <= 5; $i++) { 
                       $query_class_student = "select p.name, h.* from user p inner join(select d.name_subject, b.* from subject d inner join ( select rd.day_of_week, rd.order_lesson, y.id_subject, y.id_teacher from recurrence_lesson rd inner join ( select dt.id_teacher, dt.id_SC, dt.id_subject, x.id_class from subject_class_lesson dt inner join ( select ta.id_class from class_student ta where ta.id_student = {$id_user_menu} and ta.year = {$ano_atual}) x on dt.id_class = x.id_class and dt.year = {$ano_atual}) y on rd.day_of_week = {$i} and rd.order_lesson = {$value} and rd.id_sc = y.id_sc)b on b.id_subject = d.id_subject) h on h.id_teacher = p.id order by h.day_of_week ASC";
                       
                        $stmt_class_student = $conn->query($query_class_student);
                        if($row_class_student = $stmt_class_student->fetch(PDO::FETCH_ASSOC)){
                            $name_subject = $row_class_student['name_subject'];
                            $teacher = $row_class_student['name'];
                            array_push($array_days, mkCellDay($name_subject, $teacher));
                        }else{
                            array_push($array_days, "Livre");
                        }
                    }
                }
            ?>
        <table class="table table-hover text-center d-md-table table-responsive">
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
            }
            else{
                echo "<p class='msg msg-warn'>Você não está cadastrado em nenhuma turma este ano</p>";
            }
                ?>
                
            </tbody>
        </table>
    </div>

    <?php 

        $row_data_student = [];
        $query_id_class = "select id_class  from class_student where id_student = {$id_user_menu} and year = {$ano_atual}";
        $stmt_id_class = $conn->query($query_id_class);
        $row_id_class = $stmt_id_class->fetch(PDO::FETCH_ASSOC);
        if($row_id_class){
            $id_class = $row_id_class['id_class'];        
            $query_data_student = "select u.img_profile, u.name, u.last_name from user u inner join (select id_student, id_CS from class_student where id_class = {$id_class} and year = {$ano_atual}) x on u.id = x.id_student and u.status = 1
            ";
            $stmt_data_student = $conn->query($query_data_student);
            $row_data_student = $stmt_data_student->fetchAll(PDO::FETCH_ASSOC);
        }

    ?>
    
    <div class="box" id="alunos_turma">
        <div class="div-title-box">
            <span class="title-box-main  d-flex justify-content-center">
                Participantes
            </span>
        </div>
        <div class="container">
            <div class="row justify-content-center align-items-center p-2">
                <?php 
                    foreach ($row_data_student as $key => $value) {
                        $img_profile = render_img(
                            __DIR__."/../../img/".$value['img_profile'],
                            $configBase."/../img/".$value['img_profile'],
                            $configBase."/../img/padrao/img-profile-default.jpg",
                            null,
                            "rounded-circle",
                            60,
                            60
                        );
                        $img_student = $configBase."/../img/".$value['img_profile'];
                        $name_student = $value['name'] . " " . $value['last_name'];
                ?>
                <div class="col-2">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-12 col-md-6 pr-md-0 d-flex justify-content-center">
                            <?=$img_profile?>
                        </div>
                        <div class="col-12 col-md-6 pl-md-0">
                           <p class="nome_aluno"><?=$name_student?></p>
                        </div>
                    </div>    
                </div>
                <?php        
                    }
                ?>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<style type="text/css">
    .box#alunos_turma img{
        width: 60px;
        height: 60px;
    }
    .box#alunos_turma .nome_aluno{
        font-size: 14px;
    }

    @media only screen and (max-width: 768px){
        .box#alunos_turma img{
            width: 30px;
            height: 30px;
        }
        .box#alunos_turma .nome_aluno{
            text-align: center;
            font-size: 10px;
            line-height: 1em;
        }
    }
</style>