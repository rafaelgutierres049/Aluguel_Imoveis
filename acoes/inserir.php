<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_usuario = $_POST['id_usuario'];
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $localizacao = $_POST['localizacao'];
    $preco = $_POST['preco'];
    $num_quartos = $_POST['num_quartos'];
    $num_hospedes = $_POST['num_hospedes'];

    // Verifica se o arquivo foi enviado e não houve erro
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['imagem']['tmp_name'];
        $fileName = $_FILES['imagem']['name'];
        $fileSize = $_FILES['imagem']['size'];
        $fileType = $_FILES['imagem']['type'];
        
        // Lê o conteúdo do arquivo
        $imageData = file_get_contents($fileTmpPath);
        
        // Insere os dados no banco de dados
        $sql = "INSERT INTO imovel (titulo, descricao, localizacao, preco, num_quartos, num_hospedes, imagem, id_usuario) 
                VALUES (:titulo, :descricao, :localizacao, :preco, :num_quartos, :num_hospedes, :imagem, :id_usuario)";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':localizacao', $localizacao);
        $stmt->bindParam(':preco', $preco);
        $stmt->bindParam(':num_quartos', $num_quartos);
        $stmt->bindParam(':num_hospedes', $num_hospedes);
        $stmt->bindParam(':imagem', $imageData, PDO::PARAM_LOB);
        $stmt->bindParam(':id_usuario', $id_usuario);
        
        if ($stmt->execute()) {
            header('Location: ../cadastro_imovel.php');
            exit();
        } else {
            echo 'Erro ao cadastrar imóvel: ' . $stmt->errorInfo()[2];
        }
    } else {
        echo 'Erro no upload da imagem. Verifique se o arquivo foi selecionado e tente novamente.';
    }
} else {
    echo 'Método de requisição inválido.';
}
?>
