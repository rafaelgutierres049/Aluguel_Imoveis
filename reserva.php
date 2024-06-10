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
        <h2><?php echo $imovel->titulo?></h2>
        
            <div class="container_objetos">
                
                <div class="container_objetos_2 centralizar_column">
                    <img src="<?php echo 'data:image/jpeg;base64,' . base64_encode($imovel->imagem); ?>" alt="Imagem" width="90%" height="90%" style="border-radius:2dvh">

                </div>
                <div class="container_objetos_2 centralizar_column">
                    <div style="background-color:#a3a375;height:90%;width:90%;border-radius:2dvh">
                        <div class="centralizar_row" style="heigth:20%">
                            <div class="centralizar_column container_objetos_2">
                                <h2 style="color:white"><?php echo $imovel->localizacao?></h2>
                            </div>
                            <div class="centralizar_column container_objetos_2">
                                <h1 style="background-color:lime;color:white;padding:3%;border-radius:2dvh;width:auto;">R$<?php echo $imovel->preco ?>,00</h1>

                            </div>
                            
                        </div>
                          
                        <div class="centralizar_column">
                            <form class="form-reserva centralizar_column" action="acoes/reserva_imovel.php" method="post">
                                <input type="hidden" name="id_imovel" value="<?php echo htmlspecialchars($imovel->id_imovel); ?>">
                                <input type="hidden" name="num_hospedes" value="<?php echo htmlspecialchars($imovel->num_hospedes); ?>">
                                
                                <label for="checkin">Check-in</label>
                                <input class="input-data" type="date" name="checkin" id="checkin" required>
                                
                                <label for="checkout">Check-out</label>
                                <input class="input-data" type="date" name="checkout" id="checkout" required>
                                
                                <input class="btn-reservar" type="submit" value="Reservar">
                                <div id="total-price" style=" font-size: 1.5em; color: white; background-color: #a3a375; padding: 10px; border-radius: 2dvh;">
                                Total: R$ <span id="total-preco">0.00</span>
                            </div>
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
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
    const checkin = document.getElementById('checkin');
    const checkout = document.getElementById('checkout');
    const totalPreco = document.getElementById('total-preco');
    const precoPorNoite = <?php echo $imovel->preco; ?>;

    function calculateTotalPrice() {
        const checkinDate = new Date(checkin.value);
        const checkoutDate = new Date(checkout.value);

        if (checkinDate && checkoutDate && checkinDate < checkoutDate) {
            const timeDifference = checkoutDate - checkinDate;
            const daysDifference = timeDifference / (1000 * 3600 * 24);
            const totalPrice = daysDifference * precoPorNoite;
            totalPreco.textContent = totalPrice.toFixed(2);
        } else {
            totalPreco.textContent = '0.00';
        }
    }

    checkin.addEventListener('change', calculateTotalPrice);
    checkout.addEventListener('change', calculateTotalPrice);
});

</script>
</html>
