<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Jogos</title>
    <link rel="stylesheet" href="estilos/style.css">
</head>
<body>
    <?php
        require_once "includes/banco.php";
        require_once "includes/funcoes.php";
        $ordem = $_GET['o'] ?? "n";
        $chave = $_GET['c'] ?? "";
    ?>

    <div id="corpo">

        <?php include_once "topo.php"; ?>

        <h1>Escolha seu jogo</h1>

        <form action="index.php" method="get" id="busca">
            Ordenar: 
            <a href="index.php?o=n">Nome</a> | 
            <a href="index.php?o=p">Produtora</a> | 
            <a href="index.php?o=n1">Nota Alta</a> | 
            <a href="index.php?o=n2">Nota Baixa</a> | 
            <a href="index.php?o=g">Genero</a> | 
            <a href="index.php?">Mostrar Todos</a> | 
            Buscar: <input type="text"name="c" size="10" maxlength="40"/>
            <input type="submit" value="ok">
        </form>
        <table class="listagem">
            <?php

                $q = "SELECT j.cod, j.nome, g.genero, j.capa, p.produtora 
                FROM jogos j 
                JOIN generos g ON j.genero = g.cod
                JOIN produtoras p ON j.produtora = p.cod ";

                if(!empty($chave)){
                    $q .= "WHERE j.nome LIKE '%$chave%' OR p.produtora LIKE '%$chave%' OR g.genero LIKE '%$chave%' ";
                }

                switch($ordem){
                    case "p":
                        $q .= "ORDER BY p.produtora";
                        break;
                    case "n1":
                        $q .= "ORDER BY j.nota DESC";
                        break;
                    case "n2":
                        $q .= "ORDER BY j.nota ASC";
                        break;
                    case "g":
                        $q .= "ORDER BY g.genero, j.nome";
                        break;
                    default:
                        $q .= "ORDER BY j.nome";
                        break;
                }

                $busca = $banco->query("$q");
                if($busca->num_rows ==0){
                    echo "<tr><td>Infelizmente a busca deu errado<td></tr>";
                }else{  
                    while($reg=$busca->fetch_object()){
                        $t = thumb($reg->capa);
                        echo "<tr><td><img src='$t' class='mini' />";
                        echo "<td><a href='detalhes.php?cod=$reg->cod'>$reg->nome</a>";
                        echo " [$reg->genero]";
                        echo "</br>$reg->produtora";
                        echo "<td>adm</tr>";
                    }
                }
            ?>
        </table>
    </div>
    <?php include_once "rodape.php"; ?>
</body>
</html>