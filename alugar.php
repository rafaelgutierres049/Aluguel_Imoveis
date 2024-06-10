<?php
    $page = "CZ - Imóveis";
    include 'acoes/conexao.php';

    $sql = "SELECT * FROM imovel ORDER BY RAND()";
    $consulta = $conexao->query($sql);
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<?php include 'secoes/head.php'?>

<body>
    <?php include "secoes/cabecalho.php"?>

    <div class="conteudo centralizar_column fadeIn">
        <h1>Imóveis Disponíveis</h1><br>
        <div class="imoveis_container centralizar_row">
            <?php while ($linha = $consulta->fetch(PDO::FETCH_OBJ)) { ?>
                <a href="reserva.php?id=<?php echo $linha->id_imovel; ?>" class="imovel_card">
                    <div style="height:70%;width:100%">
                        <img src="<?php echo 'data:image/jpeg;base64,' . base64_encode($linha->imagem); ?>" alt="Imagem" width:100% height:100%>
                    </div>
                    <div class="imovel_info centralizar_column">
                        <div style="margin:5%" class="centralizar_column">
                            <div style="font-weight:600"><?php echo $linha->localizacao ?></div>
                            <div style="gap:2dvw" class="centralizar_row">
                                <div>H: <?php echo $linha->num_hospedes ?></div>
                                <div>Q: <?php echo $linha->num_quartos ?></div>
                                <div style="color:#258b03; font-weight:700">R$<?php echo $linha->preco ?></div>
                            </div>
                        </div>
                        
                    </div>
                </a>
            <?php } ?>
        </div>
    </div>
       
    <?php include "secoes/rodape.php"?>

</body>
</html>
