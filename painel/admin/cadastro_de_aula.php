<div class="container">
  <div id="msg"></div>
<div class="row">
  <div class="col-md-9 col-12">
    <div class="box">

      <header class="div-title-box">
        <h1 class="title-box-main  d-flex justify-content-center">Preencher disciplinas em turmas</h1>
      </header>
      <div class="container p-3">
          <form id="form"> 
          <?php 

            $query = "select * from turma";                      
            $stmt  = $conexao->query($query);
            
            $result = "<div class='row p-2'>

                        <div class='content-turma col-12'>
                        
                          Selecione a turma a qual deseja preencher <select name='turma' class='ml-3'>
                          ";

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
              $turma = $row['nome_turma'];
              $id_turma = $row['id_turma'];
              $result .= "<option value='{$id_turma}'>{$turma}</option>";
            }

            $result .= "</select> </div></div>";

            echo $result;

            $query2 = "select * from disciplina";                      
            $stmt2  = $conexao->query($query2);
            
            $result2 = "<div class='row p-2'>

                        <div class='content-turma col-12'>
                        
                          Selecione a disciplina<select name='disciplina' class='ml-3'>
                          ";

            while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
              $nome_disc = $row2['nome_disc'];
              $id_disc = $row2['id_disc'];
              $result2 .= " <option value='{$id_disc}'>{$nome_disc}</option>";
            }

            $result2 .= "</select> </div></div>";

            echo $result2;

            $query3 = "select * from usuario where tipo = 1 order by nome asc";                      
            $stmt3 = $conexao->query($query3);
            
            $result3 = "<div class='row p-2'>

                        <div class='content-turma col-12'>
                        
                          Selecione o professor <select name='professor' class='ml-3'>
                          ";

            while($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)){
              $nome_usu = $row3['nome'];
              $sobrenome = $row3['sobrenome'];
              $id_prof_disc = $row3['id']; 
              $result3 .= "<option value='{$id_prof_disc}'>{$nome_usu} {$sobrenome}</option>";
            }

            $result3 .= "</select></div></div>";

            echo $result3;
          ?>

          <?php 
              $queryAno = "select distinct(ano) from turma_aluno";

              $select = "<div class='row p-2'>
                          <div class='col-12'>
                            <div class='content-turma'>
                            Selecione o ano 
                              <select name='ano' required/>
                        ";

              foreach ($conexao->query($queryAno) as $row) {
                  if(!empty($row)){
                      $select .= "<option value='{$row['ano']}'>{$row['ano']}</option>";
                  }
              }

              $select .= "</select></div></div></div>";

              echo $select;
          ?>

          <input type="submit" value="Cadastrar"  class="btn btn-primary" name="">
          </form>
      </div>
    </div>
  </div>
  <div class="col-md-3 col-12">
    <?php require 'sidebar.php'; ?>
  </div>
</div>
</div>

<script src='http://localhost/sistema/js/ver_disc.js'></script>
<script src='http://localhost/sistema/js/cad_aula.js'></script>
