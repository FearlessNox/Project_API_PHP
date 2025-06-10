<?php
namespace service;

use dao\mysql\SonhoDAO;

class SonhoService {
    private $dao;

    public function __construct() {
        $this->dao = new SonhoDAO();
    }

    public function listar() {
        try {
            $resultado = $this->dao->listar();
            return empty($resultado) ? [] : $resultado;
        } catch (\Exception $e) {
            throw new \Exception("Erro ao listar sonhos: " . $e->getMessage());
        }
    }

    public function listarId($id) {
        try {
            if (!is_numeric($id) || $id <= 0) {
                throw new \Exception("ID invalido");
            }

            $resultado = $this->dao->listarId($id);
            return empty($resultado) ? null : $resultado[0];
        } catch (\Exception $e) {
            throw new \Exception("Erro ao buscar sonho: " . $e->getMessage());
        }
    }

    public function inserir($conteudo) {
        try {
            if (empty($conteudo)) {
                throw new \Exception("Conteudo do sonho nao pode ser vazio");
            }

            if (strlen($conteudo) > 1000) {
                throw new \Exception("Conteudo do sonho excede o limite de 1000 caracteres");
            }

            $resultado = $this->dao->inserir($conteudo);
            return empty($resultado) ? null : $resultado;
        } catch (\Exception $e) {
            throw new \Exception("Erro ao inserir sonho: " . $e->getMessage());
        }
    }

    public function alterar($id, $conteudo) {
        try {
            if (!is_numeric($id) || $id <= 0) {
                throw new \Exception("ID invalido");
            }

            if (empty($conteudo)) {
                throw new \Exception("Conteudo do sonho nao pode ser vazio");
            }

            if (strlen($conteudo) > 1000) {
                throw new \Exception("Conteudo do sonho excede o limite de 1000 caracteres");
            }

            // Verifica se o sonho existe antes de tentar alterar
            $sonho = $this->listarId($id);
            if (!$sonho) {
                throw new \Exception("Sonho nao encontrado");
            }

            $resultado = $this->dao->alterar($id, $conteudo);
            return empty($resultado) ? null : $resultado;
        } catch (\Exception $e) {
            throw new \Exception("Erro ao alterar sonho: " . $e->getMessage());
        }
    }

    public function excluir($id) {
        try {
            if (!is_numeric($id) || $id <= 0) {
                throw new \Exception("ID invalido");
            }

            // Verifica se o sonho existe antes de tentar excluir
            $sonho = $this->listarId($id);
            if (!$sonho) {
                throw new \Exception("Sonho nao encontrado");
            }

            $resultado = $this->dao->excluir($id);
            return empty($resultado) ? null : $resultado;
        } catch (\Exception $e) {
            throw new \Exception("Erro ao excluir sonho: " . $e->getMessage());
        }
    }

    public function adicionarTag($sonho_id, $tag_id) {
        try {
            if (!is_numeric($sonho_id) || $sonho_id <= 0) {
                throw new \Exception("ID do sonho invalido");
            }

            if (!is_numeric($tag_id) || $tag_id <= 0) {
                throw new \Exception("ID da tag invalido");
            }

            // Verifica se o sonho existe
            $sonho = $this->listarId($sonho_id);
            if (!$sonho) {
                throw new \Exception("Sonho nao encontrado");
            }

            $resultado = $this->dao->adicionarTag($sonho_id, $tag_id);
            return empty($resultado) ? null : $resultado;
        } catch (\Exception $e) {
            throw new \Exception("Erro ao adicionar tag: " . $e->getMessage());
        }
    }

    public function removerTag($sonho_id, $tag_id) {
        try {
            if (!is_numeric($sonho_id) || $sonho_id <= 0) {
                throw new \Exception("ID do sonho invalido");
            }

            if (!is_numeric($tag_id) || $tag_id <= 0) {
                throw new \Exception("ID da tag invalido");
            }

            // Verifica se o sonho existe
            $sonho = $this->listarId($sonho_id);
            if (!$sonho) {
                throw new \Exception("Sonho nao encontrado");
            }

            $resultado = $this->dao->removerTag($sonho_id, $tag_id);
            return empty($resultado) ? null : $resultado;
        } catch (\Exception $e) {
            throw new \Exception("Erro ao remover tag: " . $e->getMessage());
        }
    }

    public function listarTags($sonho_id) {
        try {
            if (!is_numeric($sonho_id) || $sonho_id <= 0) {
                throw new \Exception("ID do sonho invalido");
            }

            // Verifica se o sonho existe
            $sonho = $this->listarId($sonho_id);
            if (!$sonho) {
                throw new \Exception("Sonho nao encontrado");
            }

            $resultado = $this->dao->listarTags($sonho_id);
            return empty($resultado) ? [] : $resultado;
        } catch (\Exception $e) {
            throw new \Exception("Erro ao listar tags: " . $e->getMessage());
        }
    }

    public function listarInterpretacoes($sonho_id) {
        try {
            if (!is_numeric($sonho_id) || $sonho_id <= 0) {
                throw new \Exception("ID do sonho invalido");
            }

            // Verifica se o sonho existe
            $sonho = $this->listarId($sonho_id);
            if (!$sonho) {
                throw new \Exception("Sonho nao encontrado");
            }

            $resultado = $this->dao->listarInterpretacoes($sonho_id);
            return empty($resultado) ? [] : $resultado;
        } catch (\Exception $e) {
            throw new \Exception("Erro ao listar interpretacoes: " . $e->getMessage());
        }
    }
} 