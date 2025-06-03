<?php

namespace controller;

use service\ClienteService;
use template\ClienteTemp;
use template\ITemplate;

class Cliente
{
    private ITemplate $template;
    public function __construct()
    {
        $this->template = new ClienteTemp();
    }

    public function listar()
    {
        $service = new ClienteService();
        $resultado = $service->listarCliente();
        return $resultado;
    }

    public function inserir($nome, $endereco)
    {

        $service = new ClienteService();
        $resultado = $service->inserir($nome, $endereco);
        return $resultado;
    }

    public function formulario()
    {

        $this->template->layout("\\public\\cliente\\form.php");
    }
    public function alterarForm()
    {
        $id = $_GET["id"];
        $service = new ClienteService();
        $resultado = $service->listarId($id);

        $this->template->layout("\\public\\cliente\\form.php", $resultado);
    }

    public function teste($nome, $telefone)
    {
        return "$nome,$telefone";
    }
    public function teste2() {}
}
