# Esquema do Banco de Dados - Avançar

Este documento descreve a estrutura do banco de dados para a aplicação "Avançar". Todas as tabelas estão em português e no singular, conforme a convenção do projeto.

---

## Tabela: `usuario`
Armazena as informações dos usuários da aplicação.

| Coluna | Tipo | Restrições | Descrição |
|---|---|---|---|
| `id` | INT | PRIMARY KEY, AUTO_INCREMENT | Identificador único do usuário. |
| `nome` | VARCHAR(255) | NOT NULL | Nome completo do usuário. |
| `email` | VARCHAR(255) | NOT NULL, UNIQUE | Endereço de email do usuário (usado para login). |
| `senha` | VARCHAR(255) | NOT NULL | Senha do usuário (armazenada como hash). |
| `criado_em` | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP | Data e hora de criação do registro. |

---

## Tabela: `pilar`
Armazena os pilares da vida de cada usuário.

| Coluna | Tipo | Restrições | Descrição |
|---|---|---|---|
| `id` | INT | PRIMARY KEY, AUTO_INCREMENT | Identificador único do pilar. |
| `usuario_id` | INT | NOT NULL, FOREIGN KEY (`usuario`.`id`) | Chave estrangeira para a tabela `usuario`. |
| `nome` | VARCHAR(100) | NOT NULL | Nome do pilar (ex: Saúde, Carreira). |
| `descricao` | TEXT | | Descrição opcional do pilar. |
| `cor` | VARCHAR(7) | NOT NULL DEFAULT '#ffffff' | Cor hexadecimal para representação visual. |
| `obrigatorio`| BOOLEAN | NOT NULL DEFAULT FALSE | Indica se o pilar é obrigatório e não pode ser excluído. |

---

## Tabela: `categoria`
Armazena as categorias dentro de cada pilar.

| Coluna | Tipo | Restrições | Descrição |
|---|---|---|---|
| `id` | INT | PRIMARY KEY, AUTO_INCREMENT | Identificador único da categoria. |
| `pilar_id` | INT | NOT NULL, FOREIGN KEY (`pilar`.`id`) | Chave estrangeira para a tabela `pilar`. |
| `nome` | VARCHAR(100) | NOT NULL | Nome da categoria (ex: Exercício Físico). |

---

## Tabela: `subcategoria`
Armazena as subcategorias (opcionais) dentro de cada categoria.

| Coluna | Tipo | Restrições | Descrição |
|---|---|---|---|
| `id` | INT | PRIMARY KEY, AUTO_INCREMENT | Identificador único da subcategoria. |
| `categoria_id` | INT | NOT NULL, FOREIGN KEY (`categoria`.`id`) | Chave estrangeira para a tabela `categoria`. |
| `nome` | VARCHAR(100) | NOT NULL | Nome da subcategoria (ex: Corrida, Musculação). |

---

## Tabela: `meta`
Armazena as metas de longo prazo, associadas a uma categoria.

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
