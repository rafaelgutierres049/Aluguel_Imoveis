<?php
// Verifica se a localização foi especificada
if(isset($_REQUEST['localizacao'])) {
    $localizacao = $_REQUEST['localizacao'];
    
    // Inclui o arquivo de conexão com o banco de dados
    include 'conexao.php';
    
    try {
        // Consulta SQL para selecionar os imóveis com base na localização
        $sql = 'SELECT * FROM imovel WHERE localizacao = :localizacao';
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':localizacao', $localizacao);
        $stmt->execute();
        $imoveis = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Redireciona para a página de pesquisa de imóveis com a localização como parâmetro na URL
        header("Location: ../pesquisa_imoveis.php?localizacao=$localizacao");
        exit(); // Termina o script após o redirecionamento
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
} else {
    echo "Localização não especificada.";
}
?>
