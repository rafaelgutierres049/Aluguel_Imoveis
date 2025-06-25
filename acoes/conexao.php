<?php

    $bd = 'seu_banco';
    $host = 'seu_host';
    $porta = '3306';
    $conexao = new PDO('mysql:host='.$host.';
                port='.$porta.';
                dbname='.$bd, "root",""
    );

?>
