<?php
    $page = "CZ - Login"
?>


<!DOCTYPE html>
<html lang="pt-br">

<?php include 'secoes/head.php'?>

<body>
    <?php include "secoes/cabecalho.php"?>

        <div class="conteudo">
            <div class="container" style="background: linear-gradient(to bottom, #dedec1, #a3a375);">
                <div class="container_objetos centralizar_column">

                        <div class="centralizar_row" style="height: 100%; width:100%">
                            <div class="container_objetos_2" style="width:60%;height:70%;background-color:white">
                                <div class="background_image_cover"style="width:60%;background-image:url('images/condominio.jpg')">

                                </div>
                                <div class="centralizar_column" style="width:40%;text-align:center">
                                    <form action="acoes/login.php" method="post" style="display: flex; flex-direction: column;">
                                        <label for="login">Login:</label>
                                        <input class="input_form" type="text" id="login" name="email">

                                        <label for="senha">Senha:</label>
                                        <input class="input_form" type="password" id="senha" name="senha"><br>

                                        <input class="botao_secundario" type="submit" value="Entrar">
                                    </form><br>
                                        <a href="alterar_senha.php">Esqueci minha senha</a><br>
                                        <a href="cadastre.php">Cadastre-se</a>
                                </div>
                        
                            </div>
                        
                        </div>

                </div>
                    

            </div>
        </div>
    

    <?php include "secoes/rodape.php"?>

</body>
</html>