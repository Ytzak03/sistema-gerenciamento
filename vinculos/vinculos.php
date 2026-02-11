<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Vínculos</title>

    <link rel="stylesheet" href="../style.css?v=2">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

    <nav class="nav">
        <a href="../index.php">Fornecedores</a>
        <a href="../produtos/produtos.php">Produtos</a>
        <a href="#" class="active">Vínculos</a>
    </nav>

    <main class="container">
        <h1>Vínculos</h1>

        <div class="top-actions">
            <input type="text" id="search-vinculo" class="search-input" placeholder="Buscar por produto ou fornecedor...">

            <div style="display:flex; gap:10px;">
                <button class="btn-primary" id="btn-novo-vinculo">Novo Vínculo</button>
                <button class="btn-primary" id="btn-remover-massa" style="background:#dc2626;">
                    Remover Selecionados
                </button>
            </div>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" id="check-all">
                        </th>
                        <th>Produto</th>
                        <th>Fornecedor</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody id="tabela-vinculos">
                </tbody>
            </table>
        </div>
    </main>

    <div id="modal-vinculo" class="modal-overlay" style="display: none;">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modal-vinculo-title">Novo Vínculo</h2>
                <button class="modal-close" id="modal-vinculo-close">×</button>
            </div>

            <form id="form-vinculo">
                <div class="modal-body">
                    <input type="hidden" name="id" id="vinculo-id">

                    <div class="form-group">
                        <label class="form-label">Produto *</label>
                        <select name="produto_id" id="produto_id" class="form-select" required>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Fornecedor *</label>
                        <select name="fornecedor_id" id="fornecedor_id" class="form-select" required>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="btn-cancelar-vinculo">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>

    <script src="../assets/vinculos.js"></script>
</body>
</html>
