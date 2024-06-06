<?php
    session_start();

    include 'conexao.php';

    if (isset($_POST['id_imovel'])) {
        $id_imovel = $_POST['id_imovel'];

        // Primeiro, exclua as reservas relacionadas ao imóvel
        $sql_delete_reservas = "DELETE FROM reserva WHERE id_imovel = :id_imovel";
        $stmt_delete_reservas = $conexao->prepare($sql_delete_reservas);
        $stmt_delete_reservas->execute([':id_imovel' => $id_imovel]);

        // Em seguida, exclua o próprio imóvel
        $sql_delete_imovel = "DELETE FROM imovel WHERE id_imovel = :id_imovel";
        $stmt_delete_imovel = $conexao->prepare($sql_delete_imovel);
        $stmt_delete_imovel->execute([':id_imovel' => $id_imovel]);

        header('Location: ../pag_cliente.php');
        exit();
    } else {
        echo "Erro: ID do imóvel não foi fornecido.";
        exit();
    }
?>