<div class="container"> 
  <div id="msg"></div>
  <div class="row">
    <div class="col-md-9 col-12">   
      <div class="box">
        <header class="div-title-box">
          <h1 class="title-box-main  d-flex justify-content-center">Preencher turma</h1>
        </header>
        <div class="div-content-box p-3">
          <form id="form" method="POST">
	           	<div class="row">
                <label class="col-4">Selecione a turma</label>
                <select class="col-4">  
                <?php 

                $query_class = "select * from class";
                $stmt_class = $conn->query($query_class);
                while($row_class = $stmt_class->fetch(PDO::FETCH_ASSOC)){

                ?>
                  
                  <option><?=$row_class['name_class'] . " - " . $row_class['year']?></option> 

                <?php

                }

                ?> 
                </select>
              </div>
              <div class="row">
                <label class="col-4">Alunos sem turma este ano</label>
                <div class="col-8 p-2">
                  <?php 
                    $arr_stdnt_out_class = array();
                    $query_students = "select id, name, last_name, img_profile from user where type = 0 and status = 1 order by name, last_name";
                    $stmt_students = $conn->query($query_students);
                    $row_students = $stmt_students->fetchAll(PDO::FETCH_ASSOC);
                    $year = date('Y');
                    foreach ($row_students as $key => $value) {
                      $query_CS = "select count(*) as 'count' from class_student where id_student = " . $value['id'] . " and year = " . $year;
                      $stmt_CS = $conn->query($query_CS);
                      $row_CS = $stmt_CS->fetch(PDO::FETCH_ASSOC);
                      
                      if(!$row_CS['count']){
                        array_push($arr_stdnt_out_class, $value['id']);
                      }
                    }
                    $res = "<div class='row'>";
                    foreach ($row_students as $key => $value) {
                      if(in_array($value['id'], $arr_stdnt_out_class)){
                        $res .= "<div class='col-6'><label for='student-{$value['id']}'>" . $value['name'] . " " . $value['last_name'] . "</label> <input type='radio' value='{$value['id']}' id='student-{$value['id']}' name='id_student'></div>";
                      }
                    }
                    $res .= "</div>";
                    ?>
                  <?=$res?>                      
                </div>
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
<script type="text/javascript" src="<?=$configBase?>/../js/cad_turma.js"></script>
