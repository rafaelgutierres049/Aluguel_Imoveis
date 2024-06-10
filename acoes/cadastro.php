<?php
    include 'conexao.php';

    $email = $_REQUEST['email'];
    $senha = $_REQUEST['senha'];
    $nome = $_REQUEST['nome'];
    $id_perfil = $_REQUEST['id_perfil'];

    $sqlCheck = "SELECT COUNT(*) FROM usuario WHERE email = :email";
    $stmtCheck = $conexao->prepare($sqlCheck);
    $stmtCheck->bindParam(':email', $email);
    $stmtCheck->execute();
    $emailExists = $stmtCheck->fetchColumn();

    if ($emailExists) {
        echo "<script>
                alert('E-mail já cadastrado');
                window.location.href = '../cadastre.php';
              </script>";
    } else {
        $sql = "INSERT INTO usuario (nome, email, senha, id_perfil) 
                VALUES (:nome, :email, :senha, :id_perfil)";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);
        $stmt->bindParam(':id_perfil', $id_perfil);

        $stmt->execute();
       
        Header('Location: ../pag_login.php');
    }
?>
