<div class='container-box login' id='login' style='display: none'>
    <div class='box-login' id='box'>
        <div class='box-login-transparent'>
                <div id="inner"></div>
            <div class='row p-2'> 
                <div style='cursor: pointer; font-size: 1.5em; color: red; margin-left: auto;'  id='close-login'>
                    <i class='fa fa-close'></i> 
                </div>
            </div>
            <form method='POST' action='validate.php'>
                <div class='inputBox'>
                    <input type='text' name='user' id="user" required='' autocomplete='disabled' data-type="modal-login">
                    <label data-type="modal-login">Login</label>
                </div>
                <div class='inputBox'>
                    <input type='password' name='pass' id="pass" required='' data-type="modal-login">
                    <label data-type="modal-login">Senha</label>
                </div>
                    <?php
                        if(isset($_GET['login']) && $_GET['login'] == 'erro'){
                            
                            echo "<div class='error-message'>Usuário ou senha inválido(s)</div>";

                            ?> 
                        <?php

                        }else if(isset($_GET['login']) && $_GET['login'] == 'erro2') {
                            echo "<div class='error-message'>Por favor realize o login no sistema</div>";
                        }
                    ?>
                <div class='inputBox my-2' data-type="modal-login">
                    <a href="" class="text-danger" id="forgot-pass" data-type="modal-login">Esqueci minha senha</a>
                </div>
                <input type='submit' class='btn btn-primary btn-sm' name='' value='Entrar' data-type="modal-login">
            </form>
        </div>
    </div>
</div>

