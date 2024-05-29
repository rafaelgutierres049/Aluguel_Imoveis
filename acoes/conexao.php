<?php

    $bd = 'bd_imoveis';
    $host = 'localhost';
    $porta = '3306';
    $conexao = new PDO('mysql:host='.$host.';
                port='.$porta.';
                dbname='.$bd, "root",""
    );

?>