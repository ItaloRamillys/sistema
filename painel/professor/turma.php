<?php 
$get = $configUrl[2];
$exp_get = explode("-", $get);
$turma = $exp_get[0];
$disc = $exp_get[1];
$ano = $exp_get[2];

$erro = 0;
$msg = "";

//CAPTURANDO ID DA DISCIPLINA
$query_id_disc = "select id_disc from disciplina where nome_disc = '" . $disc . "'";

$stmt_id_disc = $conexao->query($query_id_disc);

$row_id_disc = $stmt_id_disc->fetch(PDO::FETCH_ASSOC);

$id_disc = $row_id_disc['id_disc'];

if(empty($id_disc)){
    $msg .= " A disciplina informada não está cadastrada em nosso sistema.";
    $erro++;
}

//CAPTURANDO ID DA TURMA
$query_id_turma = "select id_turma from turma where nome_turma = '" . $turma . "'";

$stmt_id_turma = $conexao->query($query_id_turma);

$row_id_turma = $stmt_id_turma->fetch(PDO::FETCH_ASSOC);

$id_turma = $row_id_turma['id_turma'];

if(empty($id_turma)){
    $msg .= " A turma informada não está cadastrada em nosso sistema.";
    $erro++;
}

//VERIFICANDO SE O PROFESSOR REALMENTE DÁ A AULA
$query_verify = "select * from disc_turma where id_turma = {$id_turma} and id_prof = {$id_user_menu} and ano = {$ano} and id_disc = {$id_disc}";

$stmt_verify = $conexao->query($query_verify);

$row_verify = $stmt_verify->fetch(PDO::FETCH_ASSOC);

if(!$row_verify || $erro){
    echo "<script>alert({$msg});</script>";
    header("Location: {$configBase}/erro_permissao");
}

$query_turma = "select u.img_profile, u.nome, u.sobrenome, u.genero, x.* from usuario u inner join (select id_aluno, id_TA from turma_aluno where id_turma = {$id_turma} and ano = {$ano}) x on u.id = x.id_aluno
";

$stmt_turma = $conexao->query($query_turma);

?>
<div class="container">
  <div class="box">
    <div class="div-title-box">
        <span class="title-box-main  d-flex justify-content-center">Turma: <?=$turma?></span>
    </div>   
        <div class="container">
            <div class="row my-3">
                <div class="col-md-8 col-12">
                    <div class="div-title-box">
                        <span class="title-box-main d-flex justify-content-center">Controle do professor</span>
                    </div>
                     - Cadastrar atividade<br>
                     - Enviar alerta<br>
                     - Frequência<br>
                     - Notas<br>
                </div>

                <div class="col-md-4 col-12" id="box-students-class">
                    <div class="div-title-box">
                        <span class="title-box-main  d-flex justify-content-center">Alunos</span>
                    </div> 
                    <div class="row p-3">
                        <?php 
                            while ($row_user = $stmt_turma->fetch(PDO::FETCH_ASSOC)){   

                                if($row_user['img_profile'] != ""){
                                    $img_profile = $row_user['img_profile'];
                                }else{
                                    if(lcfirst($row_user['genero']) == 'f'){
                                        $img_profile = "padrao/female.png";    
                                    }elseif(lcfirst($row_user['genero']) == 'm'){
                                        $img_profile = "padrao/male.png";
                                    }else{
                                        $img_profile = "padrao/male.png";
                                    }
                                }

                                $print = "<div class='col-md-3 my-1'>";

                                $print .= "<img src = '{$configBase}/../img/" . $img_profile . "' class='img-fluid rounded-circle img-student'><small class='d-flex justify-content-center text-center my-1'>" . $row_user['nome'] . "</small>";

                                $print .= "</div>";

                                echo $print;
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

