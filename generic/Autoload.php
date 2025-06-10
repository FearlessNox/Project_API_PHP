<?php
spl_autoload_register(function($class){
    // Ignora classes do vendor
    if (strpos($class, 'Firebase\\') === 0) {
        return;
    }
    
    // Converte namespace para caminho do arquivo
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    include $class.".php";
});