<?php
spl_autoload_register(function($class){
    // Converte namespace para caminho do arquivo
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    include $class.".php";
});