<?php
    $page = "CZ - Imóveis";
    include 'acoes/conexao.php';

    $sql = "SELECT * FROM imovel";
    $consulta = $conexao->query($sql);
    session_start();
?>


<!DOCTYPE html>
<html lang="pt-br">

<?php include 'secoes/head.php'?>

<body>
    <?php include "secoes/cabecalho.php"?>


    <div class="conteudo">
        <div class="container">
            <div class="container_objetos centralizar_column">
                <h1>Imóveis Disponíveis</h1><br>
                <div style="height: 70%; width: 100%;gap:1%" class="centralizar_row">
                    <?php while ($linha = $consulta->fetch(PDO::FETCH_OBJ)) { ?>
                        <a href="reserva.php?id=<?php echo $linha->id_imovel; ?>" class="a_imovel">

                            <div class="imoveis_img">
                                <img src="<?php echo 'data:image/jpeg;base64,' . base64_encode($linha->imagem); ?>" style="border-radius:1rem 1rem 0 0" alt="Imagem" width="100%" height="100%">
                            </div>

                            <div class="imoveis_info">
                                <div><?php echo $linha->localizacao ?></div>
                                <div class="imoveis_info2">
                                    <div>H: <?php echo $linha->num_hospedes ?></div>
                                    <div>Q: <?php echo $linha->num_quartos ?></div>
                                    <div style="color:#6FFF40">R$<?php echo $linha->preco ?></div>

                                </div>
                            </div>
                        </a>
                    <?php
                        }
                    ?>
                </div>


            </div>
        </div>
    </div>
       
    <?php include "secoes/rodape.php"?>

</body>
</html>
