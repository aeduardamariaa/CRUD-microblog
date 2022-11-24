<?php 

$index = $_POST['index'];
$titulo = $_POST['titulo'];
$texto = $_POST['texto'];
$nome  = $_POST['nome'];
$email = $_POST['email'];

if ($index >= 0) { 

$cadastro = file('login.csv');

for ($i=0; $i < count($cadastro) ; $i++) { 
    if (intval($index) === $i) {
        $novaAtualiza = $nome . ';' . $email . ';' . $titulo . ';' . $texto . PHP_EOL;
        $cadastro[$i] = $novaAtualiza;
        break;
    }
}

//atualizando o arquivo
$atualizado = '';
for ($i=0; $i <= count($cadastro) ; $i++) {
    if (isset($cadastro[$i])) {
        $atualizado .= $cadastro[$i];
    }  
}
file_put_contents('login.csv', $atualizado);

//copa

$template       = file_get_contents('pagina-logada.html');
$templateLinha  = file_get_contents('templateGERAL.html');

$cadastro = file('login.csv');
$linhas   = '';

for ($i=0; $i < count($cadastro) ; $i++) { 
    $dadosArquivo = explode(';', $cadastro[$i]);
    //foi  
    
    if (isset($dadosArquivo[0]) and isset($dadosArquivo[1]) and isset($dadosArquivo[2]) and isset($dadosArquivo[3])) {
        if ($email === $dadosArquivo[1]) {
        $nome = $dadosArquivo[0]; 
        $email = $dadosArquivo[1]; 
        $titulo = $dadosArquivo[2]; 
        $texto = $dadosArquivo[3];    

    } else { continue;
    }
    
  
}else{
    continue;
}
$linha   = $templateLinha;
$linha   = str_replace('{NOME}', $nome, $linha);
$linha   = str_replace('{EMAIL}', $email, $linha);
$linha   = str_replace('{TITULO}', $titulo, $linha);
$linha   = str_replace('{TEXTO}', $texto, $linha);
$linha   = str_replace('{INDEX}', $i, $linha);

$linhas .= $linha; 

}
$template = str_replace('{PUBLI}', $linhas, $template);
echo $template;

}



