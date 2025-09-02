document.addEventListener('DOMContentLoaded', () => {

    // ===== LÓGICA DE INTERATIVIDADE GERAL =====

    // Manipulador para abrir/fechar o menu lateral em telas pequenas
    const menuLateral = document.getElementById('menu-lateral');
    const botaoHamburguer = document.getElementById('botao-hamburguer');
    if (botaoHamburguer) {
        botaoHamburguer.addEventListener('click', () => {
            menuLateral.classList.toggle('aberto');
        });
    }

    // Manipulador para fechar modais
    document.querySelectorAll('.btn-fechar-modal').forEach(btn => {
        btn.addEventListener('click', () => fecharModal(btn.dataset.modalId));
    });
    document.querySelectorAll('.modal').forEach(modal => {
        modal.addEventListener('click', e => {
            if (e.target === modal) fecharModal(modal.id);
        });
    });

    // ===== LÓGICA DE ONBOARDING =====
    const modalOnboarding = document.getElementById('modal-onboarding');
    if (modalOnboarding) {
        // Simula a necessidade de onboarding (em um app real, isso viria do backend)
        const onboardingPendente = !localStorage.getItem('avancarOnboardingConcluido');

        if (onboardingPendente) {
            iniciarOnboarding();
        }
    }

    function navegarOnboarding(direcao) {
        const etapas = document.querySelectorAll('.step-content');
        let etapaAtual = Array.from(etapas).findIndex(el => el.classList.contains('ativo'));

        etapas[etapaAtual].classList.remove('ativo');

        if (direcao === 'proximo' && etapaAtual < etapas.length - 1) {
            etapaAtual++;
        } else if (direcao === 'anterior' && etapaAtual > 0) {
            etapaAtual--;
        }

        etapas[etapaAtual].classList.add('ativo');

        // Atualiza indicadores e botões
        document.querySelectorAll('.onboarding-step').forEach((el, index) => {
            el.classList.toggle('ativo', index === etapaAtual);
        });
        document.getElementById('btn-onboarding-anterior').classList.toggle('display-none', etapaAtual === 0);
        document.getElementById('btn-onboarding-proximo').innerHTML = (etapaAtual === etapas.length - 1)
            ? 'Concluir <i class="fas fa-check"></i>'
            : 'Próximo <i class="fas fa-arrow-right"></i>';
    }

    function iniciarOnboarding() {
        abrirModal('modal-onboarding');
        // A lógica de popular pilares opcionais agora deve vir do backend
        // ou ser passada diretamente para a view pelo controlador.
    }

    async function concluirOnboarding() {
        const pilaresOpcionais = [];
        document.querySelectorAll('#selecao-pilares-opcionais .card.ativo').forEach(card => {
            pilaresOpcionais.push({ id: card.dataset.pilarOpcionalId });
        });

        const categoriasIniciais = [];
        document.querySelectorAll('#configuracao-categorias-iniciais input').forEach(input => {
            if (input.value.trim() !== '') {
                categoriasIniciais.push({
                    pilarId: parseInt(input.dataset.pilarIdOnboarding),
                    nome: input.value.trim()
                });
            }
        });

        const dadosOnboarding = { pilaresOpcionais, categoriasIniciais };

        try {
            const resposta = await chamarApi('/onboarding/salvar', dadosOnboarding);
            if (resposta.sucesso) {
                localStorage.setItem('avancarOnboardingConcluido', 'true');
                notificacao('Tudo pronto!', 'Sua jornada no Avançar começa agora.', 'success');
                window.location.href = '/'; // Redireciona para o dashboard
            } else {
                notificacao('Erro!', resposta.mensagem || 'Não foi possível concluir o onboarding.', 'error');
            }
        } catch (erro) {
            notificacao('Erro de Rede!', 'Não foi possível conectar ao servidor.', 'error');
        }
    }

    const btnProximo = document.getElementById('btn-onboarding-proximo');
    if(btnProximo) {
        btnProximo.addEventListener('click', () => {
            const etapas = document.querySelectorAll('.step-content');
            const etapaAtual = Array.from(etapas).findIndex(el => el.classList.contains('ativo'));
            if (etapaAtual === etapas.length - 1) {
                concluirOnboarding();
            } else {
                navegarOnboarding('proximo');
            }
        });
    }
    const btnAnterior = document.getElementById('btn-onboarding-anterior');
    if(btnAnterior) {
        btnAnterior.addEventListener('click', () => navegarOnboarding('anterior'));
    }


    // ===== FUNÇÕES UTILITÁRIAS =====

    async function chamarApi(endpoint, dados = {}, metodo = 'POST') {
        try {
            const config = window.APP_CONFIG || {};
            const baseUrl = config.base_url || '';
            const url = `${baseUrl}${endpoint}`;

            const resposta = await fetch(url, {
                method: metodo,
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: Object.keys(dados).length > 0 ? JSON.stringify(dados) : null
            });
            return await resposta.json();
        } catch (erro) {
            console.error('Erro da API:', erro);
            throw erro;
        }
    };

    function notificacao(titulo, texto, icone) {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: titulo, text: texto, icon: icone, toast: true, position: 'top-end',
                showConfirmButton: false, timer: 3000, timerProgressBar: true,
                background: 'var(--cor-fundo-secundario)', color: 'var(--cor-texto-principal)'
            });
        } else {
            alert(`${titulo}: ${texto}`);
        }
    }

    function abrirModal(id) {
        const modal = document.getElementById(id);
        if (modal) modal.classList.add('visivel');
    }

    function fecharModal(id) {
        const modal = document.getElementById(id);
        if (modal) modal.classList.remove('visivel');
    }

});
