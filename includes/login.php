<?php 

session_start();

if(!isset($_SESSION['user'])){
    $_SESSION['user'] = "";
    $_SESSION['nome'] = "";
    $_SESSION['tipo'] = "";
}

function gerarHash($senha){
    $txt = cripto($senha);
    $hash = password_hash($txt,PASSWORD_DEFAULT);
    return $hash;
}

function testarHash($senha,$hash){
    $ok = password_verify(cripto($senha),$hash);
    return $ok;
}

function cripto($senha){
    $c = '';
    for($i=0;$i<strlen($senha);$i++){
        $letra= ord($senha[$i])+1;
        $c .= chr($letra);
    }
    return $c;
}

function logout(){
    unset($_SESSION['user']);
    unset($_SESSION['nome']);
    unset($_SESSION['tipo']);
}

function login($user,$nome,$tipo){
    $_SESSION['user'] = $user;
    $_SESSION['nome'] = $nome;
    $_SESSION['tipo'] = $tipo;
}

function is_logado(){
    return empty($_SESSION['user'])?false:true;
}

function is_admin(){
    $t = $_SESSION['tipo'];
    if(is_null($t)){
        return false;
    }else{
        return ($t=='admin')?true:false;
    }
}

function is_editor(){
    $t = $_SESSION['tipo'];
    if(is_null($t)){
        return false;
    }else{
        return ($t=='editor')?true:false;
    }
}

?>