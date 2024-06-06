<?php
    $page = "Reserve";
    include "acoes/conexao.php";
    
    $id_imovel = isset($_GET['id']) ? intval($_GET['id']) : 0;

    if ($id_imovel > 0) {
        $sql = "SELECT * FROM imovel WHERE id_imovel = :id_imovel";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':id_imovel', $id_imovel, PDO::PARAM_INT);
        $stmt->execute();
        $imovel = $stmt->fetch(PDO::FETCH_OBJ);

        if (!$imovel) {
            echo "Imóvel não encontrado!";
            exit;
        }
    } else {
        echo "ID de imóvel inválido!";
        exit;
    }

    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<?php include "secoes/head.php"?>
<body>

    <?php include "secoes/cabecalho.php"?>
    <div class="conteudo">
        <div class="container">
            <div class="container_objetos">
                <div class="container_objetos_2 centralizar_column">
                    <img src="<?php echo 'data:image/jpeg;base64,' . base64_encode($imovel->imagem); ?>" alt="Imagem" width="90%" height="90%">

                </div>
                <div class="container_objetos_2 centralizar_column">
                    <div class="centralizar_column" style="background-color:#a3a375;height:90%;width:90%;">
                        <div class="centralizar_column" style="height:33%">
                            <h1><?php echo $imovel->titulo?></h1>
                            <h2><?php echo $imovel->localizacao?></h2>
                        </div> 
                        <div class="centralizar_column" style="height:33%">
                        <h1 style="background-color:lime;color:white;padding:10%;border-radius:2dvh">R$<?php echo $imovel->preco ?>,00</h1>

                            
                        </div> 
                        <div class="centralizar_column" style="height:33%;">
                            <form style="font-weight:600;background-color:white;padding:1rem;border-radius:1rem" class="centralizar_row" action="acoes/reserva_imovel.php" method="post">
                                <input type="hidden" name="id_imovel" value="<?php echo $imovel->id_imovel; ?>">
                                <input type="hidden" name="num_hospedes" value="<?php echo $imovel->num_hospedes; ?>">
                                <label for="checkin">Check-in</label>
                                <input type="date" name="checkin" id="checkin">
                                <label for="checkout">Check-out</label>
                                <input type="date" name="checkout" id="checkout">
                                <input type="submit" value="Reservar">
                            </form>
                        </div>
                    

                    </div>
                    
                </div>
            </div>
            
        </div>

        <div class="container">
            <div style="background-color:#dedec1" class="container_objetos centralizar_column">
                <h1>Informações Gerais</h1>
                <div style="height: 80%;width:100%" class="centralizar_row">
                    <div class="container_objetos_2 centralizar_column" style="text-align:center">
                        
                        <h3 style="margin:1dvh"><?php echo $imovel->descricao?></h3>

                    </div>
                    <div class="container_objetos_2 centralizar_column" style="text-align:center">
                        
                        <h3 style="background-color:#a3a375; color:white; padding: 2%; border-radius:1dvh"><?php echo $imovel->num_hospedes?> Hóspedes</h3>

                        <h3 style="background-color:#a3a375; color:white; padding: 2%; border-radius:1dvh"><?php echo $imovel->num_quartos?> Quartos</h3>
                    </div>
                </div>
                
                
                    
            </div>
            
        </div>
    </div>
    
    <?php include "secoes/rodape.php"?>

</body>
</html>
