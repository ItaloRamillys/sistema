<?php 
$query_class_year = "select * from class c";
$stmt_class_year = $conn->query($query_class_year);
$r_class_year = $stmt_class_year->fetchAll(PDO::FETCH_ASSOC);

$options_class_year = "<select class='col-md-3 col-6 my-3' id='turma'><option value=''>Selecione uma turma</option>";
foreach ($r_class_year as $key => $value) {
    $options_class_year .= "<option value='{$value['id_class']}'>{$value['name_class']} - {$value['year']}</option>";
}
$options_class_year .= "</select>";

?>
<div class="container" id="container-main">
    <div class="row">
        <div class="col-12">
            <div id="msg"></div> 
            <div class="box">
            <div class="div-title-box">
                <span class="title-box-main  d-flex justify-content-center">Aulas na escola</span>
            </div>   
                <div class="container">
                    <div class="row justify-content-center">
                        <?=$options_class_year?>
                    </div>
                    <div class="row">
                        <table class="table table-hover text-center">
                            <thead>
                                <th id="title_table">Turma - Disciplina</th>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                    <div class="row">
                        <table class="table table-hover text-center" id="table">
                            <thead>
                                <th>Horários</th>
                                <th>Segunda-feira</th>
                                <th>Terça-feira</th>
                                <th>Quarta-feira</th>
                                <th>Quinta-feira</th>
                                <th>Sexta-feira</th>
                            </thead>
                            <tbody id='body_table'>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script src='http://localhost/sistema/js/school_schedule.js'></script>
<script src='http://localhost/sistema/js/remove_lesson.js'></script>



