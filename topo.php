<?php
    echo "<header>";
    echo "<p class='pequeno'>";
    echo empty($_SESSION['user'])?"<a href='user-login.php'>Entrar</a>":"Olá, ".$_SESSION['nome']." | <a href='user-logout.php'>Sair</a>";
    echo "</p>";
    echo "</header>";
?>