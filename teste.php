<?php
session_start(); // Inicia a sessão se ainda não estiver iniciada

// Verifica se o usuário está logado
if(isset($_SESSION['id_usuario'])) {
    // O usuário está logado, então podemos exibir o ID do usuário
    $id_usuario = $_SESSION['id_usuario'];
    $nome = $_SESSION['nome_usuario'];
    echo "O ID do usuário é: $id_usuario e seu nome é: $nome";
} else {
    // Se o usuário não estiver logado, você pode exibir uma mensagem de erro ou redirecionar para a página de login
    echo "O usuário não está logado.";
}
?>
