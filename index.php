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

        <h1>Escolha seu jogo</h1>

        <table class="listagem">
            <?php
                $busca = $banco->query("SELECT * FROM jogos");
                if($busca->num_rows ==0){
                    echo "<tr><td>Infelizmente a busca deu errado<td></tr>";
                }else{  
                    while($reg=$busca->fetch_object()){
                        $t = thumb($reg->capa);
                        echo "<tr><td><img src='$t' class='mini' />";
                        echo "<td><a href='detalhes.php?cod=$reg->cod'>$reg->nome</a>";
                        echo "<td>adm</tr>";
                    }
                }
            ?>
        </table>
    </div>

    <?php $banco->close(); ?>
</body>
</html>