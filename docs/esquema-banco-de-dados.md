# Esquema do Banco de Dados - Avançar

Este documento descreve a estrutura do banco de dados para a aplicação "Avançar". O modelo de dados separa "templates" de dados (compartilhados) e "instâncias" de dados (específicas do usuário).

---

## Tabela: `usuario`
Armazena as informações dos usuários da aplicação.

| Coluna | Tipo | Restrições | Descrição |
|---|---|---|---|
| `id` | INT | PRIMARY KEY, AUTO_INCREMENT | Identificador único do usuário. |
| `nome` | VARCHAR(100) | NOT NULL | Nome completo do usuário. |
| `email` | VARCHAR(255) | NOT NULL, UNIQUE | Endereço de email do usuário (usado para login). |
| `senha` | VARCHAR(255) | NOT NULL | Senha do usuário (armazenada como hash). |
| `onboarding_concluido` | BOOLEAN | NOT NULL DEFAULT FALSE | Indica se o usuário completou o processo de onboarding. |
| `criado_em` | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP | Data e hora de criação do registro. |

---

## Tabela: `pilar_template`
Armazena os modelos de pilares disponíveis no sistema (dados globais).

| Coluna | Tipo | Restrições | Descrição |
|---|---|---|---|
| `id` | INT | PRIMARY KEY, AUTO_INCREMENT | Identificador único do template do pilar. |
| `nome` | VARCHAR(50) | NOT NULL, UNIQUE | Nome do pilar (ex: Saúde, Carreira). |
| `descricao` | TEXT | | Descrição padrão do pilar. |
| `cor` | VARCHAR(7) | NOT NULL DEFAULT '#ffffff' | Cor hexadecimal padrão para o pilar. |
| `obrigatorio`| BOOLEAN | NOT NULL DEFAULT FALSE | Se o pilar é obrigatório para todos os novos usuários. |
| `is_basico` | BOOLEAN | NOT NULL DEFAULT FALSE | Identifica o pilar "Global/Básico" para lógicas especiais. |

---

## Tabela: `pilar_usuario`
Associa um usuário a um pilar, criando uma instância pessoal daquele pilar.

| Coluna | Tipo | Restrições | Descrição |
|---|---|---|---|
| `id` | INT | PRIMARY KEY, AUTO_INCREMENT | Identificador único da instância do pilar do usuário. |
| `usuario_id` | INT | NOT NULL, FOREIGN KEY (`usuario`.`id`) | Chave estrangeira para a tabela `usuario`. |
| `pilar_template_id` | INT | NOT NULL, FOREIGN KEY (`pilar_template`.`id`) | Chave estrangeira para a tabela `pilar_template`. |

---

## Tabela: `categoria`
Armazena as categorias que um usuário cria dentro de uma de suas instâncias de pilar.

| Coluna | Tipo | Restrições | Descrição |
|---|---|---|---|
| `id` | INT | PRIMARY KEY, AUTO_INCREMENT | Identificador único da categoria. |
| `pilar_usuario_id` | INT | NOT NULL, FOREIGN KEY (`pilar_usuario`.`id`) | Chave estrangeira para a instância do pilar do usuário. |
| `nome` | VARCHAR(50) | NOT NULL | Nome da categoria (ex: Exercício Físico). |

---

## Tabela: `subcategoria`
Armazena as subcategorias (opcionais) dentro de cada categoria.

| Coluna | Tipo | Restrições | Descrição |
|---|---|---|---|
| `id` | INT | PRIMARY KEY, AUTO_INCREMENT | Identificador único da subcategoria. |
| `categoria_id` | INT | NOT NULL, FOREIGN KEY (`categoria`.`id`) | Chave estrangeira para a tabela `categoria`. |
| `nome` | VARCHAR(50) | NOT NULL | Nome da subcategoria (ex: Corrida, Musculação). |

---

## Tabela: `meta`
Armazena as metas de longo prazo, associadas a uma categoria de um usuário.

| Coluna | Tipo | Restrições | Descrição |
|---|---|---|---|
| `id` | INT | PRIMARY KEY, AUTO_INCREMENT | Identificador único da meta. |
| `categoria_id` | INT | NOT NULL, FOREIGN KEY (`categoria`.`id`) | Chave estrangeira para a tabela `categoria`. |
| `nome` | VARCHAR(255) | NOT NULL | Descrição da meta (ex: Correr 5km sem parar). |
| `data_inicio` | DATE | NOT NULL | Data de início para alcançar a meta. |
| `data_fim` | DATE | NOT NULL | Prazo final para a meta. |

---

## Tabela: `micrometa`
Armazena os passos ou objetivos menores para atingir uma meta principal.

| Coluna | Tipo | Restrições | Descrição |
|---|---|---|---|
| `id` | INT | PRIMARY KEY, AUTO_INCREMENT | Identificador único da micro-meta. |
| `meta_id` | INT | NOT NULL, FOREIGN KEY (`meta`.`id`) | Chave estrangeira para a tabela `meta`. |
| `nome` | VARCHAR(255) | NOT NULL | Descrição da micro-meta (ex: Correr 2km). |

---

## Tabela: `tarefa`
Armazena as tarefas diárias que compõem as micro-metas.

| Coluna | Tipo | Restrições | Descrição |
|---|---|---|---|
| `id` | INT | PRIMARY KEY, AUTO_INCREMENT | Identificador único da tarefa. |
| `micrometa_id`| INT | NOT NULL, FOREIGN KEY (`micrometa`.`id`) | Chave estrangeira para a tabela `micrometa`. |
| `usuario_id` | INT | NOT NULL, FOREIGN KEY (`usuario`.`id`) | Chave estrangeira para o usuário dono da tarefa. |
| `nome` | VARCHAR(255) | NOT NULL | Descrição da tarefa (ex: Correr por 20 minutos). |
| `data` | DATE | NOT NULL | Data em que a tarefa deve ser executada. |
| `tipo` | ENUM(...) | NOT NULL | Tipo temporal da tarefa ('arbitraria', 'manha', 'tarde', 'noite', 'horario'). |
| `horario` | TIME | | Horário específico, se o tipo for 'horario'. |
| `concluida` | BOOLEAN | NOT NULL DEFAULT FALSE | Status de conclusão da tarefa. |
| `criado_em` | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP | Data e hora de criação do registro. |

---

## Tabela: `configuracao`
Armazena as configurações e preferências de cada usuário.

| Coluna | Tipo | Restrições | Descrição |
|---|---|---|---|
| `id` | INT | PRIMARY KEY, AUTO_INCREMENT | Identificador único da configuração. |
| `usuario_id` | INT | NOT NULL, FOREIGN KEY (`usuario`.`id`) | Chave estrangeira para a tabela `usuario`. |
| `chave` | VARCHAR(100) | NOT NULL | O nome da chave de configuração (ex: 'tema'). |
| `valor` | VARCHAR(255) | NOT NULL | O valor da configuração (ex: 'dark'). |
