<?php
if(isset($_REQUEST['localizacao'])) {
    $localizacao = $_REQUEST['localizacao'];
    
    include 'conexao.php';
    
    try {
        $sql = 'SELECT * FROM imovel WHERE localizacao = :localizacao';
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':localizacao', $localizacao);
        $stmt->execute();
        $imoveis = $stmt->fetchAll(PDO::FETCH_ASSOC);

        header("Location: ../pesquisa_imoveis.php?localizacao=$localizacao");
        exit();
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
} else {
    echo "Localização não especificada.";
}
?>
