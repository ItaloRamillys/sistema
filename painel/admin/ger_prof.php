<div class="container">
<div id="msg"></div>
    <div class="row">
        <div class="col-12">
            <div class="box"> 
                <header class="div-title-box">
                    <h1 class="title-box-main  d-flex justify-content-center">Gerenciar Professores</h1>
                </header>
               
                <div class="table-data">
                    <input type="hidden" id="tipo" value="1">
                        <?php 

                $tabela = "usuario";
                $tipo = "1";

                $query = "select * from ".$tabela." where tipo = ".$tipo;
                    
                $stmt = $conexao->query($query);

                if ($stmt->rowCount() > 0) {
                    $res = "<section>";

                        $res .= "<table id='tabela-scroll' class='table table-hover'><thead><tr><th>Imagem</th><th class='text-center'>Nome completo</th><th class='text-center'>Email</th><th class='text-center'>Status</th><th class='text-center'>Ações</th></tr></thead><tbody>";
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                
                                if($row["email"] == ''){
                                  $row["email"] = "Não possui email";
                                }

                                $img = $row['img_profile'];

                                $nome = $row['nome'];
                                $sobrenome = $row['sobrenome'];
                                $email = $row['email'];
                                $cria = $row['create_at'];
                                $id_get = $row['id'];
                                $user = $row['login'];
                                $status = $row['status'];

                                $r_img = explode(".", $img);
                                $name_img = $r_img[0];
                                $new_name_img = $name_img."_100x100.".$r_img[1];

                                $id_cript_to_del = password_hash($id_get, PASSWORD_DEFAULT, array('cost' => 10));
                                $id_cript_to_up = password_hash($id_get, PASSWORD_DEFAULT, array('cost' => 5));

                                $imagem = render_img(__DIR__."/../../img/".$img, 
                                                    "{$configBase}/../img/".$img,
                                                    "{$configBase}/../img/padrao/img-profile-default.jpg",
                                                    'rounded',
                                                    80,
                                                    80
                                                    );

                                
                                $is_disable = "";
                                if(!$status){
                                    $is_disable = "<button class='btn btn-sm btn-success m-1 reactivate' id={$id_cript_to_up} email-data={$email} data-toggle='tooltip' data-placement='top' title='Reativar usuário' {$is_disable}><i class='fas fa-undo'></i></button>";
                                }else{
                                    $is_disable = "<button class='btn btn-sm btn-secondary m-1 disable-btn text-light' id={$id_cript_to_up} email-data={$email} data-toggle='tooltip' data-placement='top' title='Desativar usuário' {$is_disable}><i class='fas fa-times-circle'></i></button>";
                                }

                                $res .= "<tr><td>{$imagem}</td><td class='text-center'> ".$nome." ".$sobrenome." </td><td class='text-center'> ".$email." </td><td class='text-center'> ".$status." </td><td class='text-center'><button class='btn btn-sm btn-danger m-1 delete' id={$id_cript_to_del} email-data={$email} data-toggle='tooltip' data-placement='top' title='Deletar usuário'><i class='fas fa-trash'></i></button>{$is_disable}<a href='{$configBase}/admin/editar_conta/".$user."' class='btn btn-sm btn-primary m-1' data-toggle='tooltip' data-placement='top' title='Editar usuário'><i class='fas fa-edit'></i></a></td></tr>";

                            }

                        $res .= "</tbody></table></section> 
                        <!-- Include jQuery - see http://jquery.com -->
                        <script type='text/javascript'>
                            $('.confirmation').on('click', function () {
                                return confirm('Deseja realmente excluir?');
                            });
                        </script> ";
                        
                        echo $res;
                    } else {
                        echo "Nenhum(a) " .$tabela. "  cadastrado(a) nesta escola";
                    }
                   
                    ?>
                </div>
            </div>
        </div>
    </div>
</div> 
<script src="<?=$configBase?>/../js/delete_usu.js"></script>
<script src="http://localhost/sistema/js/reactive_user.js"></script>
<script src="http://localhost/sistema/js/disable_user.js"></script>