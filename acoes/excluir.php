<?php
    include 'conexao.php';
    
    $id = $_REQUEST['id'];
    $sql = "DELETE FROM imoveis WHERE id = :id";

    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    Header('Location: index.php');

?>