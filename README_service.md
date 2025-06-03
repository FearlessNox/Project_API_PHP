# Camada de Serviço da API

A camada de serviço (Service) é o coração da API, responsável por implementar toda a lógica de negócio e coordenação entre os diferentes componentes do sistema.

## Estrutura do Service

```
service/
├── SonhoService.php      # Serviços relacionados a sonhos
├── TagService.php        # Serviços relacionados a tags
└── InterpretacaoService.php  # Serviços relacionados a interpretações
```

## Funcionamento dos Serviços

### SonhoService.php
Responsável por gerenciar todas as operações relacionadas a sonhos.

#### Funcionalidades Principais:
1. **Gerenciamento de Sonhos**
   - Criação de novos sonhos
   - Atualização de sonhos existentes
   - Exclusão de sonhos
   - Listagem de sonhos
   - Busca de sonho por ID

2. **Associação com Tags**
   - Adição de tags a sonhos
   - Remoção de tags de sonhos
   - Listagem de tags de um sonho

3. **Validações Específicas**
   - Verificação de conteúdo obrigatório
   - Validação de datas
   - Verificação de existência de sonho

### TagService.php
Gerencia todas as operações relacionadas às tags do sistema.

#### Funcionalidades Principais:
1. **Gerenciamento de Tags**
   - Criação de novas tags
   - Atualização de tags existentes
   - Exclusão de tags
   - Listagem de todas as tags
   - Busca de tag por ID

2. **Validações Específicas**
   - Verificação de nome único
   - Validação de formato
   - Verificação de uso em sonhos

3. **Operações de Associação**
   - Verificação de associações existentes
   - Gerenciamento de relacionamentos
   - Limpeza de associações

### InterpretacaoService.php
Controla todas as operações relacionadas às interpretações de sonhos.

#### Funcionalidades Principais:
1. **Gerenciamento de Interpretações**
   - Criação de novas interpretações
   - Atualização de interpretações
   - Exclusão de interpretações
   - Listagem de interpretações
   - Busca por ID

2. **Relacionamentos**
   - Vinculação com sonhos
   - Busca de interpretações por sonho
   - Gerenciamento de múltiplas interpretações

3. **Validações Específicas**
   - Verificação de campos obrigatórios
   - Validação de interpretador
   - Verificação de sonho existente

## Exemplos de Implementação por Serviço

### SonhoService
```php
class SonhoService {
    // Operações CRUD básicas
    public function inserir($conteudo) { ... }
    public function alterar($id, $conteudo) { ... }
    public function excluir($id) { ... }
    public function listar() { ... }
    public function listarId($id) { ... }
    
    // Operações com tags
    public function listarTags($id) { ... }
    public function adicionarTag($id, $tagId) { ... }
    public function removerTag($id, $tagId) { ... }
}
```

### TagService
```php
class TagService {
    // Operações CRUD básicas
    public function inserir($nome) { ... }
    public function alterar($id, $nome) { ... }
    public function excluir($id) { ... }
    public function listar() { ... }
    public function listarId($id) { ... }
    
    // Operações de validação
    public function validarNome($nome) { ... }
    public function verificarUso($id) { ... }
}
```

### InterpretacaoService
```php
class InterpretacaoService {
    // Operações CRUD básicas
    public function inserir($sonhoId, $interpretador, $texto) { ... }
    public function alterar($id, $interpretador, $texto) { ... }
    public function excluir($id) { ... }
    public function listar() { ... }
    public function listarId($id) { ... }
    
    // Operações específicas
    public function listarPorSonho($sonhoId) { ... }
    public function validarInterpretador($interpretador) { ... }
}
```

## Fluxo de Dados entre Serviços

### Exemplo: Criação de Sonho com Tags e Interpretação
```
SonhoService
  ↓
  ├─ Cria sonho
  ↓
  ├─ TagService
  │   ↓
  │   ├─ Valida tags
  │   ↓
  │   └─ Associa tags
  ↓
  └─ InterpretacaoService
      ↓
      ├─ Valida interpretação
      ↓
      └─ Cria interpretação
```

### Exemplo: Busca Completa de Sonho
```
SonhoService
  ↓
  ├─ Busca dados do sonho
  ↓
  ├─ TagService
  │   ↓
  │   └─ Busca tags associadas
  ↓
  └─ InterpretacaoService
      ↓
      └─ Busca interpretações
```

## Responsabilidades Principais

### 1. Lógica de Negócio
- Implementação das regras de negócio
- Validações complexas
- Processamento de dados
- Coordenação entre diferentes DAOs

### 2. Validações
- Validação de dados de entrada
- Verificação de regras de negócio
- Tratamento de exceções
- Retorno de mensagens de erro apropriadas

