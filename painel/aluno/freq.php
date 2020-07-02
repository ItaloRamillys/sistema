<div class="container">
    <div class="row">
        <?php
            //Declaracoes

            $qtde_falta = array();

            $ano_atual = date("Y");

            $completa_query = "";

            $query_disc = "select nome_disc from disciplina d INNER join (select distinct(id_disc) from disc_turma b inner join (select id_turma, ano from turma_aluno where id_aluno = " . $id_user_menu . " and ano = 2020) y on y.id_turma = b.id_turma and y.ano = b.ano)x on d.id_disc = x.id_disc order by nome_disc asc";

            $stmt_disc = $conexao->query($query_disc);

            //DIsciplinas cursadas pelo aluno
            $row_disc = $stmt_disc->fetchAll(PDO::FETCH_ASSOC);

            for ($i=0; $i < 12; $i++) { 

                if (($i+1) < 10) {
                    $j = "0".($i+1);
                }else{
                    $j = ($i+1);
                }

                $completa_query = "'{$ano_atual}-{$j}-%' group by id_DT)x on dt.id_DT = x.id_DT)y on d.id_disc = y.id_disc order by nome_disc asc";
                $query = "select nome_disc, y.* from disciplina d inner join(select id_disc, x.* from disc_turma dt inner join (select id_DT, count(*) as qtde_falta from frequencia2 WHERE id_aluno = " . $id_user_menu . " and data like " . $completa_query;

                $stmt_month = $conexao->query($query);

                $row_month = $stmt_month->fetchAll(PDO::FETCH_ASSOC);
                foreach ($row_month as $key => $value) {
                    $qtde_falta[$i][$value['nome_disc']] = $value['qtde_falta'];
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

                                    $result .=  "<td>" . $value['nome_disc'] . "</td>";

                                    for ($i=0; $i < 12; $i++) { 
                                        if (array_key_exists(($i), $qtde_falta)) {
                                            if(array_key_exists($value['nome_disc'], $qtde_falta[($i)])){
                                                $result .= "<td>" . $qtde_falta[($i)][$value['nome_disc']] . "</td>";
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