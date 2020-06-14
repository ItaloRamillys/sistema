      <?php
        $disciplinas = array();
        $notas = array();

        $ano_atual = date("Y");

        $query_disc = "select nome_disc from disciplina d INNER join (select distinct(id_disc) from disc_turma b inner join (select id_turma, ano from turma_aluno where id_aluno = " . $id_user_menu . " and ano = {$ano_atual}) y on y.id_turma = b.id_turma and y.ano = b.ano)x on d.id_disc = x.id_disc order by nome_disc asc";

        $stmt_disc = $conexao->query($query_disc);

        $row_disc = $stmt_disc->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($row_disc as $key => $value) {
          $disciplinas[$key] = $value['nome_disc'];
        }

        $query_notas = "select nome_disc, x.nota, x.periodo from disciplina d inner join (select dt.id_disc, n.* from disc_turma dt inner join (select * from disc_alu_turma where id_aluno = {$id_user_menu}) n on dt.id_DT = n.id_DT and dt.ano = {$ano_atual})x on d.id_disc = x.id_disc order by nome_disc, periodo asc";

        $stmt_notas = $conexao->query($query_notas);

        $row_notas = $stmt_notas->fetchAll(PDO::FETCH_ASSOC);

        
      ?>
<div class="container">
  <div class="row">
    <div class="col-12">
      <div class="box box-tabela">
            <div class="div-title-box">
            <span class="title-box-main  d-flex justify-content-center">Notas</span></div>
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

                                $result .=  "<td>" . $value['nome_disc'] . "</td>";
                                
                                for ($i=0; $i < 5; $i++) { 
                                  if (array_key_exists(($i), $row_notas)) {
                                    if($row_notas[$i]['nome_disc'] == $value['nome_disc']){
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
        