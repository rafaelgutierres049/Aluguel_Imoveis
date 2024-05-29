<?php if (isset($_SESSION['nome_usuario'])): ?>

    <header class="cabecalho">
        <div style="display: flex; align-items: center; justify-content:center">
            <div class="menu">
                <a href="index.php">
                    <img class="logo" src="images/LOGO_site.jpg" alt="Logo do site">
                </a>
            </div>
            <div class="menu">
                <a href="index.php">Home</a>
                <a href="alugar.php">Alugar</a>
                <a href="proprietario.php">Proprietário</a>
                <a href="sobre.php">Sobre</a>
                <a class="botao_login" href="pag_cliente.php">Minha conta</a>
            </div>
        </div>
    </header>


<?php else: ?>
    <header class="cabecalho">
        <div style="display: flex; align-items: center; justify-content:center">
            <div class="menu">
                <a href="index.php">
                    <img src="images/LOGO_site.jpg" alt="Logo do site">
                </a>
            </div>
            <div class="menu">
                <a href="index.php">Home</a>
                <a href="alugar.php">Alugar</a>
                <a href="proprietario.php">Proprietário</a>
                <a href="sobre.php">Sobre</a>
                <a class="botao_login" href="pag_login.php">Login</a>
            </div>
        </div>
    </header>
<?php endif; ?>
