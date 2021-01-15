<div class="container">
    <div class="row">
        <?php
            //Declaracoes

            $qtde_falta = array();

            $ano_atual = date("Y");

            $completa_query = "";

            $query_disc = "select name_subject from subject d INNER join (select distinct(id_subject) from subject_class_lesson b inner join (select id_class, year from class_student where id_student = " . $id_user_menu . " and year = 2020) y on y.id_class = b.id_class and y.year = b.year)x on d.id_subject = x.id_subject order by name_subject asc";

            $stmt_disc = $conn->query($query_disc);

            //DIsciplinas cursadas pelo aluno
            $row_disc = $stmt_disc->fetchAll(PDO::FETCH_ASSOC);

            for ($i=0; $i < 12; $i++) { 

                if (($i+1) < 10) {
                    $j = "0".($i+1);
                }else{
                    $j = ($i+1);
                }

                $completa_query = "'{$ano_atual}-{$j}-%' group by id_SC)x on dt.id_SC = x.id_SC)y on d.id_subject = y.id_subject order by name_subject asc";
                $query = "select name_subject, y.* from subject d inner join(select id_subject, x.* from subject_class_lesson dt inner join (select id_SC, count(*) as qtde_falta from attendance WHERE id_user = " . $id_user_menu . " and date like " . $completa_query;

                $stmt_month = $conn->query($query);

                $row_month = $stmt_month->fetchAll(PDO::FETCH_ASSOC);
                foreach ($row_month as $key => $value) {
                    $qtde_falta[$i][$value['name_subject']] = $value['qtde_falta'];
                }
            }

        ?> 
        <div class="col-12">
            <div class="box box-tabela">
                <div class="div-title-box">
                    <span class="title-box-main  d-flex justify-content-center">Frequência</span></div>
                <table class="table table-hover">
                          <thead>
                            <tr>
                                <th>Disciplina</th>
                                <th>JAN</th>
                                <th>FEV</th>
                                <th>MAR</th>
                                <th>ABR</th>
                                <th>MAI</th>
                                <th>JUN</th>
                                <th>JUL</th>
                                <th>AGO</th>
                                <th>SET</th>
                                <th>OUT</th>
                                <th>NOV</th>
                                <th>DEZ</th>
                            </tr>
                          </thead>
                          <tbody>
                            
                            <?php 

                                $result = "";

                                foreach ($row_disc as $key => $value) {
                                    $result .= "<tr>";

                                    $result .=  "<td>" . $value['name_subject'] . "</td>";

                                    for ($i=0; $i < 12; $i++) { 
                                        if (array_key_exists(($i), $qtde_falta)) {
                                            if(array_key_exists($value['name_subject'], $qtde_falta[($i)])){
                                                $result .= "<td>" . $qtde_falta[($i)][$value['name_subject']] . "</td>";
                                                }else{
                                                    $result .= "<td> 0 </td>";
                                                }
                                        }else{
                                             $result .= "<td> 0 </td>";
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