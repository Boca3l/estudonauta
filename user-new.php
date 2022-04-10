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
    <title>???</title>
    <link rel="stylesheet" href="./estilos/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet"> 
</head>
<body>
    <div id="corpo">
        <?php
            if(!is_admin()){
                echo msg_erro("Usuário não autorizado!");
            }else{
               if(!isset($_POST['usuario'])){
                   require "user-new-form.php";
               }else{
                    $usuario = $_POST['usuario'] ?? null;
                    $nome = $_POST['nome']??null;
                    $senha1 = $_POST['senha1']??null;
                    $senha2 = $_POST['senha2']??null;
                    $tipo= $_POST['tipo']??null;

                    if($senha1===$senha2){
                        if(empty($usuario)||empty($nome)||empty($senha1)||empty($senha2)||empty($tipo)){
                            echo msg_erro("Todos os dados devem ser preenchidos!");
                            echo $usuario.$nome.$senha1.$senha2.$tipo;
                            echo "<a href='user-new.php'>".msg_aviso("Voltar para o cadastro")."</a>";
                        }else{
                            $senha = gerarHash($senha1);
                            $q = "INSERT INTO usuarios (usuario,nome,senha,tipo) VALUES ('$usuario','$nome','$senha','$tipo')";

                            try{
                                if($banco->query($q)){
                                echo msg_sucesso("Usuário $usuario cadastrado com sucesso!");
                                }
                            }catch (Exception $ex){
                                echo msg_erro("Erro ao cadastrar o usuário $usuario, Tente outro login.");
                                echo "<a href='user-new.php'>".msg_aviso("Voltar para o cadastro")."</a>";
                            }
                        }
                    }else{
                        echo msg_erro("Senhas não conferem");
                        echo "<a href='user-new.php'>".msg_aviso("Voltar para o cadastro")."</a>";
                    }
               }
               echo voltar();
            }
            
        ?>
    </div>
</body>
</html>