<?php
include 'conexao.php';

$email = $_REQUEST['email'];
$senha = $_REQUEST['senha'];

$sqlUsuario = "SELECT * FROM usuario as u 
               INNER JOIN perfil as p
               ON u.id_perfil = p.id_perfil
               WHERE email = :email AND senha = :senha";
$stmt = $conexao->prepare($sqlUsuario);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':senha', $senha);
$stmt->execute();
$usuario = $stmt->fetch(PDO::FETCH_OBJ);

if($usuario != null) {
    session_start();
    $_SESSION['nome_usuario'] = $usuario->nome;
    $_SESSION['login_usuario'] = $usuario->email;
    $_SESSION['id_perfil'] = $usuario->id_perfil;
    $_SESSION['id_usuario'] = $usuario->id_usuario;
    Header('Location: ../pag_cliente.php');
    exit();
} else {
    echo "<script>
            alert('Email ou senha incorretos. Caso não possua login, cadastre-se e tente novamente!');
            window.location.href = '../pag_login.php';
          </script>";
    exit();
}
?>
