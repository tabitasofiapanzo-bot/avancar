# Avançar - Documento Técnico

## Stack Tecnológica

### Frontend
- **HTML5**: Estrutura semântica e acessível
- **CSS Puro**: Sem frameworks, controlo total sobre estilos
- **JavaScript Vanilla**: Sem dependências externas, performance optimizada
- **AJAX**: Comunicação assíncrona com backend
- **JSON**: Formato de troca de dados

### Backend
- **PHP 8**: Linguagem servidor com funcionalidades modernas
- **MySQL**: Base de dados relacional robusta
- **Arquitectura MVC-like**: Separação clara de responsabilidades

### Bibliotecas Externas (CDN)
- **Font Awesome**: Ícones vectoriais escaláveis
- **SweetAlert**: Modais e alertas elegantes
- **Chart.js**: Gráficos interactivos para relatórios
- **Tour Library** (a definir): Tutorial interactivo para onboarding

## Segurança

### Medidas Básicas Implementadas
- **Hash de palavras-passe**: `password_hash()` e `password_verify()`
- **PDO com Declarações Preparadas**: Prevenção de Injecção SQL
- **Sanitização de entradas**: Filtros básicos para dados de entrada
- **Validação do lado servidor**: Todas as validações críticas no backend
- **Sessões seguras**: Configuração adequada de sessões PHP

### Validações
- Validação de tipos de dados
- Verificação de comprimentos mínimos/máximos
- Sanitização de HTML quando necessário
- Validação de formatos (email, datas, etc.)

## Design e Interface

### Tema Visual
- **Dark Mode por defeito**: Reduz fadiga ocular
- **Paleta de cores**:
  - Base: Tons escuros (#1a1a1a, #2d2d2d, #3a3a3a)
  - Destaque primário: #4CAF50 (verde)
  - Destaque secundário: #2196F3 (azul)
  - Texto: #ffffff, #e0e0e0
  - Alertas: #f44336 (vermelho), #ff9800 (laranja)

### Princípios de Design
- **Interface madura e profissional**: Sem elementos infantis
- **Minimalismo funcional**: Cada elemento tem propósito
- **Hierarquia visual clara**: Importância definida por tamanho/cor
- **Consistência**: Padrões visuais mantidos em todo o sistema

### UX/UI Guidelines

#### Botões e Interacções
- **Prioridade de ícones**: Usar Font Awesome sempre que possível
- **Texto mínimo**: Apenas quando ícone não é intuitivo
- **Estados visuais**: Hover, active, disabled claramente definidos
- **Feedback imediato**: Resposta visual a todas as acções

#### Responsividade
- **Desktop first**: Optimizado para ecrãs grandes
- **Breakpoints**:
  - Desktop: 1200px+
  - Tablet: 768px - 1199px
  - Mobile: 320px - 767px
- **Adaptação progressiva**: Funcionalidades mantidas em todos os dispositivos

#### Navegação
- **Menu lateral fixo**: Acesso rápido às páginas principais
- **Breadcrumbs**: Orientação na hierarquia do sistema
- **Atalhos de teclado**: Para utilizadores avançados

## Performance e Optimização

### Frontend
- **CSS minificado**: Redução do tamanho dos ficheiros
- **JavaScript modular**: Carregamento apenas do necessário
- **Lazy loading**: Imagens e conteúdo carregados sob demanda
- **Caching browser**: Headers apropriados para cache

### Backend
- **Queries optimizadas**: Índices apropriados na base de dados
- **Cache de sessão**: Redução de consultas repetitivas
- **Paginação**: Limitação de resultados por página
- **Compressão GZIP**: Redução do tráfego de rede

## Estrutura de Dados

### Comunicação AJAX
```javascript
// Padrão para chamadas AJAX
const chamadaApi = async (endpoint, dados = {}, metodo = 'POST') => {
    try {
        const resposta = await fetch(`/api/${endpoint}`, {
            method: metodo,
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify(dados)
        });
        return await resposta.json();
    } catch (erro) {
        console.error('Erro da API:', erro);
        throw erro;
    }
};
```

### Formato de Resposta JSON
```json
{
    "sucesso": true,
    "mensagem": "Operação realizada com sucesso",
    "dados": {},
    "erros": []
}
```

## Funcionalidades Técnicas Específicas

### Sistema de Gamificação
- **Cálculo de pontos**: Algoritmos no backend
- **Distintivos**: Sistema de conquistas baseado em critérios
- **Níveis**: Progressão baseada em pontos acumulados

### Validação Temporal
- **Detecção de conflitos**: Algoritmo de sobreposição de horários
- **Sugestões automáticas**: Inteligência básica para redistribuição
- **Alertas proactivos**: Sistema de notificações inteligente

### Relatórios e Gráficos
- **Chart.js**: Gráficos interactivos de progresso
- **Exportação**: PDF e CSV para relatórios

## Ambiente de Desenvolvimento

### Requisitos
- **PHP 8.0+**
- **MySQL 8.0+**
- **Apache/Nginx**
- **Extensões PHP**: PDO, JSON, Session

### Configuração Local
- **WAMP/XAMPP**: Ambiente de desenvolvimento
- **Estrutura de pastas**: Organização modular
- **Logs de erro**: Sistema de debug durante desenvolvimento

## Considerações Futuras

### Escalabilidade
- **Arquitectura preparada** para crescimento
- **Base de dados normalizada** para performance
- **APIs RESTful** para possível integração mobile

### Manutenibilidade
- **Código documentado** com comentários em português
- **Padrões consistentes** em todo o projecto
- **Separação de responsabilidades** clara

### Acessibilidade
- **Semântica HTML** apropriada
- **Contraste adequado** para leitura
- **Navegação por teclado** funcional
- **Screen readers** compatíveis
