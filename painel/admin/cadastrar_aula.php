<div class="container">
  <div class="row">
    <div class="col-md-9 col-12">
      <div id="msg"></div>
      <div class="box">
        <header class="div-title-box">
          <h1 class="title-box-main  d-flex justify-content-center">Preencher disciplinas em turmas</h1>
        </header>
        <div class="container p-3">
          <form id="form"> 
          <?php 

            $query = "select * from class";                      
            $stmt  = $conn->query($query);

            $result = "
                        <div class='col-12 py-2'>
                          Selecione a turma a qual deseja preencher <select name='id_class' class=''>
                          ";

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
              $name_class = $row['name_class'];
              $id_class = $row['id_class'];
              $result .= "<option value='{$id_class}'>{$name_class}</option>";
            }

            $result .= "</select> </div>";

            echo $result;

            $query2 = "select * from subject";                      
            $stmt2  = $conn->query($query2);
            
            $result2 = "
                        <div class='col-12 py-2'>
                          Selecione a disciplina<select name='id_subject' class=''>
                          ";

            while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
              $name_subject = $row2['name_subject'];
              $id_subject = $row2['id_subject'];
              $result2 .= " <option value='{$id_subject}'>{$name_subject}</option>";
            }

            $result2 .= "</select> </div>";

            echo $result2;

            $query3 = "select * from user where type = 1 order by name asc";                      
            $stmt3 = $conn->query($query3);
            
            $result3 = "
                        <div class='col-12 py-2'>
                          Selecione o professor <select name='id_teacher' class=''>
                          ";

            while($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)){
              $name = $row3['name'];
              $last_name = $row3['last_name'];
              $id_user_teacher = $row3['id']; 
              $result3 .= "<option value='{$id_user_teacher}'>{$name} {$last_name}</option>";
            }

            $result3 .= "</select></div>";

            echo $result3;
          ?>

            <div class='col-12 py-2'>
                <div class='content-turma'>
                Selecione o ano 
                <input type="text" name="year">              
	            </div>
	        </div>        
	    	<div class="col-12 py-2">
	    		
	    	<input type="submit" value="Cadastrar"  class="btn btn-sm" name="">
	    	</div>
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
