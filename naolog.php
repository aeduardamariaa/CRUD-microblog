<?php

$titulo = $_POST['titulo'];
$texto = $_POST['texto'];
$nome  = $_POST['nome'];
$email = $_POST['email'];


$linha = $nome . ';' . $email . ';' . $titulo .  ';' . $texto . PHP_EOL;

file_put_contents('login.csv', $linha, FILE_APPEND);


 $cadastro = file('login.csv');

$template       = file_get_contents('pagina-logada.html');
$templateLinha  = file_get_contents('templateGERAL.html');

$linhas   = '';

for ($i=0; $i < count($cadastro) ; $i++) { 
    $dadosArquivo = explode(';', $cadastro[$i]);
    //foi  
    if ($email === $dadosArquivo[1]) {
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
    }else{
        continue;
    }
    
}


$template = str_replace('{PUBLI}', $linhas, $template);
echo $template;

