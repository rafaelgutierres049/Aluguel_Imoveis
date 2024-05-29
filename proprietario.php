<?php 
    $page = "CZ - Proprietário";
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

    <?php include "secoes/head.php"?>

    <body>
        <?php include "secoes/cabecalho.php" ?>

        
        <div class="conteudo">

            <div class="container">
                <div class="container_objetos">
                    <div class="conteudo_prop">
                        <div class="container_objetos_2 centralizar_column">
                            <h1>Proprietário</h1>
                        </div>
                        <div class="container_objetos_2 centralizar_column">
                        <h3>
                                Cadastre seu imóvel agora e descubra o potencial de rentabilidade que ele pode 
                                oferecer!
                            </h3>
                                <br><br><a class="botao_primario" href="cadastro_imovel.php">Quero Cadastrar!</a>
                        </div>

                    </div>
                </div>
                

            </div>
            

            <div class="container" style="background-color:#dedec1">
                <div class="container_objetos">

                    <div class="container_objetos_2 centralizar_column">
                        <ul class="lista">
                            <li>Maior rentabilidade</li>
                            <li>Atendimento 24 horas</li>
                            <li>Gestão de manutenção</li>
                            <li>Menor Taxa de Vacância</li>
                        </ul>
                    </div>

                    
                    <div class="container_objetos_2 centralizar_column">
                        <div style="background-image: url('images/rentabilidade.jpg')" class="divulgacao_2 background_image_cover">
                        
                        </div>
                    </div>
                    

                </div>
                
            </div>

        </div>

        <?php include "secoes/rodape.php" ?>
    </body>
</html>
