<div class="container">
  <div class="box">
    <header class="div-title-box">
      <h2 class="title-box-main">Disciplinas cadastradas</h2>
    </header>
    <div class="container">
    <?php
      require_once('C:\xampp\htdocs\sistema\proj_esc_func\connection.php');
      $conn = new Connection();
      $conn = $conn->connect();

      $query = "select name_subject, id_subject, code_subject from subject order by name_subject asc";
      
      $final = "<table id='tabela-scroll' class='table table-hover'><thead><tr><th>Disciplina</th><th class='text-center'>Alunos cursando este ano</th><th class='text-center'>Código</th><th class='text-center'>Ações</th></tr></thead><tbody>";
      $ano = date("Y");

      foreach ($conn->query($query) as $dados) {

        $query2 = "select count(*) as qtde, u.* from class_student cs inner join( select c.id_class, y.id_subject from class c INNER JOIN (select distinct(sc.id_class), x.id_subject from subject_class_lesson sc inner join (select s.id_subject from subject s where s.id_subject = ".$dados['id_subject'].")x on sc.id_subject = x.id_subject and sc.year = {$ano} group by sc.id_class) y on y.id_class = c.id_class )u on cs.id_class = u.id_class group by u.id_class, u.id_subject";

          $qtde_alunos = 0;

          foreach ($conn->query($query2) as $dados2) {
            $qtde_alunos = $qtde_alunos + $dados2['qtde'];
          }

          if(!empty($dados)){
            $final .= "<tr><td>" . $dados['name_subject'] . "</td><td class='text-center'> ".$qtde_alunos." </td><td class='text-center'> ".$dados['code_subject']." </td><td class='text-center'><button class='btn btn-sm m-1 btn-error delete' data-toggle='tooltip' data-placement='top' title='Deletar usuário'><i class='fas fa-trash'></i></button><a href='{$configBase}/admin/editar_disciplina/".$dados['code_subject']."' class='btn btn-sm m-1 btn-warn' data-toggle='tooltip' data-placement='top' title='Editar usuário'><i class='fas fa-edit'></i></a></td></tr>";
          }
      }
      $final .= "</tbody></table>";
      echo $final;    ?>
    </div>
  </div>
</div>
<script src='../js/ver_disc.js'></script>
<script src='../js/cad_disc.js'></script>

