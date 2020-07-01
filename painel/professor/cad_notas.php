<div class="container">
<div id="msg"></div>
  <div class="row">
    <div class="col-12">
      <div class="box">
        <div class="div-title-box">
          <span class="title-box-main  d-flex justify-content-center">Cadastro de notas</span>
        </div>
      <div class="container">
          
        <div class="msg-aluno">
          <section class='row'> 
            <div class='divisao-cad col-12'>
              <article>
                
              <form id="form">

              <?php 

                $query = "select k.id_DT, h.nome_disc, k.id_turma, k.nome_turma, k.ano, k.id_turma from disciplina h inner join (select x.*, t.nome_turma from turma t inner join (select * from disc_turma where id_prof = ".$id_user_menu.") x on t.id_turma = x.id_turma) k on k.id_disc = h.id_disc";
                $stmt  = $conexao->query($query);
                
                $result = "
                                <div class='title-box-main  d-flex justify-content-center'>
                                  Selecione a turma
                                </div>

                              <div class='col-12 d-flex justify-content-center align-items-center'><select name='turma_ano' id='turma_ano' class='ml-md-3 my-2'>
                              ";
                  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

                    $ano_q = $row['ano'];
                    $turma_q = $row['nome_turma'];
                    $id_turma_q = $row['id_turma'];
                    $disc_nome = $row['nome_disc'];
                    $id_DT = $row['id_DT'];
                    
                    $result .= "<option value = '{$id_turma_q}-{$ano_q}-{$disc_nome}-{$id_DT}'>{$turma_q} - {$disc_nome} - {$ano_q}</option>";

                  }

                $result .= "</select></div>";

                echo $result;
              ?>

                <input type="hidden" name="prof" value=<?php echo $id_user_menu ?>>
                <div class='row justify-content-center align-items-center'>
                  <label class="col-12 d-flex justify-content-center align-items-center">Período: </label><input class='col-3 d-flex justify-content-center align-items-center' type='number' name='periodo' id='periodo' min='1' max='4' required="required">
                </div>
                <div class='content-turma col-12 d-flex justify-content-center align-items-center'>
                  <div class='btn btn-primary my-2 btn-notas' value='Buscar'>Buscar</div>
                </div>
                <div  id="result-falta"></div>

              </form>
              </article>
            </div>
          </section>
        </div>
      </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="<?=$configBase.'/../js/notas.js'?>"></script>
<script type="text/javascript" src="<?=$configBase.'/../js/cad_notas.js'?>"></script>

