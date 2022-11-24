<?php

$index = $_POST['index'];
$titulo = $_POST['titulo'];
$texto = $_POST['texto'];
$nome  = $_POST['nome'];
$email = $_POST['email'];

$template = file_get_contents('editaPubli.html');

$template = str_replace('{NOME}', $nome, $template);
$template = str_replace('{EMAIL}', $email, $template);
$template = str_replace('{TITULO}', $titulo, $template);
$template = str_replace('{TEXTO}', $texto, $template);

echo $template; 

