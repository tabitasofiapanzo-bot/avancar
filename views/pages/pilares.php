<div class="cabecalho-pagina">
    <h1>Pilares</h1>
    <div><button class="btn btn-primario" data-acao="abrir-modal" data-modal-id="modal-pilar"><i class="fas fa-plus"></i> Novo Pilar</button></div>
</div>
<div class="grid grid-3" id="container-pilares">
    <div class="card card-pilar" style="border-left-color: #4caf50;">
        <div class="card-header">
            <h3><i class="fas fa-stream"></i> Saúde</h3>
            <div class="card-acoes">
                <i class="fas fa-lock" title="Pilar obrigatório"></i>
            </div>
        </div>
        <div class="card-body">
            <p>Bem-estar físico e mental</p>
            <h4>Categorias:</h4>
            <ul class="lista-sub-item">
                <li class="sub-item"><a href="#" data-acao="ver-categoria" data-id="1">Exercício Físico</a></li>
                <li class="sub-item"><a href="#" data-acao="ver-categoria" data-id="2">Alimentação</a></li>
            </ul>
            <form class="form-add-subitem" data-acao="add-categoria" data-pilar-id="1">
                <input type="text" class="campo-input" placeholder="Nova categoria..." required="">
                <button type="submit" class="btn btn-primario btn-pequeno"><i class="fas fa-plus"></i></button>
            </form>
        </div>
        <div class="card-footer">
            <button class="btn btn-secundario btn-pequeno" data-acao="editar-pilar" data-id="1"><i class="fas fa-edit"></i> Editar</button>
        </div>
    </div>
    <div class="card card-pilar" style="border-left-color: #2196f3;">
        <div class="card-header">
            <h3><i class="fas fa-stream"></i> Educação</h3>
            <div class="card-acoes">
                <i class="fas fa-lock" title="Pilar obrigatório"></i>
            </div>
        </div>
        <div class="card-body">
            <p>Aprendizagem e desenvolvimento</p>
            <h4>Categorias:</h4>
            <ul class="lista-sub-item">
                <li class="sub-item"><a href="#" data-acao="ver-categoria" data-id="3">Cursos Online</a></li>
            </ul>
            <form class="form-add-subitem" data-acao="add-categoria" data-pilar-id="2">
                <input type="text" class="campo-input" placeholder="Nova categoria..." required="">
                <button type="submit" class="btn btn-primario btn-pequeno"><i class="fas fa-plus"></i></button>
            </form>
        </div>
        <div class="card-footer">
            <button class="btn btn-secundario btn-pequeno" data-acao="editar-pilar" data-id="2"><i class="fas fa-edit"></i> Editar</button>
        </div>
    </div>
    <div class="card card-pilar" style="border-left-color: #ff9800;">
        <div class="card-header">
            <h3><i class="fas fa-stream"></i> Finanças</h3>
            <div class="card-acoes">
                <i class="fas fa-lock" title="Pilar obrigatório"></i>
            </div>
        </div>
        <div class="card-body">
            <p>Gestão financeira e investimentos</p>
            <h4>Categorias:</h4>
            <ul class="lista-sub-item">
                <p style="font-size:0.9rem; color: var(--cor-texto-terciario);">Nenhuma categoria.</p>
            </ul>
            <form class="form-add-subitem" data-acao="add-categoria" data-pilar-id="3">
                <input type="text" class="campo-input" placeholder="Nova categoria..." required="">
                <button type="submit" class="btn btn-primario btn-pequeno"><i class="fas fa-plus"></i></button>
            </form>
        </div>
        <div class="card-footer">
            <button class="btn btn-secundario btn-pequeno" data-acao="editar-pilar" data-id="3"><i class="fas fa-edit"></i> Editar</button>
        </div>
    </div>
    <div class="card card-pilar" style="border-left-color: #7e57c2;">
        <div class="card-header">
            <h3><i class="fas fa-stream"></i> Espiritualidade</h3>
            <div class="card-acoes">
                <i class="fas fa-lock" title="Pilar obrigatório"></i>
            </div>
        </div>
        <div class="card-body">
            <p>Crescimento e conexão</p>
            <h4>Categorias:</h4>
            <ul class="lista-sub-item">
                <p style="font-size:0.9rem; color: var(--cor-texto-terciario);">Nenhuma categoria.</p>
            </ul>
            <form class="form-add-subitem" data-acao="add-categoria" data-pilar-id="4">
                <input type="text" class="campo-input" placeholder="Nova categoria..." required="">
                <button type="submit" class="btn btn-primario btn-pequeno"><i class="fas fa-plus"></i></button>
            </form>
        </div>
        <div class="card-footer">
            <button class="btn btn-secundario btn-pequeno" data-acao="editar-pilar" data-id="4"><i class="fas fa-edit"></i> Editar</button>
        </div>
    </div>
    <div class="card card-pilar" style="border-left-color: #78909c;">
        <div class="card-header">
            <h3><i class="fas fa-stream"></i> Global/Básico</h3>
            <div class="card-acoes">
                <i class="fas fa-lock" title="Pilar obrigatório"></i>
            </div>
        </div>
        <div class="card-body">
            <p>Atividades essenciais do dia a dia</p>
            <h4>Categorias:</h4>
            <ul class="lista-sub-item">
                <p style="font-size:0.9rem; color: var(--cor-texto-terciario);">Nenhuma categoria.</p>
            </ul>
            <form class="form-add-subitem" data-acao="add-categoria" data-pilar-id="5">
                <input type="text" class="campo-input" placeholder="Nova categoria..." required="">
                <button type="submit" class="btn btn-primario btn-pequeno"><i class="fas fa-plus"></i></button>
            </form>
        </div>
        <div class="card-footer">
            <button class="btn btn-secundario btn-pequeno" data-acao="editar-pilar" data-id="5"><i class="fas fa-edit"></i> Editar</button>
        </div>
    </div>
</div>
