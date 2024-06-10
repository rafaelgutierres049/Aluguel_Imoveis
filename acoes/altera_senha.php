<?php
include 'conexao.php';

function limpaEntrada($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = limpaEntrada($_POST["email"]);
    $nova_senha = limpaEntrada($_POST["senha"]);
    $confirmacao_senha = limpaEntrada($_POST["senha"]);

    if (empty($email) || empty($nova_senha) || empty($confirmacao_senha)) {
        echo "<script>
                alert('Todos os campos são obrigatórios.');
                window.location.href = '../alterar_senha.php';
              </script>";
        exit;
    }

    if ($nova_senha !== $confirmacao_senha) {
        echo "<script>
                alert('As senhas não coincidem.');
                window.location.href = '../alterar_senha.php';
              </script>";
        exit;
    }

    try {
        $stmt = $conexao->prepare("SELECT * FROM usuario WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->rowCount() == 0) {
            echo "<script>
                    alert('Email não encontrado.');
                    window.location.href = '../pag_login.php';
                  </script>";
            exit;
        }

        $stmt = $conexao->prepare("UPDATE usuario SET senha = ? WHERE email = ?");
        if ($stmt->execute([$nova_senha, $email])) {
            echo "<script>
                    alert('Senha alterada com sucesso.');
                    window.location.href = '../pag_login.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Erro ao alterar a senha.');
                    window.location.href = '../pag_login.php';
                  </script>";
        }
    } catch (PDOException $e) {
        echo "<script>
                alert('Erro: " . $e->getMessage() . "');
                window.location.href = '../pag_login.php';
              </script>";
    }
} else {
    echo "<script>
            alert('Método de requisição inválido.');
            window.location.href = '../pag_login.php';
          </script>";
}
?>
