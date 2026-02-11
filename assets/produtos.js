$(document).ready(function() {

    carregarProdutos();

    // Abre modal para novo produto
    $('#btn-novo-produto').on('click', function () {
        limparFormularioProduto();
        $('#modal-produto-title').text('Novo Produto');
        $('#form-produto button[type="submit"]').text('Salvar');
        $('#modal-produto').fadeIn(200);
    });

    // Fecha modal
    $('#modal-produto-close, #btn-cancelar-produto').on('click', function () {
        $('#modal-produto').fadeOut(200);
    });

    // Salva produto (criar ou atualizar)
    $('#form-produto').submit(function(e) {
        e.preventDefault();

        $.ajax({
            url: 'salvar_produtos.php',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(resp) {
                if(resp.sucesso) {
                    alert(resp.mensagem);
                    $('#modal-produto').fadeOut(200);
                    limparFormularioProduto();
                    carregarProdutos();
                } else {
                    alert('Erro: ' + resp.mensagem);
                }
            },
            error: function() {
                alert('Erro ao salvar produto.');
            }
        });
    });

    // Filtra produtos por status
    $('#filterStatus').on('change', function() {
        const statusSelecionado = $(this).val();
        carregarProdutos(statusSelecionado);
    });

    // Carrega lista de produtos do servidor
    function carregarProdutos(filtroStatus = 'todos') {
        $.ajax({
            url: 'listar_produtos.php',
            type: 'GET',
            dataType: 'json',
            success: function(dados) {
                let html = '';

                dados.forEach(p => {
                    if(filtroStatus === 'todos' || p.status === filtroStatus) {
                        html += `<tr>
                            <td>${p.nome}</td>
                            <td>${p.codigo_interno}</td>
                            <td>${p.descricao}</td>
                            <td class="status ${p.status.toLowerCase()}">${p.status}</td>
                            <td>
                                <button onclick="editarProduto(${p.id})">Editar</button>
                                <button onclick="excluirProduto(${p.id})">Excluir</button>
                            </td>
                        </tr>`;
                    }
                });

                $('#tabela-produtos').html(html);
            }
        });
    }

    function limparFormularioProduto() {
        $('#form-produto')[0].reset();
        $('#produto_id').val('');
        $('.form-error').text('');
    }

    // Filtra produtos na tabela por nome ou código interno
    $('#searchInput').on('input', function() {
        const textoBusca = $(this).val().toLowerCase();

        $('#tabela-produtos tr').filter(function() {
            const nome = $(this).find('td:eq(0)').text().toLowerCase();
            const codigoInterno = $(this).find('td:eq(1)').text().toLowerCase();

            $(this).toggle(nome.indexOf(textoBusca) > -1 || codigoInterno.indexOf(textoBusca) > -1);
        });
    });

});

// Busca dados do produto e abre modal para edição
function editarProduto(id) {
    $.ajax({
        url: 'buscar_produto.php',
        type: 'GET',
        data: { id: id },
        dataType: 'json',
        success: function(p) {
            $('#produto_id').val(p.id);
            $('input[name="nome"]').val(p.nome);
            $('input[name="codigo_interno"]').val(p.codigo_interno);
            $('textarea[name="descricao"]').val(p.descricao);
            $('select[name="status"]').val(p.status);

            $('#modal-produto-title').text('Editar Produto');
            $('#form-produto button[type="submit"]').text('Atualizar Produto');
            $('#modal-produto').fadeIn(200);
        },
        error: function() {
            alert('Erro ao buscar dados do produto.');
        }
    });
}

// Exclui produto após confirmação
function excluirProduto(id) {
    if(confirm('Tem certeza que deseja excluir este produto?')) {
        $.ajax({
            url: 'excluir_produto.php',
            type: 'POST',
            data: { id: id },
            dataType: 'json',
            success: function(resp) {
                if(resp.sucesso) {
                    alert(resp.mensagem);
                    location.reload();
                }
            }
        });
    }
}