### 3. Coordenação
- Orquestração de operações entre DAOs
- Gerenciamento de transações
- Controle de fluxo de dados

## Exemplos de Implementação

### SonhoService

```php
class SonhoService {
    private $dao;
    
    public function __construct() {
        $this->dao = new SonhoDAO();
    }
    
    // Listar todos os sonhos
    public function listar() {
        return $this->dao->listar();
    }
    
    // Buscar sonho por ID
    public function listarId($id) {
        return $this->dao->listarId($id);
    }
    
    // Inserir novo sonho
    public function inserir($conteudo) {
        // Validações de negócio
        if (empty($conteudo)) {
            throw new Exception("Conteúdo do sonho é obrigatório");
        }
        
        // Processamento de dados
        $sonho = [
            'conteudo' => $conteudo,
            'data_criacao' => date('Y-m-d H:i:s')
        ];
        
        return $this->dao->inserir($sonho);
    }
}
```

### TagService

```php
class TagService {
    private $dao;
    
    public function __construct() {
        $this->dao = new TagDAO();
    }
    
    // Associar tag a um sonho
    public function associarTag($sonhoId, $tagId) {
        // Validações
        if (!$this->dao->existeSonho($sonhoId)) {
            throw new Exception("Sonho não encontrado");
        }
        if (!$this->dao->existeTag($tagId)) {
            throw new Exception("Tag não encontrada");
        }
        
        // Verificar se já existe associação
        if ($this->dao->tagAssociada($sonhoId, $tagId)) {
            throw new Exception("Tag já associada ao sonho");
        }
        
        return $this->dao->associarTag($sonhoId, $tagId);
    }
}
```

## Fluxo de Processamento

### 1. Recebimento de Dados
```
Controller → Service
↓
Validação de Dados
↓
Processamento
↓
DAO
```

### 2. Validações
- Dados obrigatórios
- Formato dos dados
- Regras de negócio
- Permissões e acessos

### 3. Processamento
- Transformação de dados
- Aplicação de regras
- Coordenação de operações
- Tratamento de erros

## Boas Práticas

### 1. Tratamento de Erros
```php
try {
    // Operação do serviço
} catch (Exception $e) {
    // Log do erro
    // Retorno apropriado
    return [
        'erro' => true,
        'mensagem' => $e->getMessage()
    ];
}
```

### 2. Validações
```php
private function validarDados($dados) {
    if (empty($dados->campo)) {
        throw new Exception("Campo obrigatório");
    }
    // Outras validações
}
```

### 3. Transações
```php
public function operacaoComplexa() {
    try {
        $this->dao->iniciarTransacao();
        
        // Operações
        
        $this->dao->commit();
    } catch (Exception $e) {
        $this->dao->rollback();
        throw $e;
    }
}
```

## Integração com Outras Camadas

### 1. Controller → Service
- Recebe requisições do controller
- Valida dados de entrada
- Processa regras de negócio
- Retorna resultados

### 2. Service → DAO
- Coordena operações no banco
- Gerencia transações
- Trata erros de banco

## Exemplos de Uso

### 1. Criação de Sonho com Tags
```php
public function criarSonhoComTags($conteudo, $tags) {
    // Validações
    $this->validarSonho($conteudo);
    $this->validarTags($tags);
    
    // Iniciar transação
    $this->dao->iniciarTransacao();
    
    try {
        // Criar sonho
        $sonhoId = $this->inserir($conteudo);
        
        // Associar tags
        foreach ($tags as $tag) {
            $this->associarTag($sonhoId, $tag);
        }
        
        $this->dao->commit();
        return $sonhoId;
    } catch (Exception $e) {
        $this->dao->rollback();
        throw $e;
    }
}
```

### 2. Busca com Relacionamentos
```php
public function buscarSonhoComInterpretacoes($id) {
    // Buscar sonho
    $sonho = $this->listarId($id);
    
    if (!$sonho) {
        throw new Exception("Sonho não encontrado");
    }
    
    // Buscar interpretações
    $interpretacoes = $this->dao->buscarInterpretacoes($id);
    
    // Montar resposta
    return [
        'sonho' => $sonho,
        'interpretacoes' => $interpretacoes
    ];
}
```

## Considerações de Segurança

1. **Validação de Dados**
   - Sanitização de entrada
   - Validação de tipos
   - Verificação de permissões

2. **Transações**
   - Atomicidade
   - Consistência
   - Isolamento
   - Durabilidade

3. **Logging**
   - Registro de operações
   - Rastreamento de erros
   - Auditoria

Esta camada de serviço é fundamental para garantir a integridade e consistência dos dados, além de implementar todas as regras de negócio necessárias para o funcionamento correto da API. 