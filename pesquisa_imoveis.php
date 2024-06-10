<?php
$page = "CZ - Imóveis";
include 'acoes/conexao.php';

// Verifica se a localização foi passada como parâmetro na URL
if (isset($_GET['localizacao'])) {
    $localizacao = $_GET['localizacao'];

    // Consulta SQL para selecionar os imóveis com base na localização especificada
    $sql = "SELECT * FROM imovel WHERE localizacao = :localizacao";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':localizacao', $localizacao);
    $stmt->execute();

    // Verifica se a consulta retornou resultados
    if ($stmt->rowCount() > 0) {
        // Atribui os resultados à variável $imoveis
        $imoveis = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        // Se a consulta não retornar resultados, mostra uma mensagem indicando que não há imóveis disponíveis naquela localização
        echo "Não há imóveis disponíveis na localização especificada.";
    }
} else {
    // Se a localização não foi passada como parâmetro na URL, redireciona o usuário de volta para a página de pesquisa
    header("Location: pesquisa_imoveis.php");
    exit(); // Termina o script após o redirecionamento
}

session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<?php include 'secoes/head.php'?>
<body>
    <?php include 'secoes/cabecalho.php'?>

    <div class="conteudo">
        <div class="container">
            <div class="container_objetos centralizar_column">
                <h2>Resultado da pesquisa</h2>
                <div style="height: 70%; width: 100%;gap:1%" class="centralizar_row">
                    <?php foreach ($imoveis as $imovel):?>
                        <a class="imovel_card" href="reserva.php?id=<?php echo $imovel['id_imovel']; ?>">
                    

                            <div style="height:70%;width:100%">
                                <img src="<?php echo 'data:image/jpeg;base64,' . base64_encode($imovel['imagem']); ?>" style="border-radius:1rem 1rem 0 0" alt="Imagem" width="100%" height="100%">
                            </div>
                            <div class="imovel_info centralizar_column">
                                <div style="margin:5%" class="centralizar_column">
                                    <div style="font-weight:600"><?php echo $imovel['localizacao'] ?></div>
                                    <div style="gap:2dvw" class="centralizar_row">
                                        <div>H: <?php echo $imovel['num_hospedes'] ?></div>
                                        <div>Q: <?php echo $imovel['num_quartos'] ?></div>
                                        <div style="color:#258b03; font-weight:700">R$<?php echo $imovel['preco'] ?></div>

                                    </div>
                                </div>
                                
                            </div>


                        </a>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>

    <?php include 'secoes/rodape.php'?>

</body>
</html>
