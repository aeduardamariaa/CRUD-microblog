<?php

$template       = file_get_contents('geral.html');
$templateLinha  = file_get_contents('templatePubli.html');


$cadastro = file('login.csv');
$linhas   = '';

for ($i=0; $i < count($cadastro) ; $i++) { 
    $dadosArquivo = explode(';', $cadastro[$i]);
     
    $nome  = $dadosArquivo[0];
    $email = $dadosArquivo[1]; 
    $titulo = $dadosArquivo[2]; 
    $texto = $dadosArquivo[3]; 

    $linha   = $templateLinha;
    $linha   = str_replace('{NOME}', $nome, $linha);
    $linha   = str_replace('{EMAIL}', $email, $linha);
    $linha   = str_replace('{TITULO}', $titulo, $linha);
    $linha   = str_replace('{TEXTO}', $texto, $linha);

    $linhas .= $linha;
}

$template = str_replace('{LINHAS}', $linhas, $template);

echo $template;