# Estrutura de Arquivos Estática (Proposta)

Esta é a estrutura de pastas e arquivos proposta para a organização do frontend da aplicação "Avançar".

## `views/`

A pasta `views` conterá todos os arquivos de apresentação (HTML com PHP), seguindo uma abordagem modular.

```
views/
├── auth/
│   ├── login.php         # Formulário de login
│   └── registo.php       # Formulário de registo
│
├── layouts/
│   ├── app.php           # Estrutura principal (invoca parciais de cabeçalho, rodapé, etc.)
│   └── auth.php          # Layout para as páginas de autenticação
│
├── pages/
│   ├── calendario.php
│   ├── configuracoes.php
│   ├── dashboard.php     # Página inicial
│   ├── dia.php
│   ├── metas.php
│   ├── onboarding.php    # Página/processo de onboarding
│   ├── perfil.php
│   ├── pilares.php
│   ├── planeamento.php
│   ├── progresso.php
│   ├── relatorios.php
│   └── tarefas.php
│
└── partials/
    ├── _cabecalho.php    # Cabeçalho principal da aplicação
    ├── _rodape.php       # Rodapé principal da aplicação
    ├── _menu_lateral.php # Menu de navegação lateral
    ├── _onboarding.php   # Componentes do processo de onboarding
    ├── _modal_pilar.php  # Modal para criar/editar Pilar
    └── _modal_tarefa.php # Modal para criar/editar Tarefa
```

## `resource/`

A pasta `resource` conterá todos os arquivos estáticos (assets) como folhas de estilo, scripts e imagens.

```
resource/
├── css/
│   └── app.css           # Folha de estilos principal
│
├── js/
│   ├── app.js            # Lógica JavaScript principal (navegação, eventos)
│   ├── api.js            # Funções para comunicação com o backend (AJAX)
│   └── pages/
│       └── planeamento.js  # Script específico para a página de planeamento
│
└── images/
    ├── logo.svg
    └── avatars/
        └── default.png
```
