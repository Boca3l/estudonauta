<?php
    //cria uma nova conexão 'banco' conexão com MySQLI(local,usuário,senha,banco)
    $banco = new mysqli("localhost","root","","bd_games");

    //cria uma variável 'busca' que vai receber uma query dentro do banco conectado
    /*
    $busca = $banco->query("SELECT genero FROM generos WHERE cod <= 5 ");
    */
    
    //roda a variável 'busca' através o método fetch_object() para imprimir as tuplas
    /*
    while($reg = $busca->fetch_object()){
        print_r("<a href='#'>$reg->genero</a></br>");
    }
    */
?>
