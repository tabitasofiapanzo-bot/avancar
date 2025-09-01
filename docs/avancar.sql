-- Esquema SQL para a aplicação Avançar
-- Versão 1.0

-- Apagar tabelas existentes (para facilitar a recriação)
DROP TABLE IF EXISTS `tarefa`;
DROP TABLE IF EXISTS `micrometa`;
DROP TABLE IF EXISTS `meta`;
DROP TABLE IF EXISTS `subcategoria`;
DROP TABLE IF EXISTS `categoria`;
DROP TABLE IF EXISTS `pilar`;
DROP TABLE IF EXISTS `configuracao`;
DROP TABLE IF EXISTS `usuario`;

-- Tabela: `usuario`
CREATE TABLE `usuario` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `nome` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `senha` VARCHAR(255) NOT NULL,
    `onboarding_concluido` BOOLEAN NOT NULL DEFAULT FALSE,
    `criado_em` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela: `configuracao`
CREATE TABLE `configuracao` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `usuario_id` INT NOT NULL,
    `chave` VARCHAR(100) NOT NULL,
    `valor` VARCHAR(255) NOT NULL,
    FOREIGN KEY (`usuario_id`) REFERENCES `usuario`(`id`) ON DELETE CASCADE,
    UNIQUE (`usuario_id`, `chave`)
);

-- Tabela: `pilar`
CREATE TABLE `pilar` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `usuario_id` INT NOT NULL,
    `nome` VARCHAR(100) NOT NULL,
    `descricao` TEXT,
    `cor` VARCHAR(7) NOT NULL DEFAULT '#ffffff',
    `obrigatorio` BOOLEAN NOT NULL DEFAULT FALSE,
    FOREIGN KEY (`usuario_id`) REFERENCES `usuario`(`id`) ON DELETE CASCADE
);

-- Tabela: `categoria`
CREATE TABLE `categoria` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `pilar_id` INT NOT NULL,
    `nome` VARCHAR(100) NOT NULL,
    FOREIGN KEY (`pilar_id`) REFERENCES `pilar`(`id`) ON DELETE CASCADE
);

-- Tabela: `subcategoria`
CREATE TABLE `subcategoria` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `categoria_id` INT NOT NULL,
    `nome` VARCHAR(100) NOT NULL,
    FOREIGN KEY (`categoria_id`) REFERENCES `categoria`(`id`) ON DELETE CASCADE
);

-- Tabela: `meta`
CREATE TABLE `meta` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `categoria_id` INT NOT NULL,
    `nome` VARCHAR(255) NOT NULL,
    `data_inicio` DATE NOT NULL,
    `data_fim` DATE NOT NULL,
    FOREIGN KEY (`categoria_id`) REFERENCES `categoria`(`id`) ON DELETE CASCADE
);

-- Tabela: `micrometa`
CREATE TABLE `micrometa` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `meta_id` INT NOT NULL,
    `nome` VARCHAR(255) NOT NULL,
    FOREIGN KEY (`meta_id`) REFERENCES `meta`(`id`) ON DELETE CASCADE
);

-- Tabela: `tarefa`
CREATE TABLE `tarefa` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `micrometa_id` INT NOT NULL,
    `usuario_id` INT NOT NULL,
    `nome` VARCHAR(255) NOT NULL,
    `data` DATE NOT NULL,
    `tipo` ENUM('arbitraria', 'manha', 'tarde', 'noite', 'horario') NOT NULL,
    `horario` TIME,
    `concluida` BOOLEAN NOT NULL DEFAULT FALSE,
    `criado_em` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`micrometa_id`) REFERENCES `micrometa`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`usuario_id`) REFERENCES `usuario`(`id`) ON DELETE CASCADE
);

-- --- DADOS INICIAIS (BASEADO NO MOCK) ---

-- 1. Criar um usuário de teste
INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`) VALUES
(1, 'Usuário de Teste', 'teste@avancar.com', '$2y$10$exemploDeHashDeSenhaNaoSeguro');

-- 2. Inserir Pilares
-- Nota: O `usuario_id` é 1 para todos, associado ao usuário de teste.
INSERT INTO `pilar` (`id`, `usuario_id`, `nome`, `descricao`, `cor`, `obrigatorio`) VALUES
(1, 1, 'Saúde', 'Bem-estar físico e mental', '#4caf50', 1),
(2, 1, 'Educação', 'Aprendizagem e desenvolvimento', '#2196f3', 1),
(3, 1, 'Finanças', 'Gestão financeira e investimentos', '#ff9800', 1),
(4, 1, 'Espiritualidade', 'Crescimento e conexão', '#7e57c2', 1),
(5, 1, 'Global/Básico', 'Atividades essenciais do dia a dia', '#78909c', 1);

-- 3. Inserir Categorias
-- Nota: A estrutura foi melhorada, `meta` agora se liga a `categoria`.
-- Para os dados mock, vamos criar categorias genéricas para as metas existentes.
INSERT INTO `categoria` (`id`, `pilar_id`, `nome`) VALUES
(1, 1, 'Exercício Físico'),
(2, 1, 'Alimentação'),
(3, 2, 'Cursos Online'),
(4, 3, 'Economia'); -- Categoria genérica para a meta de finanças

-- 4. Inserir Subcategorias
INSERT INTO `subcategoria` (`id`, `categoria_id`, `nome`) VALUES
(1, 1, 'Corrida'),
(2, 1, 'Musculação');

-- 5. Inserir Metas
INSERT INTO `meta` (`id`, `categoria_id`, `nome`, `data_inicio`, `data_fim`) VALUES
(1, 1, 'Correr 5km sem parar', '2025-08-01', '2025-10-31'),
(2, 3, 'Concluir curso de JS Avançado', '2025-08-15', '2025-09-30'),
(3, 4, 'Economizar R$500', '2025-09-01', '2025-09-30');

-- 6. Inserir Micro-metas
INSERT INTO `micrometa` (`id`, `meta_id`, `nome`) VALUES
(1, 1, 'Correr 1km'),
(2, 1, 'Correr 2km'),
(3, 2, 'Módulo 1-5');

-- 7. Inserir Tarefas
INSERT INTO `tarefa` (`id`, `micrometa_id`, `usuario_id`, `nome`, `data`, `tipo`, `horario`, `concluida`) VALUES
(1, 2, 1, 'Correr 20 minutos', '2025-09-01', 'manha', NULL, 0),
(2, 3, 1, 'Estudar Módulo 5', '2025-09-01', 'noite', NULL, 1),
(3, 3, 1, 'Reunião do projeto', '2025-09-01', 'horario', '14:30:00', 0),
(4, 1, 1, 'Treino de fortalecimento', '2025-09-02', 'tarde', NULL, 0);

-- 8. Inserir Configurações Padrão
INSERT INTO `configuracao` (`usuario_id`, `chave`, `valor`) VALUES
(1, 'notificacao_email', 'true'),
(1, 'tema', 'dark');

-- Fim do Script SQL
