<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Fornecedores</title>

    <link rel="stylesheet" href="style.css?v=2">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

    <nav class="nav">
        <a href="#" class="active">Fornecedores</a>
        <a href="produtos/produtos.php">Produtos</a>
        <a href="vinculos/vinculos.php">Vínculos</a>
    </nav>

    <main class="container">
        <h1>Fornecedores</h1>

        <div class="top-actions">
            <input type="text" id="searchInput" class="search-input" placeholder="Buscar por nome...">

            <div class="actions-right">
                
                <select id="filterStatus" class="filter-select">
                    <option value="todos">Todos</option>
                    <option value="Ativo">Ativo</option>
                    <option value="Inativo">Inativo</option>
                </select>

                <button class="btn-primary" id="btn-novo-fornecedor">
                    Novo Fornecedor
                </button>
            </div>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>CNPJ</th>
                        <th>E-mail</th>
                        <th>Telefone</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody id="tabela-fornecedores">
                 
                </tbody>
            </table>
        </div>
    </main>

    <div id="modal-fornecedor" class="modal-overlay" style="display: none;">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modal-fornecedor-title">Novo Fornecedor</h2>
                <button class="modal-close" id="modal-fornecedor-close">×</button>
            </div>

            <form id="form-fornecedor">
                <div class="modal-body">
                    <input type="hidden" name="id" id="fornecedor-id">

                    <div class="form-group">
                        <label class="form-label">Nome *</label>
                        <input type="text" name="nome" class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">CNPJ *</label>
                        <input type="text" name="cnpj" class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">E-mail *</label>
                        <input type="email" name="email" class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Telefone *</label>
                        <input type="text" name="telefone" class="form-input" required>
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
                    <button type="button" class="btn btn-secondary" id="btn-cancelar-fornecedor">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>

    <script src="assets/fornecedores.js?v=2"></script>
</body>
</html>
