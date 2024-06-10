<?php
    $page = "Alterar Senha"
?>


<!DOCTYPE html>
<html lang="pt-br">

<?php include 'secoes/head.php'?>

<body>
    <?php include "secoes/cabecalho.php"?>

        <div class="conteudo">
            <div class="container fadeIn" style="background: linear-gradient(to bottom, #dedec1, #a3a375);">
                <div class="container_objetos centralizar_column">

                        <div class="centralizar_row" style="height: 100%; width:100%">
                                <div class="centralizar_column" style="text-align:center;background-color:white;padding:10vh">
                                    <form class="centralizar_column" style="width:100%" action="acoes/altera_senha.php" method="post" style="display: flex; flex-direction: column;">
                                        <label for="login">Email:</label>
                                        <input class="input_form" type="text" id="email" name="email">

                                        <label for="senha">Nova Senha:</label>
                                        <input class="input_form" type="password" id="senha" name="senha">

                                        <label for="senha">Digite novamente sua nova senha:</label>
                                        <input class="input_form" type="password" id="senha" name="senha"><br>

                                        <input class="botao_secundario" type="submit" value="Alterar">
                                    </form><br>
                                </div>                        
                        </div>

                </div>
                    

            </div>
        </div>
    

    <?php include "secoes/rodape.php"?>

</body>
</html>