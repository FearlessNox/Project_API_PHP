<?php

namespace generic;

use ReflectionMethod;

class Acao
{

    const POST = "POST";
    const GET = "GET";
    const PUT = "PUT";
    const PATCH = "PATCH";
    const DELETE = "DELETE";

    private $endpoint;
    private $parametrosUrl;

    public function __construct($endpoint = [], $parametrosUrl = [])
    {
       
        $this->endpoint = $endpoint;
        $this->parametrosUrl = $parametrosUrl;
    }

    public function getEndpoint()
    {
        return $this->endpoint;
    }

    public function executar()
    {
        $end = $this->endpointMetodo();
       
        if ($end) {
            $reflectMetodo = new ReflectionMethod($end->classe,$end->execucao);
            $parametros = $reflectMetodo->getParameters();
            $returnParam =$this->getParam();
            if($parametros){
                $para=[];
                //aceita parametros passado no metodo do controller
                foreach($parametros as $v){
                        $name = $v->getName();
                      
                        // Verifica se o parâmetro existe na URL
                        if (isset($this->parametrosUrl[$name])) {
                            $para[$name] = $this->parametrosUrl[$name];
                        }
                        // Se não existe na URL, verifica nos outros métodos
                        else if (isset($returnParam[$name])) {
                            $para[$name] = $returnParam[$name];
                        }
                        // Se o parâmetro é obrigatório e não foi encontrado
                        else if (!$v->isOptional()) {
                            return false;
                        }
                }
                //pegar todos os parametros passado pelo endpoint
              return $reflectMetodo->invokeArgs(new $end->classe(),$para);
                

            }
            return $reflectMetodo->invoke(new $end->classe());
          
            //  $obj = new $end->classe();
        //  return  $obj->{$end->execucao}();
        }
        return null;
    }

    private function endpointMetodo()
    {
        return isset($this->endpoint[$_SERVER["REQUEST_METHOD"]]) ? $this->endpoint[$_SERVER["REQUEST_METHOD"]] : null;
    }

    private function getPost(){
        if($_POST){
            return $_POST;
        }
        return [];
    }
     private function getGet(){
        if($_GET){
            $get = $_GET;
            unset($get["param"]);
            return $get;
        }
        return [];
    }
    private function getInput(){
        $input = file_get_contents("php://input");
         
        if($input){
           
            return json_decode($input,true);
        }
        return [];
    
    }


    public function getParam(){
        return array_merge($this->getPost(),$this->getGet(),$this->getInput());
       
    }

}
