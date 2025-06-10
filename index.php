<?php
// Removendo a dependência do Composer
// require_once __DIR__ . '/vendor/autoload.php';
include "generic/Autoload.php";
include "lib/JWT.php";

use generic\Controller;
// entrada de dados
//verifica se o parametro do endpoint existe
if (isset($_GET["param"])) {
    $controller = new Controller();
    //chamada para verificar se o endpoint está público
    $controller->verificarChamadas($_GET["param"]);
}