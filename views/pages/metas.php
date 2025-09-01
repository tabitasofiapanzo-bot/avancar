<div class="cabecalho-pagina">
    <h1>Metas</h1>
    <div><button class="btn btn-primario" data-acao="abrir-modal" data-modal-id="modal-meta"><i class="fas fa-plus"></i> Nova Meta</button></div>
</div>
<div class="grid grid-3" id="container-metas">
    <div class="card card-pilar" style="border-left-color: #4caf50;">
        <div class="card-header">
            <h3><i class="fas fa-bullseye"></i> Correr 5km sem parar</h3>
        </div>
        <div class="card-body">
            <p><strong><i class="fas fa-stream"></i> Pilar:</strong> Saúde</p>
            <p><strong><i class="fas fa-calendar-alt"></i> Prazo:</strong> 01/08/2025 a 31/10/2025</p>
            <h4>Micro-metas:</h4>
            <ul class="lista-sub-item">
                <li class="sub-item"><span>Correr 1km</span> <div> <button class="btn btn-icone btn-pequeno" data-acao="editar-item" data-id="1" data-tipo="micrometa"><i class="fas fa-edit"></i></button> <button class="btn btn-icone btn-pequeno" data-acao="excluir-item" data-id="1" data-tipo="micrometa"><i class="fas fa-trash"></i></button></div></li>
                <li class="sub-item"><span>Correr 2km</span> <div> <button class="btn btn-icone btn-pequeno" data-acao="editar-item" data-id="2" data-tipo="micrometa"><i class="fas fa-edit"></i></button> <button class="btn btn-icone btn-pequeno" data-acao="excluir-item" data-id="2" data-tipo="micrometa"><i class="fas fa-trash"></i></button></div></li>
            </ul>
            <form class="form-add-subitem" data-acao="add-micrometa" data-meta-id="1">
                <input type="text" class="campo-input" placeholder="Nova micro-meta..." required="">
                <button type="submit" class="btn btn-primario btn-pequeno"><i class="fas fa-plus"></i></button>
            </form>
        </div>
        <div class="card-footer">
            <button class="btn btn-secundario btn-pequeno" data-acao="editar-meta" data-id="1"><i class="fas fa-edit"></i> Editar</button>
            <button class="btn btn-perigo btn-pequeno" data-acao="excluir-meta" data-id="1"><i class="fas fa-trash"></i> Excluir</button>
        </div>
    </div>
    <div class="card card-pilar" style="border-left-color: #2196f3;">
        <div class="card-header">
            <h3><i class="fas fa-bullseye"></i> Concluir curso de JS Avançado</h3>
        </div>
        <div class="card-body">
            <p><strong><i class="fas fa-stream"></i> Pilar:</strong> Educação</p>
            <p><strong><i class="fas fa-calendar-alt"></i> Prazo:</strong> 15/08/2025 a 30/09/2025</p>
            <h4>Micro-metas:</h4>
            <ul class="lista-sub-item">
                <li class="sub-item"><span>Módulo 1-5</span> <div> <button class="btn btn-icone btn-pequeno" data-acao="editar-item" data-id="3" data-tipo="micrometa"><i class="fas fa-edit"></i></button> <button class="btn btn-icone btn-pequeno" data-acao="excluir-item" data-id="3" data-tipo="micrometa"><i class="fas fa-trash"></i></button></div></li>
            </ul>
            <form class="form-add-subitem" data-acao="add-micrometa" data-meta-id="2">
                <input type="text" class="campo-input" placeholder="Nova micro-meta..." required="">
                <button type="submit" class="btn btn-primario btn-pequeno"><i class="fas fa-plus"></i></button>
            </form>
        </div>
        <div class="card-footer">
            <button class="btn btn-secundario btn-pequeno" data-acao="editar-meta" data-id="2"><i class="fas fa-edit"></i> Editar</button>
            <button class="btn btn-perigo btn-pequeno" data-acao="excluir-meta" data-id="2"><i class="fas fa-trash"></i> Excluir</button>
        </div>
    </div>
    <div class="card card-pilar" style="border-left-color: #ff9800;">
        <div class="card-header">
            <h3><i class="fas fa-bullseye"></i> Economizar R$500</h3>
        </div>
        <div class="card-body">
            <p><strong><i class="fas fa-stream"></i> Pilar:</strong> Finanças</p>
            <p><strong><i class="fas fa-calendar-alt"></i> Prazo:</strong> 01/09/2025 a 30/09/2025</p>
            <h4>Micro-metas:</h4>
            <ul class="lista-sub-item">
                <p style="font-size:0.9rem; color: var(--cor-texto-terciario);">Nenhuma micro-meta.</p>
            </ul>
            <form class="form-add-subitem" data-acao="add-micrometa" data-meta-id="3">
                <input type="text" class="campo-input" placeholder="Nova micro-meta..." required="">
                <button type="submit" class="btn btn-primario btn-pequeno"><i class="fas fa-plus"></i></button>
            </form>
        </div>
        <div class="card-footer">
            <button class="btn btn-secundario btn-pequeno" data-acao="editar-meta" data-id="3"><i class="fas fa-edit"></i> Editar</button>
            <button class="btn btn-perigo btn-pequeno" data-acao="excluir-meta" data-id="3"><i class="fas fa-trash"></i> Excluir</button>
        </div>
    </div>
</div>
