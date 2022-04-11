<!DOCTYPE html>
<?php
    require_once "includes/banco.php";
    require_once "includes/funcoes.php";
    require_once "includes/login.php"
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Usuário</title>
    <link rel="stylesheet" href="./estilos/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet"> 
    <style>
        div#corpo{
            width: 400px;
            font-size: 13pt;
        }
        table td{
            padding: 6px;
        }
    </style>
</head>
<body>
    <div id="corpo">
        <?php
            $u = $_POST['usuario'] ?? null;
            $s = $_POST['senha'] ?? null;

            if(is_null($u) || is_null($s)){
                require "user-login-form.php";
            }else{
                $q = "SELECT usuario, nome, senha, tipo FROM usuarios WHERE usuario = '$u' LIMIT 1";
                try{
                    $busca = $banco->query($q);
                    if(!$busca){
                        echo msg_erro("Falha ao acessar banco!");
                    }else{
                        if($busca->num_rows>0){
                            $reg = $busca->fetch_object();
                            if(testarHash($s,$reg->senha)){
                                echo msg_sucesso("Logado com sucesso");
                                login($reg->usuario,$reg->nome,$reg->tipo);
                            }else{
                                echo msg_erro("Senha inválida!");
                            }
                        }else{
                            echo msg_erro("Usuário não encontrado!");
                        }
                    }
                }catch(Exception $ex){
                    echo msg_erro("Não foi possível realizar o login, tente novamente!");
                }
            }
            echo voltar();
        ?>
    </div>
    <?php include_once "rodape.php"; ?>
</body>
</html>