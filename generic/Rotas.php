<?php

namespace generic;

class Rotas
{
    private $endpoints = [];

    public function __construct()
    {
        // rotas para o acesso as chamadas
        $this->endpoints = [
            "sonhos" => new Acao([
                Acao::GET => new Endpoint("Sonho", "listar"),
                Acao::POST => new Endpoint("Sonho", "inserir")
            ]),
            "sonhos/{id}" => new Acao([
                Acao::GET => new Endpoint("Sonho", "listarId"),
                Acao::PUT => new Endpoint("Sonho", "alterar"),
                Acao::DELETE => new Endpoint("Sonho", "excluir")
            ]),
            "sonhos/{id}/tags" => new Acao([
                Acao::GET => new Endpoint("Sonho", "listarTags"),
                Acao::POST => new Endpoint("Sonho", "adicionarTag"),
                Acao::DELETE => new Endpoint("Sonho", "removerTag")
            ]),
            "tags" => new Acao([
                Acao::GET => new Endpoint("Tag", "listar"),
                Acao::POST => new Endpoint("Tag", "inserir")
            ]),
            "tags/{id}" => new Acao([
                Acao::GET => new Endpoint("Tag", "listarId"),
                Acao::PUT => new Endpoint("Tag", "alterar"),
                Acao::DELETE => new Endpoint("Tag", "excluir")
            ]),
            "interpretacoes" => new Acao([
                Acao::GET => new Endpoint("Interpretacao", "listar"),
                Acao::POST => new Endpoint("Interpretacao", "inserir")
            ]),
            "interpretacoes/{id}" => new Acao([
                Acao::GET => new Endpoint("Interpretacao", "listarId"),
                Acao::PUT => new Endpoint("Interpretacao", "alterar"),
                Acao::DELETE => new Endpoint("Interpretacao", "excluir")
            ]),
            "sonhos/{id}/interpretacoes" => new Acao([
                Acao::GET => new Endpoint("Interpretacao", "listarPorSonho")
            ])
        ];
    }

    public function executar($rota)
    {
        // Procura por parâmetros na rota
        foreach ($this->endpoints as $pattern => $acao) {
            $pattern = str_replace('/', '\/', $pattern);
            $pattern = preg_replace('/\{([a-zA-Z]+)\}/', '(?P<$1>[^\/]+)', $pattern);
            $pattern = '/^' . $pattern . '$/';

            if (preg_match($pattern, $rota, $matches)) {
                // Remove o parâmetro 'param' que vem do .htaccess
                unset($matches[0]);
                
                // Cria um array associativo com os parâmetros
                $parametros = [];
                foreach ($matches as $key => $value) {
                    if (is_string($key)) {
                        $parametros[$key] = $value;
                    }
                }

                // Cria uma nova instância de Acao com os parâmetros
                $novaAcao = new Acao($acao->getEndpoint(), $parametros);
                $dados = $novaAcao->executar();
                
                if ($dados !== false) {
                    $retorno = new Retorno();
                    $retorno->dados = $dados;
                    return $retorno;
                }
            }
        }

        return null;
    }
}
