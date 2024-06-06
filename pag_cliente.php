<?php
    session_start();

    // Verifica se o usuário está logado
    if (!isset($_SESSION['nome_usuario'])) {
        header('Location: acoes/login.php');
        exit();
    }

    $page = "CZ - Minha Conta";
    $id_usuario = $_SESSION['id_usuario'];

    // Include database connection file here
    include 'acoes/conexao.php';

    // Consulta para obter as reservas do usuário
    $sql_reservas = "
        SELECT reserva.id_reserva, reserva.data_checkin, reserva.data_checkout, reserva.num_hospedes, imovel.titulo, imovel.localizacao
        FROM reserva
        JOIN imovel ON reserva.id_imovel = imovel.id_imovel
        WHERE reserva.id_usuario = :id_usuario
    ";
    $consulta_reservas = $conexao->prepare($sql_reservas);
    $consulta_reservas->execute([':id_usuario' => $id_usuario]);

    // Consulta para obter os imóveis do usuário
    $sql_imoveis = "
        SELECT *
        FROM imovel
        WHERE imovel.id_usuario = :id_usuario
    ";
    $consulta_imoveis = $conexao->prepare($sql_imoveis);
    $consulta_imoveis->execute([':id_usuario' => $id_usuario]);
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
                    
                    <form style="width:50%" action="acoes/sair.php">
                        <button style="width:100%;background-color:white" class="botao_primario">Sair</button>
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

        <div style="background-color:#a3a375" class="container">
            <h1>Reservas</h1>
            <div class="container_objetos">
                <div style="width:70%;gap:2%" class="centralizar_column">
                    <?php while ($linha = $consulta_reservas->fetch(PDO::FETCH_OBJ)) { ?>
                        <div class="centralizar_column card_funcionalidade"  style="width:100%;height:20%;background-color:white;border:3px solid #a3a375;padding:1dvh">
                            <h3 style="background-color:#a3a375;width:100%;border-radius:2dvh;text-align:center">
                                <?php echo htmlspecialchars($linha->titulo); ?>
                            </h3>
                            <div style="width:100%;gap:5%;" class="centralizar_row">
                                <h4><?php echo htmlspecialchars($linha->localizacao); ?></h4>
                                <h4>Hóspedes: <?php echo htmlspecialchars($linha->num_hospedes); ?></h4>
                                <h4><?php echo (new DateTime($linha->data_checkin))->format('d/m/Y'); ?> - <?php echo (new DateTime($linha->data_checkout))->format('d/m/Y'); ?></h4>                                
                                <form action="acoes/exclui_reserva.php" method="post">
                                    <input type="hidden" name="id_reserva" value="<?php echo htmlspecialchars($linha->id_reserva); ?>">
                                    <input style="background-color:white;border:1px solid black;font-weight:600;padding:1dvh;border-radius:2dvh" type="submit" value="Cancelar Reserva">
                                </form>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div style="background-color:#dedec1;padding-bottom:2dvh" class="container">
            <h1>Seus Imóveis</h1>
            <div class="container_objetos">
                <div class="centralizar_column" style="gap:2%;height:100%;width:100%;background-color:white;border-radius:2dvh">
                    <?php while ($imovel = $consulta_imoveis->fetch(PDO::FETCH_OBJ)) { ?>
                        <div style="height:25%;width:40%;background-color:#a3a375;border:2px solid black" class="centralizar_row card_funcionalidade">
                            <div class="container_objetos_2">
                                <img src="<?php echo 'data:image/jpeg;base64,' . base64_encode($imovel->imagem); ?>" style="border-radius:2.5dvh 0 0 2.5dvh"alt="Imagem" width="75%" height="100%">
                            </div>
                            <div class="container_objetos_2 centralizar_column">
                                <h3><?php echo $imovel->localizacao?></h3>

                                <form action="acoes/exclui_imovel.php" method="post">
                                    <input type="hidden" name="id_imovel" value="<?php echo htmlspecialchars($imovel->id_imovel); ?>">
                                    <input style="background-color:white;border:1px solid black;font-weight:600;padding:1dvh;border-radius:2dvh" type="submit" value="Excluir">
                                </form>
                            </div>
                        </div>
                    <?php }?>
                </div>
            </div>
        </div>
        
    </div>

    <?php include "secoes/rodape.php"; ?>
</body>
</html>
