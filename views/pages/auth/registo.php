<form action="/registo/processar" method="POST" class="auth-form">
    <h2>Criar Conta</h2>

    <div class="campo-grupo">
        <i class="fas fa-user campo-icone"></i>
        <input type="text" id="nome" name="nome" class="campo-input" placeholder="Nome Completo" required>
    </div>

    <div class="campo-grupo">
        <i class="fas fa-envelope campo-icone"></i>
        <input type="email" id="email" name="email" class="campo-input" placeholder="Email" required>
    </div>

    <div class="campo-grupo">
        <i class="fas fa-lock campo-icone"></i>
        <input type="password" id="senha" name="senha" class="campo-input" placeholder="Senha" required>
    </div>

    <div class="campo-grupo">
        <i class="fas fa-lock campo-icone"></i>
        <input type="password" id="confirmar_senha" name="confirmar_senha" class="campo-input" placeholder="Confirmar Senha" required>
    </div>

    <div class="campo-grupo">
        <button type="submit" class="btn btn-primario" style="width: 100%;">Criar Conta</button>
    </div>

    <p class="texto-centro" style="margin-top: 24px;">
        Já tem uma conta? <a href="/login">Faça login aqui</a>.
    </p>
</form>
