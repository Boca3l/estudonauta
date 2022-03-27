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
    ?>

    <div id="corpo">

        <?php include_once "topo.php"; ?>

        <h1>Escolha seu jogo</h1>

        <form action="index.php" method="get" id="busca">
            Ordenar: Nome | Produtora | Nota Alta| Nota Baixa| Genero |
            Buscar: <input type="text"name="c" size="10" maxlength="40"/>
            <input type="submit" value="ok">
        </form>
        <table class="listagem">
            <?php
                $q = "SELECT j.cod, j.nome, g.genero, j.capa, p.produtora 
                FROM jogos j 
                JOIN generos g ON j.genero = g.cod
                JOIN produtoras p ON j.produtora = p.cod";

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