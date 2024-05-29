<?php
    $page = "CZ - Minha Conta";
    session_start();

    // Verifica se o usuário está logado
    if (!isset($_SESSION['nome_usuario'])) {
        header('Location: acoes/login.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

    <?php include 'secoes/head.php'?>

<body>
    <?php include "secoes/cabecalho.php"; ?>

    <div class="conteudo">
        <div class="container">
            <div class="container_objetos centralizar_row">
                <div style="gap:5%" class="card_cliente container_objetos_2 centralizar_column">
                    <h1 style="color:white"><?php echo htmlspecialchars($_SESSION['nome_usuario']); ?></h1>
                    <div style="gap:50%" class="centralizar_row">
                        <h3>Imóveis:</h3>
                        <h3>Avaliação:</h3>
                        
                    </div>
                    
                    <form action="acoes/sair.php">
                        <button style="width:100%" class="botao_primario">Sair</button>
                    </form>
                </div>
                <div style="gap:2%" class="container_objetos_2 centralizar_column">
                    <a href="cadastro_imovel.php" class="card_funcionalidade centralizar_column" style="background-color:#a3a375">
                        <h2 style="color:white">Cadastrar Imóvel</h2>

                    </a>
                    <a href="alugar.php" class="card_funcionalidade centralizar_column" style="background-color:#dedec1">
                        <h2>Alugar Imóvel</h2>

                    </a>
                </div>
                
            </div>               
        </div>
    </div>

    <?php include "secoes/rodape.php"; ?>
</body>
</html>
