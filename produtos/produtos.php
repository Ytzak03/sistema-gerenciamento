<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Produtos</title>

    <link rel="stylesheet" href="../style.css?v=2">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

    <nav class="nav">
        <a href="../index.php">Fornecedores</a>
        <a href="#" class="active">Produtos</a>
        <a href="../vinculos/vinculos.php">Vínculos</a>
    </nav>

    <main class="container">
        <h1>Produtos</h1>

        <div class="top-actions">
            <input type="text" id="searchInput" class="search-input" placeholder="Buscar por nome ou código...">

            <div class="actions-right">

                <div class="filter-wrapper">
                    <select id="filterStatus" class="filter-select">
                        <option value="todos">Todos</option>
                        <option value="Ativo">Ativo</option>
                        <option value="Inativo">Inativo</option>
                    </select>
                </div>

                <button class="btn-primary" id="btn-novo-produto">
                    Novo Produto
                </button>
            </div>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Código Interno</th>
                        <th>Descrição</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody id="tabela-produtos">
                </tbody>
            </table>
        </div>
    </main>

    <div id="modal-produto" class="modal-overlay" style="display: none;">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modal-produto-title">Novo Produto</h2>
                <button class="modal-close" id="modal-produto-close">×</button>
            </div>

            <form id="form-produto">
                <div class="modal-body">
                    <input type="hidden" id="produto_id" name="id">

                    <div class="form-group">
                        <label class="form-label">Nome *</label>
                        <input type="text" name="nome" class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Código Interno *</label>
                        <input type="text" name="codigo_interno" class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Descrição *</label>
                        <textarea name="descricao" class="form-input" required></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Status *</label>
                        <select name="status" class="form-select" required>
                            <option value="Ativo">Ativo</option>
                            <option value="Inativo">Inativo</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="btn-cancelar-produto">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>

    <script src="../assets/produtos.js?v=1"></script>
</body>

</html>
