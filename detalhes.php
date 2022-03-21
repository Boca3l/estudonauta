<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do jogo</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
        require_once "includes/banco.php";
        require_once "includes/funcoes.php";
        $cod = $_GET['cod'] ?? 0;

        $row = $banco->query("SELECT * FROM jogos")->fetch_object();
        $t = thumb($row->capa)
    ?>

    <div id="corpo">
        <?php
            echo "<h1>Detalhes do jogo $row->nome</h1>";
        ?>

        <table>
            <?php echo "
                <tr>
                    <td rowspan='3'><img src='$t' /></td>
                    <td>$row->nome</td>
                </tr>
                <tr>
                    <td>$row->descricao</td>
                </tr>
                <tr>
                    <td>Adm</td>
                </tr>
                ";
            ?>
        </table>

    </div>
    
</body>
</html>