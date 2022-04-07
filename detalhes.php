<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do jogo</title>
    <link rel="stylesheet" href="estilos/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet"> 

    <style>
        .material-icons{
            font-size: 48px;
        }
    </style>
</head>
<body>
    <?php
        require_once "includes/banco.php";
        require_once "includes/funcoes.php";
        
    ?>

    <div id="corpo">
        <?php
            $cod = $_GET['cod'] ?? 0;
            $busca = $banco->query("SELECT * FROM jogos WHERE cod = $cod");
            $row = $busca->fetch_object();
        ?>

        <?php 
            if($busca->num_rows != 1 ){
                echo "<tr><td>A busca falhou! $banco->error";
            }else{

                echo "<h1>Detalhes de $row->nome</h1>";

                echo "<table class='detalhes'>";
                $t = thumb($row->capa);
                echo "<tr><td rowspan='3'><img src='$t' class='full' /></td>";
                echo "<td><h2>$row->nome</h2>";
                echo "Nota: " . number_format($row->nota,1)."/10.0";
                echo "<tr><td>$row->descricao</td></tr>";
                echo "<tr><td>Adm</td></tr>";
            }
        ?>
        </table>
        <?php echo voltar(); ?>

    </div>
    <?php include_once "rodape.php"; ?>
</body>
</html>