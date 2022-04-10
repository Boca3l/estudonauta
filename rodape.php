<?php
    echo "<footer class='rodape'>";
    echo "<p>Acessado por ".$_SESSION['user']." em ".date('d/m/y')."</p>";
    echo "<p>Desenvolvido por <a href='https://www.linkedin.com/in/preisteixeira/'>Pedro Teixeira &copy </a> 2022</p>";
    echo "</footer>";
    $banco->close();
?>