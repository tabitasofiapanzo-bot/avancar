-- Esquema SQL para a aplicação Avançar
-- Versão 2.0 - Modelo de Dados com Templates
-- NOTA: Este script usa IDs fixos para popular os dados de teste.
-- A lógica da aplicação usa AUTO_INCREMENT para novos dados.

-- Apagar tabelas existentes (em ordem inversa de dependência)
DROP TABLE IF EXISTS `tarefa`;
DROP TABLE IF EXISTS `micrometa`;
DROP TABLE IF EXISTS `meta`;
DROP TABLE IF EXISTS `subcategoria`;
DROP TABLE IF EXISTS `configuracao`;
DROP TABLE IF EXISTS `categoria`;
DROP TABLE IF EXISTS `pilar_usuario`;
DROP TABLE IF EXISTS `pilar_template`;
DROP TABLE IF EXISTS `usuario`;

-- Tabela: `usuario`
CREATE TABLE `usuario` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `nome` VARCHAR(100) NOT NULL,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `senha` VARCHAR(255) NOT NULL,
    `onboarding_concluido` BOOLEAN NOT NULL DEFAULT FALSE,
    `criado_em` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela: `pilar_template`
CREATE TABLE `pilar_template` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `nome` VARCHAR(50) NOT NULL UNIQUE,
    `descricao` TEXT,
    `cor` VARCHAR(7) NOT NULL DEFAULT '#ffffff',
    `obrigatorio` BOOLEAN NOT NULL DEFAULT FALSE,
    `is_basico` BOOLEAN NOT NULL DEFAULT FALSE
);

-- Tabela: `pilar_usuario`
CREATE TABLE `pilar_usuario` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `usuario_id` INT NOT NULL,
    `pilar_template_id` INT NOT NULL,
    FOREIGN KEY (`usuario_id`) REFERENCES `usuario`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`pilar_template_id`) REFERENCES `pilar_template`(`id`) ON DELETE CASCADE
);

-- Tabela: `categoria`
CREATE TABLE `categoria` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `pilar_usuario_id` INT NOT NULL,
    `nome` VARCHAR(50) NOT NULL,
    FOREIGN KEY (`pilar_usuario_id`) REFERENCES `pilar_usuario`(`id`) ON DELETE CASCADE
);

-- Tabela: `subcategoria`
CREATE TABLE `subcategoria` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `categoria_id` INT NOT NULL,
    `nome` VARCHAR(50) NOT NULL,
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

-- Tabela: `configuracao`
CREATE TABLE `configuracao` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `usuario_id` INT NOT NULL,
    `chave` VARCHAR(100) NOT NULL,
    `valor` VARCHAR(255) NOT NULL,
    FOREIGN KEY (`usuario_id`) REFERENCES `usuario`(`id`) ON DELETE CASCADE,
    UNIQUE (`usuario_id`, `chave`)
);


-- --- DADOS INICIAIS ---

-- 1. Inserir Templates de Pilares (dados globais)
INSERT INTO `pilar_template` (`id`, `nome`, `descricao`, `cor`, `obrigatorio`, `is_basico`) VALUES
(1, 'Saúde', 'Bem-estar físico e mental', '#4caf50', 1, 0),
(2, 'Educação', 'Aprendizagem e desenvolvimento intelectual', '#2196f3', 1, 0),
(3, 'Finanças', 'Gestão financeira e investimentos', '#ff9800', 1, 0),
(4, 'Espiritualidade', 'Crescimento espiritual, práticas religiosas, meditação, conexão com o transcendente', '#7e57c2', 1, 0),
(5, 'Global/Básico', 'Actividades essenciais (higiene, sono, alimentação, etc.)', '#78909c', 1, 1),
(6, 'Carreira', 'Vida profissional e crescimento', '#ef5350', 0, 0),
(7, 'Desenvolvimento Pessoal', 'Crescimento individual e habilidades', '#ab47bc', 0, 0),
(8, 'Relacionamentos', 'Conexões sociais e amorosas', '#ec407a', 0, 0),
(9, 'Família', 'Vínculos familiares e responsabilidades', '#3f51b5', 0, 0),
(10, 'Lazer/Entretenimento', 'Diversão, passatempos, hobbies, actividades recreativas, jogos, descanso', '#009688', 0, 0);


-- 2. Criar um usuário de teste
INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`) VALUES
(1, 'Usuário de Teste', 'teste@avancar.com', '$2y$10$exemploDeHashDeSenhaNaoSeguro');


-- 3. Inserir instâncias de pilares para o usuário de teste (simulando o que o AuthController faria)
-- IDs 1 a 5 correspondem aos pilares obrigatórios
INSERT INTO `pilar_usuario` (`id`, `usuario_id`, `pilar_template_id`) VALUES
(1, 1, 1), -- Saúde
(2, 1, 2), -- Educação
(3, 1, 3), -- Finanças
(4, 1, 4), -- Espiritualidade
(5, 1, 5); -- Global/Básico


-- 4. Inserir Categorias para o usuário de teste
INSERT INTO `categoria` (`id`, `pilar_usuario_id`, `nome`) VALUES
(1, 1, 'Exercício Físico'), -- Ligado à instância de Saúde do usuário 1
(2, 1, 'Alimentação'),      -- Ligado à instância de Saúde do usuário 1
(3, 2, 'Cursos Online'),   -- Ligado à instância de Educação do usuário 1
(4, 3, 'Economia');        -- Ligado à instância de Finanças do usuário 1


-- 5. Inserir Subcategorias
INSERT INTO `subcategoria` (`id`, `categoria_id`, `nome`) VALUES
(1, 1, 'Corrida'),
(2, 1, 'Musculação');


-- 6. Inserir Metas
INSERT INTO `meta` (`id`, `categoria_id`, `nome`, `data_inicio`, `data_fim`) VALUES
(1, 1, 'Correr 5km sem parar', '2025-08-01', '2025-10-31'),
(2, 3, 'Concluir curso de JS Avançado', '2025-08-15', '2025-09-30'),
(3, 4, 'Economizar R$500', '2025-09-01', '2025-09-30');


-- 7. Inserir Micro-metas
INSERT INTO `micrometa` (`id`, `meta_id`, `nome`) VALUES
(1, 1, 'Correr 1km'),
(2, 1, 'Correr 2km'),
(3, 2, 'Módulo 1-5');


-- 8. Inserir Tarefas
INSERT INTO `tarefa` (`id`, `micrometa_id`, `usuario_id`, `nome`, `data`, `tipo`, `horario`, `concluida`) VALUES
(1, 2, 1, 'Correr 20 minutos', '2025-09-01', 'manha', NULL, 0),
(2, 3, 1, 'Estudar Módulo 5', '2025-09-01', 'noite', NULL, 1),
(3, 3, 1, 'Reunião do projeto', '2025-09-01', 'horario', '14:30:00', 0),
(4, 1, 1, 'Treino de fortalecimento', '2025-09-02', 'tarde', NULL, 0);


-- 9. Inserir Configurações Padrão
INSERT INTO `configuracao` (`usuario_id`, `chave`, `valor`) VALUES
(1, 'notificacao_email', 'true'),
(1, 'tema', 'dark');

-- Fim do Script SQL
