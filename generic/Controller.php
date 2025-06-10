<?php

namespace generic;

class Controller
{
    private $rotas = null;
    private $publicRoutes = ['login', 'register'];

    public function __construct()
    {
        $this->rotas = new Rotas();
    }

    public function verificarChamadas($rota)
    {
        // Check if the route is public
        if (!in_array($rota, $this->publicRoutes)) {
            // Validate token for protected routes
            AuthMiddleware::validateToken();
        }

        $retorno = $this->rotas->executar($rota);
        //se existe um retorno irá devolver em formato json
        if ($retorno) {
            header("Content-Type: application/json");
            $json = json_encode($retorno);
            echo $json;
        }
    }

    protected function getDados()
    {
        $dados = file_get_contents("php://input");
        return json_decode($dados);
    }

    protected function retornar($dados, $status = 200)
    {
        http_response_code($status);
        header("Content-Type: application/json");
        echo json_encode($dados);
        exit;
    }
}
