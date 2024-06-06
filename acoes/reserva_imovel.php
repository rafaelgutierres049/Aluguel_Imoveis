<?php
include 'conexao.php';

// Verifica se o usuário está logado
session_start(); // Inicia a sessão se ainda não estiver iniciada
if (!isset($_SESSION['id_usuario'])) {
    echo "<script>
            alert('Usuário não está logado.');
            window.location.href = '../login.php'; // Redireciona para a página de login
          </script>";
    exit();
}

// Obtém os dados da solicitação
$id_imovel = $_REQUEST['id_imovel'];
$num_hospedes = $_REQUEST['num_hospedes'];
$id_usuario = $_SESSION['id_usuario'];
$data_checkin = $_REQUEST['checkin'];
$data_checkout = $_REQUEST['checkout'];

try {
    // Verifica se já existe uma reserva para o imóvel na data especificada
    $stmt = $conexao->prepare("
        SELECT COUNT(*) AS total
        FROM reserva
        WHERE id_imovel = :id_imovel
          AND :data_checkin < data_checkout
          AND :data_checkout > data_checkin
    ");
    $stmt->bindParam(':id_imovel', $id_imovel);
    $stmt->bindParam(':data_checkin', $data_checkin);
    $stmt->bindParam(':data_checkout', $data_checkout);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result['total'] > 0) {
        // Já existe uma reserva para o imóvel na data especificada
        echo "<script>
                alert('Já existe uma reserva para o imóvel na data especificada.');
                window.history.back(); // Volta para a página anterior
              </script>";
        exit();
    } else {
        // Não existe uma reserva para o imóvel na data especificada
        // Insere a nova reserva no banco de dados
        $sql = "INSERT INTO reserva (id_usuario, id_imovel, data_checkin, data_checkout, num_hospedes) 
                VALUES (:id_usuario, :id_imovel, :data_checkin, :data_checkout, :num_hospedes)";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->bindParam(':id_imovel', $id_imovel);
        $stmt->bindParam(':data_checkin', $data_checkin);
        $stmt->bindParam(':data_checkout', $data_checkout);
        $stmt->bindParam(':num_hospedes', $num_hospedes);
        $stmt->execute();

        echo "<script>
                alert('Reserva realizada com sucesso.');
                window.history.back(); // Volta para a página anterior 
              </script>";
    }
} catch(PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>