<?php
    session_start();

    if (!isset($_SESSION['nome_usuario'])) {
        header('Location: acoes/login.php');
        exit();
    }

    $page = "CZ - Minha Conta";
    $id_usuario = $_SESSION['id_usuario'];

    include 'acoes/conexao.php';

    $sql_reservas = "
        SELECT reserva.id_reserva, reserva.data_checkin, reserva.data_checkout, reserva.num_hospedes, imovel.titulo, imovel.localizacao
        FROM reserva
        JOIN imovel ON reserva.id_imovel = imovel.id_imovel
        WHERE reserva.id_usuario = :id_usuario
    ";
    $consulta_reservas = $conexao->prepare($sql_reservas);
    $consulta_reservas->execute([':id_usuario' => $id_usuario]);

    $sql_imoveis = "
        SELECT imovel.*, COUNT(reserva.id_reserva) AS total_reservas
        FROM imovel
        LEFT JOIN reserva ON imovel.id_imovel = reserva.id_imovel
        WHERE imovel.id_usuario = :id_usuario
        GROUP BY imovel.id_imovel
    ";
    $consulta_imoveis = $conexao->prepare($sql_imoveis);
    $consulta_imoveis->execute([':id_usuario' => $id_usuario]);

    $quantidade_imoveis = $consulta_imoveis->rowCount();

    $quantidade_reservas = $consulta_reservas->rowCount();
?>

<!DOCTYPE html>
<html lang="pt-br">

<?php include 'secoes/head.php'?>
<style>
    .item_cliente {
        width: 15vw;
        height: 25vh;
        position: relative;
        border: 1px solid black;
        border-radius: 2dvh;
        overflow: hidden; 
        transition: transform 0.3s ease;
    }

    .item_cliente img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 2dvh;
    }

    .details {
        position: absolute;
        height:25vh;
        bottom: 0;
        left: 0;
        right: 0;
        top:0; 
        background-color: rgba(0, 0, 0, 0.7);
        padding: 10px;
        box-sizing: border-box;
        color: white;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .item_cliente:hover{
        transform: scale(1.05);
    }
    .item_cliente:hover .details {
        opacity: 1;
    }
    .submit{
        background-color:#a3a375; color:white;border-radius:1rem;border:0;font-weight:600;padding:1dvh;cursor:pointer;
        transition: transform 0.3s ease;
    }
    .submit:hover{
        transform:scale(1.05);
    }
    .item_reserva_cliente{
        background-color:white;border:5px solid #dedec1;border-radius:2dvh;width:60%;transition:transform 0.3s ease
    }
    .item_reserva_cliente:hover{
        transform:scale(1.05);
        background:#dedec1;
    }
</style>

<body>
    <?php include "secoes/cabecalho.php"; ?>

    <div class="conteudo">
        <div class="container">
            <div class="container_objetos centralizar_row">
                <div style="gap:5%" class="card_cliente container_objetos_2 centralizar_column ">
                    <h1 style="color:white"><?php echo htmlspecialchars($_SESSION['nome_usuario']); ?></h1>
                    
                    <div class="centralizar_column" style="color:white;font-weight:600">
                        <p>Imóveis Cadastrados: <?php echo $quantidade_imoveis; ?></p>
                        <p>Reservas feitas em seus imóveis: <?php echo $quantidade_reservas; ?></p>
                    </div>
                    <form style="width:50%" action="acoes/sair.php">
                        <button style="width:100%;background-color:white" class="botao_primario">Sair</button>
                    </form>
                </div>
                <div style="gap:2%" class="container_objetos_2 centralizar_column fadeIn">
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
            <h1>Suas Reservas</h1>
                <div style="gap:2dvh;width:100%" class="centralizar_column slideIn">
                    <?php while ($linha = $consulta_reservas->fetch(PDO::FETCH_OBJ)) { ?>
                        <div class="centralizar_row item_reserva_cliente" >
                            <div style="width:33%;text-align:center">
                                <h3>
                                    <?php echo htmlspecialchars($linha->titulo); ?>
                                </h3>
                            </div>
                            
                            <div class="centralizar_row" style="gap:4dvw;width:100%">
                                <h4><?php echo htmlspecialchars($linha->localizacao); ?></h4>
                                <h4><?php echo (new DateTime($linha->data_checkin))->format('d/m/Y'); ?> - <?php echo (new DateTime($linha->data_checkout))->format('d/m/Y'); ?></h4>                                
                            </div>
                            <div style="width:33%">
                                <form action="acoes/exclui_reserva.php" method="post">
                                    <input type="hidden" name="id_reserva" value="<?php echo htmlspecialchars($linha->id_reserva); ?>">
                                    <input class="submit" style="background-color:red" type="submit" value="Cancelar Reserva">
                                </form>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="container" style="background-color:#dedec1">
            <h1>Seus Imóveis</h1>
            <div style="gap:2dvw" class="centralizar_row slideIn">
                <?php while ($imovel = $consulta_imoveis->fetch(PDO::FETCH_OBJ)) { ?>
                    <div class="item_cliente">
                        <img src="<?php echo 'data:image/jpeg;base64,' . base64_encode($imovel->imagem); ?>" alt="Imagem do Imóvel">
                        <div class="details">
                            <div style="height:60%">
                                <h4><?php echo $imovel->titulo; ?></h4>
                                
                            </div>
                            <div class="centralizar_row" style="height:40%;gap:1dvw">
                                <form action="acoes/exclui_imovel.php" method="post">
                                    <input type="hidden" name="id_imovel" value="<?php echo htmlspecialchars($imovel->id_imovel); ?>">
                                    <input class="submit" type="submit" value="Excluir">
                                </form>
                                <p style="color:white;font-weight:600"><?php echo "Reservas: " . $imovel->total_reservas; ?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        
    </div>

    <?php include "secoes/rodape.php"; ?>
</body>
</html>
