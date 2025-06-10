<?php
// Removendo a dependência do Composer
// require_once __DIR__ . '/vendor/autoload.php';
include "generic/Autoload.php";
include "lib/JWT.php";

use generic\Controller;

// Log para debug
error_log("Requisição recebida: " . $_SERVER['REQUEST_URI']);
error_log("Método: " . $_SERVER['REQUEST_METHOD']);

// entrada de dados
//verifica se o parametro do endpoint existe
if (isset($_GET["param"])) {
    error_log("Parâmetro recebido: " . $_GET["param"]);
    $controller = new Controller();
    //chamada para verificar se o endpoint está público
    $controller->verificarChamadas($_GET["param"]);
} else {
    error_log("Nenhum parâmetro recebido");
}