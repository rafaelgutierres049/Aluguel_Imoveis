<?php
    $page = "CZ - Home";
    include 'acoes/conexao.php';
    $sql = "SELECT * FROM imovel ORDER BY RAND() LIMIT 4";
    $consulta = $conexao->query($sql);
    session_start();
?>


<!DOCTYPE html>
<html lang="pt-br">

<?php include 'secoes/head.php'?>

<body>
    
    <?php include "secoes/cabecalho.php" ?>

    <div class="conteudo">

        <div class="container" style="box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.4);">

            <div class="pesquisa">
                <div class="container_objetos centralizar_column">
                    <form action="acoes/pesquisa.php" method="post">
                        <div>
                            <label for="localizacao">Localização:</label>
                            <input type="text" id="localizacao" name="localizacao">
                            <label for="num_quartos">Quartos:</label>
                            <input type="number" id="num_quartos" name="num_quartos">
                            <label for="num_hospedes">Hóspedes:</label>
                            <input type="number" id="num_hospedes" name="num_hospedes">
                           
                        </div>
                        <input class="botao_secundario" type="submit" value="Pesquisar">
                    </form>
                </div>
                
            </div>



        </div>
        
        <div class="conteudo">
            <div class="container">
                <div class="container_objetos centralizar_column">
                    <h1>Imóveis Disponíveis</h1><br>
                    <div style="height: 70%; width: 100%;gap:1%" class="centralizar_row">
                        <?php while ($linha = $consulta->fetch(PDO::FETCH_OBJ)) { ?>
                            <a href="reserva.php?id=<?php echo $linha->id_imovel; ?>" class="a_imovel">

                                <div class="imoveis_img">
                                    <img src="<?php echo 'data:image/jpeg;base64,' . base64_encode($linha->imagem); ?>" style="border-radius:1rem 1rem 0 0" alt="Imagem" width="100%" height="100%">
                                </div>

                                <div class="imoveis_info">
                                    <div><?php echo $linha->localizacao ?></div>
                                    <div class="imoveis_info2">
                                        <div>H: <?php echo $linha->num_hospedes ?></div>
                                        <div>Q: <?php echo $linha->num_quartos ?></div>
                                        <div style="color:#6FFF40">R$<?php echo $linha->preco ?></div>

                                    </div>
                                </div>
                            </a>
                        <?php
                            }
                        ?>
                    </div>
                            <br>
                        <a href="alugar.php"><h2>Mais Imóveis</h2></a>

                    </div>
                </div>
        </div>
        
        <div class="container" style="background-color:#a3a375" >
            
            <div class="container_objetos">

                <div style="color:white" class="centralizar_row">

                    <div class="container_objetos_2 centralizar_column">

                            <h1 class="subtitulo">Proprietário</h1>

                            <div style="padding:5rem;display:flex;flex-direction:column;justify-content:center;align-items:center">
                                <h3>Registre seu imóvel conosco e descubra uma nova dimensão 
                                na divulgação de propriedades, proporcionando uma experiência única e inigualável.</h3><br>
                                <div>
                                    <a class="botao_terciario" href="proprietario.php">Saiba mais</a>
                                </div>
                            </div>
                    </div>

                    <div class="container_objetos_2 centralizar_column">

                            <a style="width:90%;height:90%" href="proprietario.php">
                                <div class="prop_imagem"></div>
                            </a>
                    </div>
                    
                </div>
            </div>
            

        </div>
        
        <div class="container" style="background-color:#dedec1">
            <div class="container_objetos">

                <div style="background-color:#dedec1" class="institucional_home">
                <h1>Comfort Zone</h1><br><br>
                <div style="text-align:center">
                    <span>
                        Em nossa plataforma de aluguel de imóveis, comprometemo-nos a oferecer uma experiência institucional sólida e
                        confiável. Nossa abordagem resiliente e focada na segurança é evidente em cada interação, garantindo que cada
                        cliente se sinta confiante e seguro em sua busca por um lar. Com transparência e profissionalismo, buscamos
                        não apenas atender, mas exceder as expectativas, transformando o processo de encontrar um novo lar em uma
                        jornada tranquila e gratificante para todos os envolvidos.
                    </span>
                    <br>
                        <a class="a_home" href="sobre.php"><h3>Saiba mais</h3></a>
                    
                </div>
                
            </div>

            </div>

            

        </div>
        
        
    </div>

    <?php include "secoes/rodape.php" ?>

    
</body>
</html>