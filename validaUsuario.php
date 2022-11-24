<?php

$nome  = $_POST['nome'];
$email = $_POST['email'];



$template       = file_get_contents('pagina-logada.html');
$templateLinha  = file_get_contents('templateGERAL.html');

$cadastro = file('login.csv');
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

$template = str_replace('{LINHAS}', $linhas, $template);

$cadastro = file('login.csv');
 
for ($i=0; $i < count($cadastro) ; $i++) { 
    $dadosArquivo = explode(';', $cadastro[$i] );

    
    if ($email === $dadosArquivo[1]) {
        $template = file_get_contents('pagina-logada.html');
        $template = str_replace('{LOGADO}', 'true', $template);
        break;
    } else {
        $template = file_get_contents('pagina-nao-logada.html');
    }

}

$template = str_replace('{PUBLI}', $linhas, $template);
echo $template;











