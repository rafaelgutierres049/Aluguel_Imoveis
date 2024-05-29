<?php
$page = "Cadastre seu Imóvel";
session_start();
?>

<?php if (isset($_SESSION['nome_usuario'])): ?>

    <!DOCTYPE html>
    <html lang="pt-br">

    <?php include 'secoes/head.php'?>

    <body>
        <?php include "secoes/cabecalho.php"?>

        <div class="conteudo">
            <div class="container" style="background: linear-gradient(to bottom, #dedec1, #a3a375);">
                <div class="container_objetos">




                    <div class="centralizar_row">
                        <div class="div_cadastro centralizar_row">
                            <form style="font-weight:600" action="acoes/inserir.php" method="post" enctype="multipart/form-data">
                                Título:<br><input class="input_form" type="text" name="titulo"><br>
                                Localização:<br> <input class="input_form"type="text" name="localizacao"><br>
                                Valor:<br> <input class="input_form" type="number" name="preco"><br>
                                Quartos:<br> <input class="input_form" type="number" name="num_quartos"><br>
                                Hóspedes:<br> <input class="input_form" type="number" name="num_hospedes"><br>
                                Descrição:<br> <textarea class="input_form" name="descricao" rows="4" cols="50"></textarea><br>
                                Imagem:<br> <input style="background-color:#dedec1; color:black; padding:0.5rem" type="file" name="imagem" required><br>
                                <br>
                                <input class="botao_secundario" type="submit" value="Cadastrar">
                            </form>
                        </div>
                    </div>



                </div>
                
            </div>
        </div>
        <?php include "secoes/rodape.php" ?>
    </body>
    </html>

<?php else:include 'pag_login.php';?>
    
<?php endif; ?>