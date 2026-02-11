$(document).ready(function() {

    let listaFornecedores = [];

    carregarFornecedores();

    // Busca por nome
    $('#searchInput').on('keyup', function() {
        aplicarFiltros();
    });

    // Filtro por status
    $('#filterStatus').on('change', function() {
        aplicarFiltros();
    });

    // Salvar fornecedor (criar ou atualizar)
    $('#form-fornecedor').submit(function(e) {
        e.preventDefault();

        const dados = $(this).serialize();

        $.ajax({
            url: 'fornecedores/salvar_fornecedores.php',
            type: 'POST',
            data: dados,
            dataType: 'json',
            success: function(resp) {

                if (resp.sucesso) {

                    alert(resp.mensagem);

                    $('#modal-fornecedor').fadeOut(200);
                    $('#form-fornecedor')[0].reset();
                    $('#fornecedor-id').val('');

                    carregarFornecedores();

                } else {
                    alert('Erro: ' + resp.mensagem);
                }

            },
            error: function() {
                alert('Erro ao salvar fornecedor.');
            }
        });
    });

    // Carrega lista de fornecedores do servidor
    function carregarFornecedores() {
        $.ajax({
            url: 'fornecedores/listar_fornecedores.php',
            type: 'GET',
            dataType: 'json',
            success: function(dados) {
                listaFornecedores = dados;
                aplicarFiltros();
            }
        });
    }

    // Aplica filtros de busca e status
    function aplicarFiltros() {

        const termoBusca = $('#searchInput').val().toLowerCase();
        const statusSelecionado = $('#filterStatus').val();

        let linhas = '';

        listaFornecedores.forEach(function(fornecedor) {

            const nomeMatch = fornecedor.nome.toLowerCase().includes(termoBusca);
            const statusMatch = (statusSelecionado === 'todos') || 
                                (fornecedor.status === statusSelecionado);

            if (nomeMatch && statusMatch) {

                linhas += `
                    <tr>
                        <td>${fornecedor.nome}</td>
                        <td>${fornecedor.cnpj}</td>
                        <td>${fornecedor.email}</td>
                        <td>${fornecedor.telefone}</td>
                        <td class="status ${fornecedor.status.toLowerCase()}">
                            ${fornecedor.status}
                        </td>
                        <td>
                            <button onclick="editarFornecedor(${fornecedor.id})">Editar</button>
                            <button onclick="excluirFornecedor(${fornecedor.id})">Excluir</button>
                        </td>
                    </tr>`;
            }
        });

        $('#tabela-fornecedores').html(linhas);
    }

    // Abre modal para novo fornecedor
    $('#btn-novo-fornecedor').on('click', function () {
        limparFormularioFornecedor();
        $('#modal-fornecedor-title').text('Novo Fornecedor');
        $('#form-fornecedor button[type="submit"]').text('Salvar');
        $('#modal-fornecedor').fadeIn(200);
    });

    // Fecha modal
    $('#modal-fornecedor-close').on('click', function () {
        $('#modal-fornecedor').fadeOut(200);
    });

    $('#btn-cancelar-fornecedor').on('click', function () {
        $('#modal-fornecedor').fadeOut(200);
    });

    function limparFormularioFornecedor() {
        const form = $('#form-fornecedor')[0];
        if (form) form.reset();
        $('#fornecedor-id').val('');
        $('.form-error').text('');
    }

});

// Busca dados do fornecedor e abre modal para edição
function editarFornecedor(id) {

    $.ajax({
        url: 'fornecedores/buscar_fornecedor.php',
        type: 'GET',
        data: { id: id },
        dataType: 'json',

        success: function(fornecedor) {

            $('#fornecedor-id').val(fornecedor.id);
            $('input[name="nome"]').val(fornecedor.nome);
            $('input[name="cnpj"]').val(fornecedor.cnpj);
            $('input[name="email"]').val(fornecedor.email);
            $('input[name="telefone"]').val(fornecedor.telefone);
            $('select[name="status"]').val(fornecedor.status);

            $('#modal-fornecedor-title').text('Editar Fornecedor');
            $('#form-fornecedor button[type="submit"]').text('Atualizar Fornecedor');

            $('#modal-fornecedor')
                .css('display', 'flex')
                .hide()
                .fadeIn(200);
        },

        error: function() {
            alert('Erro ao buscar dados do fornecedor.');
        }
    });
}

// Exclui fornecedor após confirmação
function excluirFornecedor(id) {
    if (confirm('Tem certeza que deseja excluir este fornecedor?')) {
        $.ajax({
            url: 'fornecedores/excluir_fornecedor.php',
            type: 'POST',
            data: { id: id },
            dataType: 'json',
            success: function(response) {
                if (response.sucesso) {
                    alert(response.mensagem);
                    location.reload();
                }
            }
        });
    }
}
