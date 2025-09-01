### Fase 1: Estruturação do Frontend Estático

O objectivo desta fase é desmembrar o ficheiro `Protótipo.html` e organizar todo o seu conteúdo (HTML, CSS, JS) na estrutura de pastas `views/` e `resource/`, sem alterar o código original.

1.  **Extrair Assets Estáticos:**
    *   **CSS:** Copiar todo o código da tag `<style>` para o ficheiro `resource/css/app.css`.
    *   **JavaScript:** Copiar todo o código da tag `<script>` para o ficheiro `resource/js/app.js`.

2.  **Montar o Layout Principal:**
    *   Criar `views/layouts/app.php`.
    *   Mover a estrutura base do HTML (de `<!DOCTYPE html>` até `</html>`) do protótipo para este ficheiro.
    *   Substituir as tags `<style>` e `<script>` internas por links para os ficheiros `app.css` e `app.js`.
    *   Definir locais para inclusão de `partials` e do conteúdo principal da página.

3.  **Desmembrar Componentes Reutilizáveis (Partials):**
    *   Criar `views/partials/menu-lateral.php` com o código do `<nav class="menu-lateral">`.
    *   Criar `views/partials/cabecalho.php` com o código do `<header class="cabecalho">`.
    *   Criar `views/partials/rodape.php` com o código do `<footer class="rodape">`.

4.  **Criar as Páginas (Views):**
    *   Para cada secção do protótipo (Dashboard, Pilares, Metas, etc.), criar um ficheiro correspondente em `views/pages/`.
    *   Exemplo: Criar `views/pages/pilares.php` e copiar para lá o bloco de HTML `<div id="pilares">...</div>`.
    *   Repetir o processo para todas as outras páginas (ver na C:\wamp64\www\avancar\.info\estrutura-de-arquivos-estatica.md).

### Fase 2: Desenho da Base de Dados

Com o frontend estático estruturado, o foco passa a ser a modelação dos dados que a aplicação irá manipular.

1.  **Identificar Entidades:** Analisar a interface e identificar as entidades principais (ex: `Usuario`, `Pilar`, `Meta`, `Tarefa`).
2.  **Definir Estrutura:** Para cada entidade, definir as tabelas, colunas, tipos de dados, chaves primárias, chaves estrangeiras e índices necessários.
3.  **Documentar o Esquema:** Criar o ficheiro `docs/esquema-banco-de-dados.md` e documentar a estrutura completa do banco de dados de forma clara.
4.  **Criar Script SQL:** Desenvolver o ficheiro `docs/avancar.sql` com os comandos `CREATE TABLE` para construir a base de dados. Opcionalmente, adicionar comandos `INSERT` para popular o banco com dados iniciais de teste. lembrando que todas as tabelas deve estar no sigular e em portugues

### Fase 3: Desenvolvimento do Backend (Arquitectura MVC)

Nesta fase, construiremos o cérebro da aplicação, conectando o frontend à base de dados e adicionando a lógica de negócio.

1.  **Configurar o Ponto de Entrada:**
    *   Criar o ficheiro `public/index.php`, front controller.
    *   Este ficheiro irá inicializar a aplicação, carregar configurações e accionar o sistema de roteamento.

2.  **Desenvolver o Core da Aplicação:**
    *   Ver em `docs/estrutura-de-arquivos-backend.md` para mais detalhes.
 
3.  **Criar os Modelos (Models):**
    *   Para cada tabela da base de dados, criar uma classe `Model` correspondente (ex: `models/Pilar.php`, `models/Meta.php`).
    *   Implementar os métodos para realizar as operações de CRUD na respectiva tabela.

4.  **Criar os Controladores (Controllers):**
    *   Para cada secção principal da aplicação, criar uma classe `Controller` (ex: `controllers/PilaresController.php`).
    *   Implementar os métodos que recebem as requisições do utilizador, interagem com os `Modelos` para buscar ou manipular dados, e finalmente, carregam a `View` apropriada, passando os dados necessários.

5.  **Dinamizar as Views:**
    *   Substituir o conteúdo estático nos ficheiros de `views/pages/` por código PHP.
    *   Utilizar os dados passados pelos `Controladores` para exibir informações dinâmicas (ex: listar pilares a partir da base de dados em vez de ter HTML fixo).
    *   Implementar a lógica para submissão de formulários e interacções dinâmicas.