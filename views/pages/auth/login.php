<form action="/login/processar" method="POST" class="auth-form">
    <h2>Login</h2>

    <div class="campo-grupo">
        <i class="fas fa-envelope campo-icone"></i>
        <input type="email" id="email" name="email" class="campo-input" placeholder="Email" required>
    </div>

    <div class="campo-grupo">
        <i class="fas fa-lock campo-icone"></i>
        <input type="password" id="senha" name="senha" class="campo-input" placeholder="Senha" required>
    </div>

    <div class="campo-grupo">
        <button type="submit" class="btn btn-primario" style="width: 100%;">Entrar</button>
    </div>

    <p class="texto-centro" style="margin-top: 24px;">
        Não tem uma conta? <a href="/registo">Crie uma aqui</a>.
    </p>
</form>
