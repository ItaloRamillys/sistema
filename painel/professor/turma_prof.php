<?php 
$array_subject_class = [];
$query_my_classes = "select h.nome_disc, k.nome_turma, k.ano from disciplina h inner join (select x.*, t.nome_turma from turma t inner join (select * from disc_turma where id_prof = ".$id_user_menu.") x on t.id_turma = x.id_turma) k on k.id_disc = h.id_disc";
$stmt_my_classes  = $conexao->query($query_my_classes);
$ano = date('Y');
while($row_my_classes = $stmt_my_classes->fetch(PDO::FETCH_ASSOC)){
    array_push($array_subject_class, ($row_my_classes['nome_turma']." - ".$row_my_classes['nome_disc']." - ".$row_my_classes['ano']));
}

$query_class_teacher = "select r.*, m.* from recorrencia_disciplina r inner join (select k.id_DT, h.nome_disc, k.id_turma, k.nome_turma, k.ano from disciplina h inner join (select x.*, t.nome_turma from turma t inner join (select * from disc_turma where id_prof = {$id_user_menu} and ano = {$ano}) x on t.id_turma = x.id_turma) k on k.id_disc = h.id_disc) m on m.id_DT = r.id_TD order by dia_da_semana, horario_de_inicio";
$stmt_class_teacher = $conexao->query($query_class_teacher);
while($row_class_teacher = $stmt_class_teacher->fetch(PDO::FETCH_ASSOC)){

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
            <h2 class="title-box-main my-3">Manhã</h2>
        </div>
        <div class="row">
            <table class=" table table-hover">
                <thead>
                    <th>Segunda-feira</th>
                    <th>Terça-feira</th>
                    <th>Quarta-feira</th>
                    <th>Quinta-feira</th>
                    <th>Sexta-feira</th>
                </thead>
                <tbody>
                    <tr>
                        <td>Química</td>
                        <td>Química</td>
                        <td>Química</td>
                        <td>Química</td>
                        <td>Química</td>
                    </tr>
                    <tr>
                        <td>Química</td>
                        <td>Química</td>
                        <td>Química</td>
                        <td>Química</td>
                        <td>Química</td>
                    </tr>
                    <tr>
                        <td>Química</td>
                        <td>Química</td>
                        <td>Química</td>
                        <td>Química</td>
                        <td>Química</td>
                    </tr>
                    <tr>
                        <td>Química</td>
                        <td>Química</td>
                        <td>Química</td>
                        <td>Química</td>
                        <td>Química</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row justify-content-center">
            <h2 class="title-box-main my-3">Tarde</h2>
        </div>
        <div class="row">
            <table class=" table table-hover">
                <thead>
                    <th>Segunda-feira</th>
                    <th>Terça-feira</th>
                    <th>Quarta-feira</th>
                    <th>Quinta-feira</th>
                    <th>Sexta-feira</th>
                </thead>
                <tbo<?php 

$query = "select r.*, m.* from recorrencia_disciplina r inner join (select k.id_DT, h.nome_disc, k.id_turma, k.nome_turma, k.ano from disciplina h inner join (select x.*, t.nome_turma from turma t inner join (select * from disc_turma where id_prof = 133) x on t.id_turma = x.id_turma) k on k.id_disc = h.id_disc) m on m.id_DT = r.id_TD";

                ?>dy>

                    <tr>
                        <td>Química</td>
                        <td>Química</td>
                        <td>Química</td>
                        <td>Química</td>
                        <td>Química</td>
                    </tr>
                    <tr>
                        <td>Química</td>
                        <td>Química</td>
                        <td>Química</td>
                        <td>Química</td>
                        <td>Química</td>
                    </tr>
                    <tr>
                        <td>Química</td>
                        <td>Química</td>
                        <td>Química</td>
                        <td>Química</td>
                        <td>Química</td>
                    </tr>
                    <tr>
                        <td>Química</td>
                        <td>Química</td>
                        <td>Química</td>
                        <td>Química</td>
                        <td>Química</td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
  </div>
</div>

