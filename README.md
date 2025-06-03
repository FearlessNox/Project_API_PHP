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

## Segurança

- O sistema implementa verificação de endpoints públicos/privados
- Autenticação e autorização são gerenciadas através do controlador principal
