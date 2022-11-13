<?php
$year = date("Y");
$query_class_teacher = "select s.name_subject, y.name_class from subject s inner join(select c.name_class, x.id_subject from class c inner join(SELECT sc.id_class, sc.id_subject FROM `subject_class_lesson` sc where 
							year = {$year} and id_teacher = {$id_user_menu})x on x.id_class = c.id_class)y on y.id_subject = s.id_subject";
$stmt_class_teacher = $conn->query($query_class_teacher);
$row_class_teacher = $stmt_class_teacher->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="container">
    <div class="row">
        <div class="col-12">
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
                                    foreach ($row_class_teacher as $key => $value){
                                        echo "<tr><td><a href='turma/{$value['name_class']}-{$value['name_subject']}-{$year}'>{$value['name_class']} - {$value['name_subject']}</a></td></tr>";
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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


