<?php
    session_start();

    include 'conexao.php';

    if (isset($_POST['id_reserva'])) {
        $id_reserva = $_REQUEST['id_reserva'];

        $sql = "DELETE FROM reserva WHERE id_reserva = :id_reserva";
        $stmt = $conexao->prepare($sql);
        $stmt->execute([':id_reserva' => $id_reserva]);

        header('Location: ../pag_cliente.php');
        exit();
    } else {
        echo "Erro: ID da reserva não foi fornecido.";
        exit();
    }

?>
