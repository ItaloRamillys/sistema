
<div class="container">
  <div class="box">
    <header class="div-title-box">
      <h2 class="title-box-main">Disciplinas cadastradas</h2>
    </header>
    <div class="container">
      
    <?php
      require_once('C:\xampp\htdocs\sistema\proj_esc_func\conexao.php');

      $conexao = new Conexao();

      $conexao = $conexao->conectar();

      $query = "select nome_disc, id_disc, cod_disc from disciplina order by nome_disc asc";
      
      $final = "<table id='tabela-scroll' class='table table-hover'><thead><tr><th>Disciplina</th><th class='text-center'>Alunos</th><th class='text-center'>Código</th><th class='text-center'>Visualizar</th></tr></thead><tbody>";

      foreach ($conexao->query($query) as $dados) {

        $query2 = "select count(*) as qtde, u.* from turma_aluno ta inner join( select t.id_turma, y.id_disc from turma t INNER JOIN (select distinct(dt.id_turma), x.id_disc from disc_turma dt inner join (select d.id_disc from disciplina d where d.nome_disc = '".$dados['nome_disc']."')x on dt.id_disc = x.id_disc group by dt.id_turma) y on y.id_turma = t.id_turma )u on ta.id_turma = u.id_turma group by u.id_turma, u.id_disc";

          $qtde_alunos = 0;

          foreach ($conexao->query($query2) as $dados2) {
            $qtde_alunos = $qtde_alunos + $dados2['qtde'];
          }

          if(!empty($dados)){
            $final .= "<tr><td>" . $dados['nome_disc'] . "</td><td class='text-center'> ".$qtde_alunos." </td><td class='text-center'> ".$dados['cod_disc']." </td><td class='text-center'><i class='fas fa-eye view-disc'></i></td></tr>";
          }

      }



      $final .= "</tbody></table>";

      echo $final;

    ?>
    </div>
  </div>
</div>

<script src='../js/ver_disc.js'></script>
<script src='../js/cad_disc.js'></script>

