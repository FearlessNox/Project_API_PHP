# Project API PHP

Este é um projeto de API RESTful desenvolvido em PHP, utilizando uma arquitetura MVC (Model-View-Controller) com padrões de projeto modernos.

## Estrutura do Projeto

```
Project_API_PHP/
├── controller/     # Controladores da aplicação
├── dao/           # Data Access Objects - Camada de acesso a dados
├── generic/       # Classes genéricas e utilitárias
├── service/       # Camada de serviços e regras de negócio
├── template/      # Templates e views
├── public/        # Arquivos públicos (CSS, JS, imagens)
├── index.php      # Ponto de entrada da aplicação
└── .htaccess      # Configuração de URL amigável
```

## Arquitetura da API

### Fluxo de Requisição
```
Cliente HTTP → .htaccess → index.php → Controller → Service → DAO → Banco de Dados
```

### Camadas da Aplicação

1. **Controller (Camada de Apresentação)**
   - Ponto de entrada para requisições HTTP
   - Validação de dados de entrada
   - Direcionamento para serviços apropriados
   - Formatação de respostas
   - Gerenciamento de autenticação/autorização

2. **Service (Camada de Negócio)**
   - Implementação das regras de negócio
   - Coordenação entre diferentes DAOs
   - Validações complexas
   - Processamento de dados
   - Lógica de negócio centralizada

3. **DAO (Camada de Dados)**
   - Abstração do acesso ao banco de dados
   - Operações CRUD (Create, Read, Update, Delete)
   - Queries e transações
   - Mapeamento objeto-relacional

### Componentes Principais

1. **Front Controller (index.php)**
   - Ponto de entrada único da aplicação
   - Roteamento inicial
   - Carregamento de dependências
   - Tratamento de erros global

2. **Autoload (generic/Autoload.php)**
   - Carregamento automático de classes
   - Eliminação de includes manuais
   - Padrão PSR-4

3. **URL Amigável (.htaccess)**
   - Redirecionamento de requisições
   - Configuração de rotas
   - Segurança básica

### Fluxo de Dados

1. **Requisição HTTP**
   ```
   Cliente → .htaccess → index.php?param=endpoint
   ```

2. **Processamento**
   ```
   Controller → Validação → Service → Regras de Negócio → DAO → Banco de Dados
   ```

3. **Resposta**
   ```
   Banco de Dados → DAO → Service → Controller → Cliente (JSON)
   ```

### Características da Arquitetura

1. **Separação de Responsabilidades**
   - Cada camada tem função específica
   - Baixo acoplamento entre componentes
   - Alta coesão dentro das camadas

2. **Segurança**
   - Validação em múltiplas camadas
   - Controle de acesso centralizado
   - Sanitização de dados

3. **Manutenibilidade**
   - Código organizado e modular
   - Fácil de estender
   - Documentação clara

4. **Escalabilidade**
   - Componentes independentes
   - Fácil adição de novas funcionalidades
   - Baixo acoplamento

### Exemplo de Fluxo Completo

1. **Registro de Dados**
   ```
   POST /recurso
   ↓
   Controller valida dados
   ↓
   Service processa regras
   ↓
   DAO persiste dados
   ↓
   Resposta JSON
   ```

2. **Consulta de Dados**
   ```
   GET /recurso/{id}
   ↓
   Controller verifica permissões
   ↓
   Service coordena consultas
   ↓
   DAO busca dados
   ↓
   Resposta JSON formatada
   ```

## Como Funciona

### Arquitetura

O projeto segue uma arquitetura em camadas:

1. **Controller**: Responsável por receber as requisições HTTP e direcioná-las para os serviços apropriados
2. **Service**: Contém a lógica de negócio da aplicação
3. **DAO**: Gerencia o acesso aos dados e interações com o banco de dados
4. **Generic**: Classes utilitárias e base do sistema

### Sistema de Rotas

- O projeto utiliza URL amigável através do arquivo `.htaccess`
- Todas as requisições são redirecionadas para o `index.php`
- O parâmetro `param` na URL determina qual endpoint será acessado

### Autoload

- O sistema utiliza um autoload personalizado para carregar as classes automaticamente
- Localizado em `generic/Autoload.php`

## Requisitos

- PHP 7.0 ou superior
- Servidor Apache com mod_rewrite habilitado
- MySQL/MariaDB (ou outro banco de dados compatível)

## Configuração

1. Clone o repositório
2. Configure seu servidor web para apontar para o diretório do projeto
3. Certifique-se que o mod_rewrite está habilitado no Apache
4. Configure as credenciais do banco de dados (se necessário)

## Uso

Para acessar a API, utilize endpoints no formato:
```
http://seu-dominio/endpoint
```

Exemplo:
```
http://localhost/Project_API_PHP/usuario
```

## Rotas da API

### Sonhos
- `GET /sonho` - Lista todos os sonhos
- `GET /sonho/{id}` - Obtém um sonho específico
- `POST /sonho` - Cria um novo sonho
  - Body: `{ "conteudo": "texto do sonho" }`
- `PUT /sonho/{id}` - Atualiza um sonho existente
  - Body: `{ "conteudo": "novo texto do sonho" }`
- `DELETE /sonho/{id}` - Remove um sonho
- `GET /sonho/{id}/tags` - Lista as tags de um sonho
- `POST /sonho/{id}/tag` - Adiciona uma tag ao sonho
  - Body: `{ "tag_id": 1 }`
- `DELETE /sonho/{id}/tag` - Remove uma tag do sonho
  - Body: `{ "tag_id": 1 }`

### Tags
- `GET /tag` - Lista todas as tags
- `GET /tag/{id}` - Obtém uma tag específica
- `POST /tag` - Cria uma nova tag
  - Body: `{ "nome": "nome da tag" }`
- `PUT /tag/{id}` - Atualiza uma tag existente
  - Body: `{ "nome": "novo nome da tag" }`
- `DELETE /tag/{id}` - Remove uma tag

### Interpretações
- `GET /interpretacao` - Lista todas as interpretações
- `GET /interpretacao/{id}` - Obtém uma interpretação específica
- `GET /interpretacao/sonho/{id}` - Lista interpretações de um sonho específico
- `POST /interpretacao` - Cria uma nova interpretação
  - Body: `{ "sonho_id": 1, "interpretador": "nome", "texto": "interpretação" }`
- `PUT /interpretacao/{id}` - Atualiza uma interpretação existente
  - Body: `{ "interpretador": "nome", "texto": "nova interpretação" }`
- `DELETE /interpretacao/{id}` - Remove uma interpretação

## Segurança

- O sistema implementa verificação de endpoints públicos/privados
- Autenticação e autorização são gerenciadas através do controlador principal
