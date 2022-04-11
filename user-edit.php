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
    <title>Editar Dados</title>
    <link rel="stylesheet" href="./estilos/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet"> 
</head>
<body>
    <div id="corpo">
        <?php 
            if(!is_logado()){
                echo msg_erro("Efetue o <a href='http://localhost/estudonauta/user-login.php'>Login</a> para continuar");
            }else{
                if(!isset($_POST['usuario'])){
                    include "user-edit-form.php";
                }else{
                    $usuario = $_POST['usuario']??null;
                    $nome = $_POST['nome']??null;
                    $tipo = $_POST['tipo']??null;
                    $senha1 = $_POST['senha1']??null;
                    $senha2 = $_POST['senha2']??null;

                    $q = "UPDATE usuarios set usuario = '$usuario', nome = '$nome'";

                    if(empty($senha1)||is_null($senha1)){
                        echo msg_aviso("A senha foi mantida");
                    }else{
                        if($senha1===$senha2){
                            $senha = gerarHash($senha1);
                            $q .= ", senha = '$senha'";
                        }else{
                            msg_erro("Senhas não conferem, a senha anterior será mantida");
                        }
                    }

                    $q .= " WHERE usuario = '".$_SESSION['user']."'";

                    try{
                        if($banco->query($q)){
                            logout();
                            login($usuario,$nome,$tipo);
                            echo msg_sucesso("Usuário alterado com sucesso!");
                        }
                    }catch(Exception $ex){
                        echo msg_erro("Não foi possível alterar os dados.");
                    }
                    
                }
            }

            echo voltar();
        ?>
    </div>
    <?php include_once "rodape.php"; ?>
</body>
</html>