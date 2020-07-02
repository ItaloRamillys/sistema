<?php 
$get = $configUrl[2];
$exp_get = explode("-", $get);
$turma = $exp_get[0];
$disc = $exp_get[1];
$ano = $exp_get[2];

$row_id_disc = 0;
$row_id_turma = 0;
$row_verify = 0;
$erro = 0;
$msg = "Erros:";

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

if(!empty($id_turma) && !empty($id_disc)){
    //VERIFICANDO SE O PROFESSOR REALMENTE DÁ A AULA
    $query_verify = "select * from disc_turma where id_turma = {$id_turma} and id_prof = {$id_user_menu} and ano = {$ano} and id_disc = {$id_disc}";

    $stmt_verify = $conexao->query($query_verify);

    $row_verify = $stmt_verify->fetch(PDO::FETCH_ASSOC);
}else{
    echo    "<script>
                alert('{$msg}'); 
                window.location.href = '{$configBase}/erro_permissao';
            </script>";
}

$query_turma = "select u.img_profile, u.nome, u.sobrenome, u.genero, x.* from usuario u inner join (select id_aluno, id_TA from turma_aluno where id_turma = {$id_turma} and ano = {$ano}) x on u.id = x.id_aluno
";

$stmt_turma = $conexao->query($query_turma);

?>
<div class="container">
  <div class="box">
    <div class="div-title-box">
        <span class="title-box-main  d-flex justify-content-center">Turma: <?=$turma?> - <?=$disc?></span>
    </div>   
        <div class="container">
            <div class="row my-3">
                <div class="col-md-8 col-12">
                    <div class="div-title-box">
                        <span class="title-box-main d-flex justify-content-center">Controle do professor</span>
                    </div>
                    <div class="divisao-cad">
                        <div id="msg-atividade"></div>
                        <article>
                            <h1 class="title-box-main d-flex justify-content-center">Cadastrar atividade</h1>
                            <form id="form-atividade" enctype="multipart/form-data">
                                <input type="hidden" name="id_DT" value="<?=$row_verify['id_DT']?>">
                                <label>Título da atividade</label>
                                <input type="text" name="titulo-atividade" placeholder="Digite um título" maxlength="50">
                                <label>Descrição da atividade</label>
                                <textarea name="descricao-atividade">
                                </textarea>
                                <label>Referências</label>
                                <input type="text" name="referencia-atividade" placeholder="Digite as referência caso possua">
                                <label for="file-upload" class="custom-file-upload">
                                  Arquivo
                                </label>
                                <input id="file-upload" name="arquivo-atividade" type="file" style="display:none;">
                                <img src="http://localhost/sistema/img/padrao/pdf.png"  id="img-pdf" width="200" height="200">
                                <label id="file-name">Nome do arquivo</label>
                                <br>
                                <input type="submit" class="btn btn-primary btn-sm my-2" value="Enviar">
                            </form>
                        </article>
                    </div>

                    <div class="divisao-cad">
                        <div id="msg-mensagem-turma"></div>
                        <article>
                            <h1 class="title-box-main d-flex justify-content-center">Cadastrar mensagem</h1>
                            <form id="form-mensagem">
                                <input type="hidden" name="id_DT" value="<?=$row_verify['id_DT']?>">
                                <label>Título da mensagem</label>
                                <input type="text" name="titulo" placeholder="Digite um título">
                                <label>Descrição da mensagem</label>
                                <textarea name="mensagem">
                                </textarea>
                                <input type="submit" class="btn btn-primary btn-sm my-2" value="Enviar">
                            </form>
                        </article>
                    </div>
                </div>

                <div class="col-md-4 col-12" id="box-students-class">
                    <div class="div-title-box">
                        <h1 class="title-box-main  d-flex justify-content-center">Alunos</h1>
                    </div> 
                    <div class="row p-3">
                        <?php 
                            while ($row_user = $stmt_turma->fetch(PDO::FETCH_ASSOC)){   

                                if($row_user['img_profile'] != "" && file_exists(__DIR__."/../../img/".$row_user['img_profile'])){
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

                                $print .= "<img src = '{$configBase}/../img/" . $img_profile . "' class='img-fluid rounded-circle img-student' style='width: 50px; height: 50px; background: #fff;'><small class='d-flex justify-content-center text-center my-1'>" . $row_user['nome'] . "</small>";

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
<script>
$(function(){
    $('#file-upload').change(function(){
        const file = $(this)[0].files[0]
        const fileReader = new FileReader()
        fileReader.onloadend = function(){
            $('#file-upload').attr('src', fileReader.result)
        }
        fileReader.readAsDataURL(file)
        $('#file-name').text(file['name'])
    })
})
</script>
<script src="<?=$configBase?>/../js/cad_atividade.js"></script>
<script src="<?=$configBase?>/../js/cad_mensagem_turma.js"></script>

