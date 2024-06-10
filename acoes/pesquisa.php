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

        if (count($imoveis) > 0) {
            header("Location: ../pesquisa_imoveis.php?localizacao=$localizacao");
            exit();
        } else {
            echo "<script>
                    alert('Não há imóveis nessa localização.');
                    window.location.href = '../index.php';
                  </script>";
            exit();
        }
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
} else {
    echo "Localização não especificada.";
}
?>
