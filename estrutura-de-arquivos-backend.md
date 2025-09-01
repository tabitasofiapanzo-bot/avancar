# Estrutura de Arquivos do Backend (Proposta)

Esta é a estrutura de pastas e arquivos proposta para a organização do backend da aplicação "Avançar", seguindo um padrão MVC-like com nomenclatura em português.

## `config/`

A pasta `config` armazena os arquivos de configuração da aplicação.

```
config/
├── app.php             # Configurações gerais (URL base, ambiente, fuso horário)
├── conexao.php         # Credenciais de acesso à base de dados
└── rotas.php           # Definição das rotas da aplicação (URL -> Controlador@método)
```

## `core/`

O núcleo da aplicação, contendo as classes fundamentais que gerem o fluxo de dados e a lógica principal.

```
core/
├── App.php             # Ponto de entrada que inicializa a aplicação e o roteador
├── Controlador.php     # Classe base para os controladores, com métodos auxiliares
├── Conexao.php         # Classe para gerir a conexão com a base de dados (PDO Singleton)
├── Modelo.php          # Classe base para os modelos, com métodos CRUD genéricos
├── Requisicao.php      # Classe para encapsular e sanitizar os dados da requisição HTTP
├── Resposta.php        # Classe para gerir as respostas (renderizar views, JSON, etc.)
└── Roteador.php        # Responsável por mapear as URLs às acções dos controladores
```

## `models/`

Contém as classes que representam as entidades de negócio e a lógica de interacção com a base de dados.

```
models/
├── Categoria.php       # Modelo para gerir as categorias dos pilares
├── Meta.php            # Modelo para gerir metas e micro-metas
├── Pilar.php           # Modelo para gerir os pilares da vida
├── Tarefa.php          # Modelo para gerir as tarefas diárias
└── Usuario.php         # Modelo para gerir utilizadores e autenticação
```

## `controllers/`

Os controladores actuam como intermediários, recebendo requisições, interagindo com os modelos e seleccionando a view a ser renderizada.

```
controllers/
├── AuthController.php      # Controla o processo de login, registo e logout
├── DashboardController.php # Controla a exibição da página principal/dashboard
├── PilaresController.php   # Lógica CRUD para os Pilares
├── MetasController.php     # Lógica CRUD para as Metas
└── TarefasController.php   # Lógica CRUD para as Tarefas
```
