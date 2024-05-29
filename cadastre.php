<?php
    $page = "Cadastre-se";
    include 'acoes/conexao.php';
?>


<!DOCTYPE html>
<html lang="pt-br">

<?php include 'secoes/head.php'?>

<body>
    <?php include "secoes/cabecalho.php"?>

    <div class="conteudo">

        <div class="container" style="background: linear-gradient(to bottom, #dedec1, #a3a375);">
            <div class="container_objetos centralizar_column">


                    
                    <div class="centralizar_column" style="width:50%;height:80%;background-color:white">
                        
                        <div class="centralizar_column" style="text-align:center">
                        <h2>Cadastre-se conosco!</h2>
                            <form action="acoes/cadastro.php" method="post" style="display: flex; flex-direction: column;">
                                <label for="login">Nome:</label>
                                <input class="input_form" type="text" id="login" name="nome">

                                <label for="login">Email:</label>
                                <input class="input_form" type="text" id="login" name="email">

                                <label for="senha">Senha:</label>
                                <input class="input_form" type="password" id="senha" name="senha"><br>
                                
                                <div>
                                    <label for="id_perfil">Desejo iniciar como: </label>
                                    <input  type="radio" id="id_perfil" name="id_perfil" value="3">Hóspede
                                    <input  type="radio" id="id_perfil" name="id_perfil" value="2">Proprietário<br><br><br>
                                </div>
                                


                                <input class="botao_secundario" type="submit" value="Cadastrar">
                            </form><br>
                                <a href="pag_login.php">Já possuo uma conta</a>
                        </div>
                    
                    </div>
                    


            </div>
        </div>
        
    </div>

    <?php include "secoes/rodape.php"?>

</body>
</html>