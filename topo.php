<?php
    echo "<header>";
    echo empty($_SESSION['user'])?"<a href='user-login.php'> Entrar </a>":"Olá, ".$_SESSION['nome'];
    echo "</header>";
?>