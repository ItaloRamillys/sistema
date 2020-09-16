<?php 
$get = $configUrl[2];
$exp_get = explode("-", $get);
$turma = $exp_get[0];
$disc = sanitize_url_data($exp_get[1]);
$ano = sanitize_url_data($exp_get[2]);

$row_id_subject = 0;
$row_id_class = 0;
$row_verify = 0;
$erro = 0;
$msg = "Erros:";

//CAPTURANDO ID DA DISCIPLINA
$query_id_subject = "select id_subject from subject where name_subject = '" . $disc . "'";
$stmt_id_subject = $conn->query($query_id_subject);
$row_id_subject = $stmt_id_subject->fetch(PDO::FETCH_ASSOC);
$id_subject = $row_id_subject['id_subject'];
if(empty($id_subject)){
    $msg .= " A disciplina informada não está cadastrada em nosso sistema.";
    $erro++;
}

//CAPTURANDO ID DA TURMA
$query_id_class = "select id_class from class where name_class = '" . $turma . "'";
$stmt_id_class = $conn->query($query_id_class);
$row_id_class = $stmt_id_class->fetch(PDO::FETCH_ASSOC);
$id_class = $row_id_class['id_class'];

if($row_id_class && $row_id_subject){
	 $query_verify = "select * from subject_class_lesson where id_class = {$id_class} and id_subject = {$id_subject} and id_teacher = {$id_user_menu} and year = {$ano}";
    $stmt_verify = $conn->query($query_verify);
    $row_verify = $stmt_verify->fetch(PDO::FETCH_ASSOC);
    if(!$row_verify){
        header("Location: http://localhost/sistema/painel/erro_permissao");
    }
}else{
    $msg .= " A turma ou disciplina informada não está cadastrada em nosso sistema.";
    $erro++;
}

$query_turma = "select u.img_profile, u.name, u.last_name, u.genre, x.* from user u inner join (select id_student, id_CS from class_student where id_class = {$id_class} and year = {$ano}) x on u.id = x.id_student";
$stmt_turma = $conn->query($query_turma);
?>
<div class="container">
    <div class="row">
        <div class="col-12">
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
                                            <input type="hidden" name="id_SC" value="<?=$row_verify['id_sc']?>">
                                            <label>Título da atividade</label>
                                            <input type="text" name="title-activity" placeholder="Digite um título" maxlength="50">
                                            <label>Descrição da atividade</label>
                                            <textarea name="desc-activity">
                                            </textarea>
                                            <label>Data de entrega</label>
                                            <input type="date" name="deadline-activity" min="<?=date('Y-m-d')?>">
                                            <label>Referências</label>
                                            <input type="text" name="references-activity" placeholder="Digite as referência caso possua">
                                            <label for="file-upload" class="btn btn-sm btn-primary">
                                              Arquivo
                                            </label>
                                            <input id="file-upload" name="file-activity" type="file" style="display:none;">
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
                                            <input type="hidden" name="id_DT" value="<?=$row_verify['id_sc']?>">
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
                                                if(lcfirst($row_user['genre']) == 'f'){
                                                    $img_profile = "padrao/female.png";    
                                                }elseif(lcfirst($row_user['genre']) == 'm'){
                                                    $img_profile = "padrao/male.png";
                                                }else{
                                                    $img_profile = "padrao/male.png";
                                                }
                                            }

                                            $print = "<div class='col-md-3 my-1'>";

                                            $print .= "<img src = '{$configBase}/../img/" . $img_profile . "' class='img-fluid rounded-circle img-student' style='width: 50px; height: 50px; background: #fff;'><small class='d-flex justify-content-center text-center my-1'>" . $row_user['name'] . "</small>";

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
