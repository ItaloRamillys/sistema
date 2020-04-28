<div class="container">
            <div class="row">
                <div class="col-12 p-0">
                <div class="box"> 
                        <header class="div-title-box">
                            <h1 class="title-box-main  d-flex justify-content-center">Gerenciar Aluno</h1>
                        </header>
                       
                        <div class="msg-aluno col-12 p-0">

                            <div class="container">
                            <?php 

                            $tabela = "usuario";
                            $tipo = "0";


                            $query = "select * from ".$tabela." where tipo = ".$tipo;
                               
                                
                            $stmt = $conexao->query($query);

                            if ($stmt->rowCount() > 0) {
                                $res = "<section class='row'>
                                                <div class='col-md-3 col-12 px-3 pt-4 text-center'>
                                                   
                                                        Gerenciar contas <br>

                                                        <a href='cad_.php'> <button class='btn btn-outline-success btn-sm m-md-0 my-md-1 m-2'> + Adicionar</button></a>
                                                        <a href='showData.php?ordem_alfa=1&type='> <button class='btn btn-outline-primary btn-sm m-md-0 my-md-1 m-2'>Ordem alfabética</button></a>
                                                        <a href='showData.php?ordem_cad=1&type='> <button class='btn btn-outline-dark btn-sm m-md-0 my-md-1 m-2'>Ordem de cadastro</button></a>
                                                        
                                                    </div>
                                                <div class='col-md-9 col-12 p-0 pt-4'>
                                                    <div class='container'>
                                                        <div class='row'>
                                                    
                                            ";

                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            
                                            if($row["email"] == ''){
                                              $row["email"] = "Não possui email";
                                            }

                                            if($row['img_profile'] == ''){
                                                $img = "img-profile-default.jpg";
                                            }else{
                                                $img = $row['img_profile'];
                                            }

                                            $nome = $row['nome'];
                                            $sobrenome = $row['sobrenome'];
                                            $email = $row['email'];
                                            $cria = $row['create_at'];
                                            $id_get = $row['id'];

                                            if(!is_file($configThemePath."/../img/".$img)){
                                                $img = "/usuario/img-profile-default.jpg";
                                            }

                                            $res .= "
                                            <div class='container-box'>
                                                <div class='box-dados-usu'>
                                                    <div class='box-img-usu'>
                                                        <img class='img-fluid' src='{$configBase}/../img/{$img}'>
                                                    </div>
                                                    <p class='box-nome-usu'>
                                                        {$nome} {$sobrenome}
                                                    </p>

                                                    
                                                        <p class='box-email-usu'>
                                                            {$email}
                                                        </p>
                                                        <p class='box-cria-usu'>
                                                            Cadastrado em: {$cria}
                                                        </p>
                                                    
                                                    <div class='box-btn-usu'>
                                                        <button class='btn btn-primary btn-sm' onclick='edit({$id_get});'>Editar</button>
                                                    
                                                        <button class='confirmation btn btn-danger btn-sm'  onclick='delete({$id_get});'>Excluir</button> 
                                                    </div>
                                                </div>
                                            </div>
                                                      ";
                                        }

                                    $res .= "</div> </div> </div> </section> 
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
            </div>