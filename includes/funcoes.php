<?php

function thumb($arq) {
    $caminho = "fotos/$arq";
    if(is_null($arq) || !file_exists($caminho)){
        return "fotos/indisonivel.png";
    }else{
        return $caminho;
    }
}


?>