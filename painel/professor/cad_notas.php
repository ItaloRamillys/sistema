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

                $query = "select k.id_sc, h.name_subject, k.id_class, k.name_class, k.year, k.id_class from subject h inner join (select x.*, t.name_class from class t inner join (select * from subject_class_lesson where id_teacher = ".$id_user_menu.") x on t.id_class = x.id_class) k on k.id_subject = h.id_subject";

                $stmt  = $conn->query($query);
                
                $result = "
                                <div class='title-box-main  d-flex justify-content-center'>
                                  Selecione a turma
                                </div>

                              <div class='col-12 d-flex justify-content-center align-items-center'><select name='turma_ano' id='turma_ano' class='ml-md-3 my-2'>
                              ";
                  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

                    $ano_q = $row['year'];
                    $turma_q = $row['name_class'];
                    $id_turma_q = $row['id_class'];
                    $disc_nome = $row['name_subject'];
                    $id_DT = $row['id_sc'];
                    
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

