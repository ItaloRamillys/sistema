<?php
$disciplinas = array();
$notas = array();
$ano_atual = date("Y");

$query_disc = "select name_subject from subject d INNER join (select distinct(id_subject) from subject_class_lesson b inner join (select id_class, year from class_student where id_student = " . $id_user_menu . " and year = {$ano_atual}) y on y.id_class = b.id_class and y.year = b.year)x on d.id_subject = x.id_subject order by name_subject asc";

$stmt_disc = $conn->query($query_disc);
$row_disc = $stmt_disc->fetchAll(PDO::FETCH_ASSOC);

foreach ($row_disc as $key => $value) {
  $disciplinas[$key] = $value['name_subject'];
}

$query_notas = "select name_subject, x.value_grade, x.period from subject d inner join (select dt.id_subject, n.* from subject_class_lesson dt inner join (select * from grade where id_student = {$id_user_menu}) n on dt.id_SC = n.id_SC and dt.year = {$ano_atual})x on d.id_subject = x.id_subject order by name_subject, period asc";

$stmt_notas = $conn->query($query_notas);
$row_notas = $stmt_notas->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="container">
  <div class="row">
    <div class="col-12">
      <div class="box box-tabela">
        <div class="div-title-box">
          <span class="title-box-main  d-flex justify-content-center">Notas</span>
        </div>
        <table class="table table-hover">
          <thead>
            <tr>
                <th>Disciplina</th>
                <th>1° Período</th>
                <th>2° Período</th>
                <th>3° Período</th>
                <th>4° Período</th>
                <th>Nota Recuperação</th>
                <th>Média Final</th>
                <th>Situação</th>
            </tr>
          </thead>
          <tbody>
            <?php 
                $result = "";
                foreach ($row_disc as $key => $value) {
                  $media = 0;
                  $soma_nota = 0;
                  $qtde_nota = 0;
                  $result .= "<tr>";
                  $result .=  "<td>" . $value['name_subject'] . "</td>";
                
                    for ($i=0; $i < 5; $i++) { 
                      if (array_key_exists(($i), $row_notas)) {
                        if($row_notas[$i]['name_subject'] == $value['name_subject']){
                          if($qtde_nota < 5){
                            $soma_nota += $row_notas[$i]['nota'];
                          }
                          $qtde_nota++;

                          $result .=  "<td>" . $row_notas[$i]['nota'] . "</td>";
                        }else{
                          $result .=  "<td> - </td>";
                        }
                      }
                      else{
                        $result .=  "<td> - </td>";
                      }
                      
                    }
                    if ($qtde_nota > 0 && $query_notas < 5) {
                      $media = $soma_nota/$qtde_nota; 
                    }else if($qtde_nota > 0 && $query_notas == 5){
                      $media = ($media + $row_notas[4]['nota'])/2;
                    }
                    $result .= "<td>" . $media . "</td>";

                    if ($qtde_nota < 4) {
                      $result .= "<td>Aguardando notas</td>";
                    }else if ($qtde_nota == 4) {
                      if ($media >= 7) {
                        $result .= "<td>Aprovado</td>";
                      }else if($media < 4){
                        $result .= "<td>Reprovado</td>";
                      }else{
                        $result .= "<td>Aguardando resultado da recuperação</td>";
                      }
                    }else if($qtde_nota == 5){
                      if ($media >= 5) {
                        $result .= "<td>Aprovado</td>";
                      }else if($media < 4){
                        $result .= "<td>Reprovado</td>";
                      }
                    }
                    $result .= "</tr>";
                }
                echo $result;
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
        