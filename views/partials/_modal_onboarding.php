<div id="modal-onboarding" class="modal">
    <div class="modal-conteudo" style="max-width: 800px;">
        <div class="modal-header">
            <h2 id="modal-onboarding-titulo"><i class="fas fa-rocket"></i> Bem-vindo ao Avançar!</h2>
        </div>
        <div class="modal-body">
            <div class="onboarding-stepper">
                <div class="onboarding-step ativo" id="onboarding-step-1-indicator">
                    <div class="step-circle">1</div>
                    <div class="step-label">Pilares</div>
                </div>
                <div class="onboarding-step" id="onboarding-step-2-indicator">
                    <div class="step-circle">2</div>
                    <div class="step-label">Rotina</div>
                </div>
                <div class="onboarding-step" id="onboarding-step-3-indicator">
                    <div class="step-circle">3</div>
                    <div class="step-label">Categorias</div>
                </div>
                <div class="onboarding-step" id="onboarding-step-4-indicator">
                    <div class="step-circle"><i class="fas fa-check"></i></div>
                    <div class="step-label">Concluir</div>
                </div>
            </div>

            <div id="onboarding-step-1" class="step-content ativo">
                <h4>Passo 1: Selecione os seus Pilares</h4>
                <p>Além dos pilares essenciais já incluídos, escolha outras áreas da sua vida que são importantes para você focar.</p>
                <div class="grid grid-3" id="selecao-pilares-opcionais">
                    <!-- Pilares opcionais serão injetados aqui -->
                </div>
            </div>

            <div id="onboarding-step-2" class="step-content">
                <h4>Passo 2: Configure a sua Rotina Essencial</h4>
                <p>Defina horários para as suas atividades diárias básicas. Elas serão adicionadas automaticamente ao seu dia.</p>
                <div id="configuracao-pilar-global">
                    <!-- Tarefas do pilar global serão injetadas aqui -->
                </div>
            </div>

            <div id="onboarding-step-3" class="step-content">
                <h4>Passo 3: Crie as suas Primeiras Categorias</h4>
                <p>Para cada pilar, adicione algumas categorias para começar a organizar as suas metas e tarefas. Ex: No pilar 'Saúde', pode adicionar 'Exercício' e 'Alimentação'.</p>
                <div id="configuracao-categorias-iniciais" class="grid grid-2">
                        <!-- Inputs para categorias serão injetados aqui -->
                </div>
            </div>

            <div id="onboarding-step-4" class="step-content texto-centro">
                    <i class="fas fa-party-horn fa-3x" style="color: var(--cor-primaria); margin-bottom: 20px;"></i>
                <h4>Tudo Pronto!</h4>
                <p>A sua configuração inicial está completa. Você está pronto para começar a planear o seu progresso e avançar em direção aos seus objetivos. Bom trabalho!</p>
            </div>
        </div>
        <div class="modal-footer" id="onboarding-footer">
                <button type="button" id="btn-onboarding-anterior" class="btn btn-secundario display-none">Anterior</button>
                <button type="button" id="btn-onboarding-proximo" class="btn btn-primario">Próximo <i class="fas fa-arrow-right"></i></button>
        </div>
    </div>
</div>
