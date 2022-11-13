<?php 
$get = $configUrl[2];

$query_verify = "select * from subject_class_lesson s inner join (select * from activity where id_activity = {$get})x on x.id_SC_activity = s.id_sc and s.id_teacher = {$id_user_menu}";

$stmt_verify = $conn->query($query_verify);
$row_verify = $stmt_verify->fetch(PDO::FETCH_ASSOC);

if(!$row_verify){
    $msg = "Você não tem acesso a essa atividade";
    echo "<script> alert('{$msg}'); window.location.href = '{$configBase}/erro_permissao'; </script>";
}

$query = "select * from activity where id_activity = {$get}";
$stmt = $conn->query($query);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$has_file = $row['file_activity'];
?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="div-title-box">
                    <span class="title-box-main  d-flex justify-content-center">Controle de atividade</span>
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
                                    <h1 class="title-box-main d-flex justify-content-center">Editar atividade</h1>
                                    <form id="form-atividade" enctype="multipart/form-data">
                                        <input type="hidden" name="id_SC" value="<?=$row['id_SC_activity']?>">
                                        <input type="hidden" name="id_activity" value="<?=$get?>">
                                        <label>Título da atividade</label>
                                        <input type="text" name="title-activity" placeholder="Digite um título" maxlength="50" value="<?=$row['title_activity']?>">
                                        <label>Descrição da atividade</label>
                                        <textarea name="desc-activity"><?=$row['desc_activity']?></textarea>
                                        <label>Referências</label>
                                        <input type="text" name="references-activity" placeholder="Digite as referência caso possua" value="<?=$row['references_activity']?>">
                                        <?php
                                        if($has_file){
                                        ?>
                                        <div class="row justify-content-center my-2">
                                            <a href="<?=$configBase."/../uploads/".$has_file?>" target="_blank" class="btn btn-sm btn-success">Arquivo cadastrado</a>
                                        </div>
                                        <?php    
                                        }
                                        ?>
                                        <label for="file-upload" class="btn btn-sm btn-primary">
                                          Enviar novo arquivo
                                        </label>
                                        <input id="file-upload" name="file-activity" type="file" style="display:none;">
                                        <img src="http://localhost/sistema/img/padrao/pdf.png"  id="img-pdf" width="200" height="200">
                                        <label id="file-name">Nome do arquivo</label>
                                        <br>
                                        <input type="submit" class="btn btn-primary btn-sm my-2" id="btn-atividade" value="Enviar">
                                    </form>
                                </article>
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
<script src="<?=$configBase?>/../js/edit_activity.js"></script>
